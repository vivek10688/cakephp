<?php
App::uses('CakeTime', 'Utility');
App::uses('Paypal', 'Paypal.Lib');
App::uses('CakeEmail', 'Network/Email');
class PaymentsController extends AppController
{
    public $currencyType;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
        $this->currentDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $this->currentEmailDate=CakeTime::format('d-m-Y',CakeTime::convert(time(),$this->siteTimezone));
        $this->userId=$this->userValue['Member']['id'];
        $this->PPL=false;$this->CAE=false;$this->PME=false;
        $this->loadModel('PaypalConfig');
        $paySetting=$this->PaypalConfig->findByType('PPL');
        if(strlen($paySetting['PaypalConfig']['username'])>0 && strlen($paySetting['PaypalConfig']['password'])>0 && strlen($paySetting['PaypalConfig']['signature'])>0)
        {
            if($paySetting['PaypalConfig']['sandbox_mode']==1)
            $sandboxMode=true;
            else
            $sandboxMode=false;        
            $this->Paypal = new Paypal(array(
                                             'sandboxMode' => $sandboxMode,
                                             'nvpUsername' => $paySetting['PaypalConfig']['username'],
                                             'nvpPassword' => $paySetting['PaypalConfig']['password'],
                                             'nvpSignature' => $paySetting['PaypalConfig']['signature']
                                             ));
            $this->paymentNamePPL=$paySetting['PaypalConfig']['name'];         
            $this->PPL=true;            
        }
        $paySetting=$this->PaypalConfig->findByType('CAE');
        if(strlen($paySetting['PaypalConfig']['username'])>0 && strlen($paySetting['PaypalConfig']['password'])>0 && strlen($paySetting['PaypalConfig']['signature'])>0)
        {
            if($paySetting['PaypalConfig']['sandbox_mode']==1)
            $sandboxMode=true;
            else
            $sandboxMode=false;
            $this->merchantIdAvenue=$paySetting['PaypalConfig']['username'];
            $this->accessCode=$paySetting['PaypalConfig']['password'];
            $this->workingKey=$paySetting['PaypalConfig']['signature'];
            $this->paymentNameCAE=$paySetting['PaypalConfig']['name'];
            $this->gatewayUrl=$paySetting['PaypalConfig']['gateway_url'];  
            $this->CAE=true;            
        }
        $paySetting=$this->PaypalConfig->findByType('PME');
        if(strlen($paySetting['PaypalConfig']['username'])>0 && strlen($paySetting['PaypalConfig']['password'])>0 && strlen($paySetting['PaypalConfig']['signature'])>0)
        {
            if($paySetting['PaypalConfig']['sandbox_mode']==1)
            $this->payumoneyUrl="https://test.payu.in";
            else
            $this->payumoneyUrl="https://secure.payu.in";
            $this->merchantId=$paySetting['PaypalConfig']['username'];
            $this->merchantKey=$paySetting['PaypalConfig']['password'];
            $this->merchantSalt=$paySetting['PaypalConfig']['signature'];
            $this->serviceProvider=$paySetting['PaypalConfig']['gateway_url'];
            $this->paymentNamePME=$paySetting['PaypalConfig']['name'];  
            $this->PME=true;            
        }
        $this->set('PPL',$this->PPL);
        $this->set('CAE',$this->CAE);
        $this->set('PME',$this->PME);
    }
    public function index($id=null)
    {
        $this->authenticate();
        if(isset($_REQUEST['token']))
        {
            $this->Session->setFlash(__('Payment Cancel'),'flash',array('alert'=>'danger'));
        }
        $this->redirect(array('controller'=>'Plans','action' => 'index'));
    }
    public function paymentgateway($id,$type)
    {
        if (!$id){
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('Plan');
        $planArr=$this->Plan->findById($id);
        if(!$planArr){
            throw new NotFoundException(__('Invalid post'));
        }
        $planArr['Plan']['gateway']=$type;
        $this->Session->write('Plan', $planArr);
        $this->authenticate();
        if($planArr['Plan']['amount']==0)
        {
            $this->redirect(array('controller'=>'Payments','action' => 'postpayment'));
        }
        if($type=="CCAVENUE"){
            $this->redirect(array('controller'=>'Payments','action' => 'ccavenue'));
        }
        elseif($type=="PAYUMONEY"){
            $this->redirect(array('controller'=>'Payments','action' => 'payumoney'));
        }
        else{
            $this->redirect(array('controller'=>'Payments','action' => 'paypalpayment'));
        }
    }
    public function postpayment()
    {
        $this->authenticate();
        $planArr=$this->Session->read('Plan');
        if($planArr['Plan']['amount']==0)
        {
            $transactionId=time().rand();
            $paymentArr=array('member_id'=>$this->userId,'plan_id'=>$planArr['Plan']['id'],'token'=>$transactionId,'amount'=>$planArr['Plan']['amount'],'remarks'=>NULL,'status'=>'Pending','type'=>__('Free'),'date'=>$this->currentDateTime);
            $this->loadModel('MembersPayment');
            $this->MembersPayment->create();
            $this->MembersPayment->save($paymentArr);
            $total=$this->MembersPayment->find('count',array('conditions'=>array('MembersPayment.token'=>$transactionId,'MembersPayment.status'=>'Pending')));
            if($total>0)
            {
                $this->Session->write('OrderComplete', true);
                $this->orderComplete($transactionId,$transactionId);
                $this->Session->write('OrderComplete', false);
                $this->Session->write('Plan', null);
                $this->Session->setFlash(__("%s plan successfully purchased",$planArr['Plan']['name']),'flash',array('alert'=>'success'));
            }
            else
            {
                $this->Session->setFlash(__('Plan already purchased'),'flash',array('alert'=>'danger'));
            }
        }
        $this->redirect(array('controller'=>'Plans','action' => 'index'));
    }
    public function paypalpayment($id=null)
    {
        $this->authenticate();
        if($this->PPL==false)
        {
            $this->Session->setFlash(__('Payment Setings not set'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Payments','action' => 'index'));
        }
        $planArr=$this->Session->read('Plan');
        $description=$planArr['Plan']['description'];
        $amount=$planArr['Plan']['amount'];
        $name=$planArr['Plan']['name'];
        if($amount>0)
        {
            $returnUrl=$this->siteDomain.'/Payments/paypalpostpayment/';
            $cancelUrl=$this->siteDomain.'/Payments/index/';
            $order = array(
            'description' => $description,
            'currency' => $this->currencyType,
            'return' => $returnUrl,
            'cancel' => $cancelUrl,
            'items' => array(
                0 => array(
                    'name' =>$name,
                    'tax' => 0.00,
                    'shipping' => 0.00,
                    'description' => $description,
                    'subtotal' => $amount,
                ),
                )
            );
            try
            {
                $token=$this->Paypal->setExpressCheckout($order);
                $tokenArr=explode("&",$token);
                $tokenId=substr($tokenArr[1],6);
                $paymentArr=array('member_id'=>$this->userId,'plan_id'=>$planArr['Plan']['id'],'token'=>$tokenId,'amount'=>$planArr['Plan']['amount'],'remarks'=>NULL,'status'=>'Pending','type'=>$this->paymentNamePPL,'date'=>$this->currentDateTime);
                $this->loadModel('MembersPayment');
                $this->MembersPayment->create();
                $this->MembersPayment->save($paymentArr);
                $this->redirect($token);            
            }
            catch (PaypalRedirectException $e)
            {
                $this->redirect($e->getMessage());
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Try again! Can not connect to paypal'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        else
        {
            $this->Session->setFlash(__('Invalid Amount'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function paypalpostpayment($id=null)
    {
        $this->authenticate();
        $this->loadModel('MembersPayment');
        if(isset($_REQUEST['token']) && isset($_REQUEST['PayerID']))
        {
            $token=$_REQUEST['token'];
            try
            {
                $detailsArr=$this->Paypal->getExpressCheckoutDetails($token);
                if(is_array($detailsArr))
                {
                    $planArr=$this->Session->read('Plan');
                    $name=$planArr['Plan']['name'];
                    $amount=$detailsArr['AMT'];
                    $description='';
                    $payerId=$_REQUEST['PayerID'];
                    if($detailsArr['ACK']=="Success")
                    {
                        $order = array(
                        'description' => $description,
                        'currency' => $this->currencyType,
                        'return' => $this->siteDomain.'/Payments/palpalpostpayment/',
                        'cancel' => $this->siteDomain.'/Payments/index/',
                        'items' => array(
                            0 => array(
                                'name' =>$name,
                                'tax' => 0.00,
                                'shipping' => 0.00,
                                'description' => $description,
                                'subtotal' => $amount,
                            ),
                            )
                        );
                        try
                        {
                            $paymentDetails=$this->Paypal->doExpressCheckoutPayment($order,$token,$payerId);
                            if(is_array($paymentDetails))
                            {
                                if($paymentDetails['PAYMENTINFO_0_PAYMENTSTATUS']=="Completed" && $paymentDetails['PAYMENTINFO_0_ACK']=="Success")
                                {
                                    $planArr=$this->Session->read('Plan');
                                    $transactionId=$paymentDetails['PAYMENTINFO_0_TRANSACTIONID'];
                                    $total=$this->MembersPayment->find('count',array('conditions'=>array('MembersPayment.token'=>$token,'MembersPayment.status'=>'Pending')));
                                    if($total>0)
                                    {
                                        $this->Session->write('OrderComplete', true);
                                        $this->orderComplete($token,$paymentDetails['PAYMENTINFO_0_TRANSACTIONID']);
                                        $this->Session->write('OrderComplete', false);
                                        $this->Session->write('Plan', null);
                                        $this->Session->setFlash(__("%s plan successfully purchased",$planArr['Plan']['name']),'flash',array('alert'=>'success'));
                                    }
                                    else
                                    {
                                        $this->Session->setFlash(__('Plan already purchased'),'flash',array('alert'=>'danger'));
                                    }
                                }
                            }
                        }
                        catch (PaypalRedirectException $e)
                        {
                            $this->redirect($e->getMessage());
                        }
                        catch (Exception $e)
                        {
                            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                        }                        
                    }
                    else
                    {
                        $this->Session->setFlash(__('Payment not done'),'flash',array('alert'=>'danger'));
                    }
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
        $this->redirect(array('action' => 'index'));
    }
    public function ccavenue()
    {
        $this->layout=null;
        if($this->CAE==false)
        {
            $this->Session->setFlash(__('Payment Setings not set'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Payments','action' => 'index'));
        }
        $planArr=$this->Session->read('Plan');
        $description=$planArr['Plan']['description'];
        $amount=number_format($planArr['Plan']['amount'],2);
        $name=$planArr['Plan']['name'];
        $record_arr=$planArr;
        if($record_arr)
        {
            $currency=$this->currencyType;
            $language="EN";
            $orderId=substr(rand().time(),0,15);
            $tid=substr(rand().time(),0,15);
            $merchant_id=$this->merchantIdAvenue;  // Merchant id(also User_Id)
            $access_code=$this->accessCode;  // Access id(also access_Code) 
            $amount=$amount;  // your script should substitute the amount here in the quotes provided here
            $order_id=$orderId;        //your script should substitute the order description here in the quotes provided here
            $redirectUrl=$this->siteDomain.'/Payments/ccavenuepostpayment/';//your redirect URL where your customer will be redirected after authorisation from CCAvenue
            $cancelUrl=$this->siteDomain.'/Payments/index/';
            $billing_name=$this->userValue['Member']['name'];
            $billing_address=$this->userValue['Member']['address'];
            $billing_city='';
            $billing_state='';
            $billing_zip='';
            $billing_country='';
            $billing_tel=$this->userValue['Member']['phone'];
            $billing_email=$this->userValue['Member']['email'];
            $delivery_name='';
            $delivery_address='';
            $delivery_city='';
            $delivery_state='';
            $delivery_zip='';
            $delivery_country='';
            $delivery_tel='';
            $additionalInfo1='';
            $additionalInfo2='';
            $additionalInfo3='';
            $additionalInfo4='';
            $additionalInfo5='';
            $promoCode='';
            $customerIdentifier='';
            $workingKey=$this->workingKey;	//Put in the 32 bit alphanumeric key in the quotes provided here.
            $merchant_data= 'tid='.$tid.'&merchant_id='.$merchant_id.'&order_id='.$order_id.'&amount='.$amount.'&currency='.$currency.'&redirect_url='.$redirectUrl.'&cancel_url='.$cancelUrl.'&language='.$language.'&billing_name='.$billing_name.'&billing_address='.$billing_address.'&billing_city='.$billing_city.'&billing_state='.$billing_state.'&billing_zip='.$billing_zip.'&billing_country='.$billing_country.'&billing_tel='.$billing_tel.'&billing_email='.$billing_email.'&delivery_name='.$delivery_name.'&delivery_address='.$delivery_address.'&delivery_city='.$delivery_city.'&delivery_state='.$delivery_state.'&delivery_zip='.$delivery_zip.'&delivery_country='.$delivery_country.'&delivery_tel='.$delivery_tel.'&merchant_param1='.$additionalInfo1.'&merchant_param2='.$additionalInfo2.'&merchant_param3='.$additionalInfo3.'&merchant_param4='.$additionalInfo4.'&merchant_param5='.$additionalInfo5.'&promo_code='.$promoCode.'&customer_identifier='.$customerIdentifier.'&';
            $encrypted_data=$this->Payment->encrypt($merchant_data,$workingKey); // Method for encrypting the data.
            $this->set('encrypted_data',$encrypted_data);
            $this->set('access_code',$access_code);
            $this->set('ccavenueUrl',$this->gatewayUrl);
            $paymentArr=array('member_id'=>$this->userId,'plan_id'=>$planArr['Plan']['id'],'token'=>$tid,'amount'=>$planArr['Plan']['amount'],'remarks'=>NULL,'status'=>'Pending','type'=>$this->paymentNameCAE,'date'=>$this->currentDateTime);
            $this->loadModel('MembersPayment');
            $this->MembersPayment->create();
            $this->MembersPayment->save($paymentArr);
        }
        else
        {
            $this->Session->setFlash(__('Invalid Amount'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function ccavenuepostpayment()
    {
        $this->authenticate();
        $workingKey=$this->workingKey;
        $encResponse=$_POST['encResp'];
        $rcvdString=$this->Payment->decrypt($encResponse,$workingKey);
        $order_status="";$transactionId="";$amount="";
	$decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);
        for($i = 0; $i < $dataSize; $i++) 
	{
            $information=explode('=',$decryptValues[$i]);
            if($i==0)
            $transactionId=$information[1];
            if($i==3)
            $order_status=$information[1];
            if($i==10)
            $amount=$information[1];
	}
        if($order_status==="Success")
	{
            $planArr=$this->Session->read('Plan');
            $details=json_encode($decryptValues);
            $this->loadModel('MembersPayment');
            $total=$this->MembersPayment->find('count',array('conditions'=>array('MembersPayment.token'=>$transactionId,'MembersPayment.status'=>'Pending')));
            if($total>0)
            {
                $this->Session->write('OrderComplete', true);
                $this->orderComplete($transactionId,$transactionId);
                $this->Session->write('OrderComplete', false);
                $this->Session->write('Plan', null);
                $this->Session->setFlash(__("%s plan successfully purchased",$planArr['Plan']['name']),'flash',array('alert'=>'success'));
            }
            else
            {
                $this->Session->setFlash(__('Plan already purchased'),'flash',array('alert'=>'danger'));
            }
	}
	else if($order_status==="Aborted")
	{
            $this->Session->setFlash(__("Thank you for shopping with us. We will keep you posted regarding the status of your order through e-mail"),'flash',array('alert'=>'danger'));            
	
	}
	else if($order_status==="Failure")
	{
            $this->Session->setFlash(__("Thank you for shopping with us. However,the transaction has been declined"),'flash',array('alert'=>'danger'));
	}
	else
	{
            $this->Session->setFlash(__("Security Error. Illegal access detected"),'flash',array('alert'=>'danger'));
	}
        $this->redirect(array('controller'=>'Payments','action' => 'index'));
    }
    public function payumoney()
    {
        $this->authenticate();
        if($this->PME==false)
        {
            $this->Session->setFlash(__('Payment Setings not set'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Payments','action' => 'index'));
        }
        $this->layout=null;
        $planArr=$this->Session->read('Plan');
        $description=$planArr['Plan']['description'];
        $amount=$planArr['Plan']['amount'];
        $name=$planArr['Plan']['name'];
        $record_arr=$planArr;
        if($record_arr)
        {
            $currency=$this->currencyType;
            $language="EN";
            $txnid=rand().time();
            $merchantId=$this->merchantId;  // Merchant id(also User_Id)
            $merchantKey=$this->merchantKey;  // Access id(also Merchant Key)
            $merchantSalt=$this->merchantSalt;  // Access id(also Merchant Salt)
            $serviceProvider=$this->serviceProvider;  // Service Provider(also payu_paisa) 
            $amount=$amount;  // your script should substitute the amount here in the quotes provided here
            $surl=$this->siteDomain.'/Payments/payumoneypostpayment/';//your redirect URL where your customer will be redirected after authorisation from PayUmoney
            $furl=$this->siteDomain.'/Payments/payumoneypostpayment/';//your redirect URL where your customer will be redirected after authorisation from PayUmoney
            $curl=$this->siteDomain.'/Payments/index/';
            $firstname=$this->userValue['Member']['name'];
            $email=$this->userValue['Member']['email'];
            $address1=$this->userValue['Member']['address'];
            $phone=$this->userValue['Member']['phone'];
            
            $productinfo = json_encode(array(array("name"=>$name,"description"=>$description,"value"=>$amount,"isRequired"=>"false")));
            $hashString = $this->merchantKey.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$merchantSalt;
            $hash = strtolower(hash('sha512', $hashString));
            $action = $this->payumoneyUrl . '/_payment';
            $this->set('action',$action);
            $this->set('hash',$hash);
            $this->set('merchantId',$merchantId);
            $this->set('merchantKey',$merchantKey);
            $this->set('merchantSalt',$merchantSalt);
            $this->set('txnid',$txnid);
            $this->set('amount',$amount);
            $this->set('productinfo',$productinfo);
            $this->set('email',$email);
            $this->set('firstname',$firstname);
            $this->set('surl',$surl);
            $this->set('furl',$furl);
            $this->set('curl',$curl);
            $this->set('address1',$address1);
            $this->set('phone',$phone);
            $this->set('serviceProvider',$serviceProvider);
            $paymentArr=array('member_id'=>$this->userId,'plan_id'=>$planArr['Plan']['id'],'token'=>$txnid,'amount'=>$planArr['Plan']['amount'],'remarks'=>NULL,'status'=>'Pending','type'=>$this->paymentNamePME,'date'=>$this->currentDateTime);
            $this->loadModel('MembersPayment');
            $this->MembersPayment->create();
            $this->MembersPayment->save($paymentArr);
        }
    }
    public function payumoneypostpayment()
    {
        $this->authenticate();
        if(!$_POST){
            $this->Session->setFlash(__("Security Error. Illegal access detected"),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Payments','action' => 'index'));
        }
        $status=$_POST['status'];
        $firstname=$_POST['firstname'];
        $amount=$_POST['amount'];
        $txnid=$_POST['txnid'];
        $posted_hash=$_POST['hash'];
        $key=$_POST['key'];
        $productinfo=$_POST['productinfo'];
        $email=$_POST['email'];
        $salt=$this->merchantSalt;
        if(isset($_POST['additionalCharges']))
        {
            $additionalCharges=$_POST['additionalCharges'];
            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        else
        {
            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);
	if ($hash != $posted_hash)
        {
            $this->Session->setFlash(__("Security Error. Illegal access detected"),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Payments','action' => 'index'));
	}      
        if($status==="success")
	{
            $transactionId=$txnid;
            $planArr=$this->Session->read('Plan');
            $this->loadModel('MembersPayment');
            $total=$this->MembersPayment->find('count',array('conditions'=>array('MembersPayment.token'=>$transactionId,'MembersPayment.status'=>'Pending')));
            if($total>0)
            {
                $this->Session->write('OrderComplete', true);
                $this->orderComplete($transactionId,$transactionId);
                $this->Session->write('OrderComplete', false);
                $this->Session->write('Plan', null);
                $this->Session->setFlash(__("%s plan successfully purchased",$planArr['Plan']['name']),'flash',array('alert'=>'success'));
            }
            else
            {
                $this->Session->setFlash(__('Plan already purchased'),'flash',array('alert'=>'danger'));
            }
	}
	elseif($status==="pending")
	{
            $this->Session->setFlash(__("Thank you for purchasing with us. We will keep you posted regarding the status of your order through e-mail"),'flash',array('alert'=>'danger'));            
	
	}
	elseif($status==="failure")
	{
            $this->Session->setFlash(__("Thank you for purchasing with us. However,the transaction has been declined"),'flash',array('alert'=>'danger'));
	}
	else
	{
            $this->Session->setFlash(__("Security Error. Illegal access detected"),'flash',array('alert'=>'danger'));
	}
        $this->redirect(array('controller'=>'Payments','action' => 'index'));
    }
    public function orderComplete($token,$transactionId)
    {
        $this->authenticate();
        $this->autoRender=false;
        if(!$this->Session->read('OrderComplete')){
            throw new NotFoundException(__('Invalid post'));
        }
        $planArr=$this->Session->read('Plan');
        if($planArr['Plan']['amount']==0){
            $this->loadModel('MembersContact');
            $membersContactArr=$this->MembersContact->findByMemberIdAndPlanId($this->userId,$planArr['Plan']['id']);
            if($membersContactArr){
                $this->Session->setFlash(__('Free plan already purchased.'),'flash',array('alert'=>'danger'));
                $this->redirect(array('controller'=>'Plans','action' => 'index'));
            }
        }
        $this->loadModel('MembersPayment');
        $memberPayment=$this->MembersPayment->findByTokenAndStatus($token,'Pending');
        $paymentArr=array('id'=>$memberPayment['MembersPayment']['id'],'transaction_id'=>$transactionId,'status'=>'Approved');
        if($this->MembersPayment->save($paymentArr))
        {
            $this->Payment->save(array('plan_id'=>$planArr['Plan']['id'],'amount'=>$planArr['Plan']['amount'],'type'=>'TS','date'=>$this->currentDateTime));
            $expiryDate=CakeTime::format($this->dtFormat,$this->CustomFunction->memberPlanContact($this->userId,$planArr['Plan']['id'],$this->currentDate)); 
            $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
            $email=$this->memberValue['Member']['email'];$memberName=$this->memberValue['Member']['name'];
            $mobileNo=$this->memberValue['Member']['phone'];
            $plan=$planArr['Plan']['name'];$amount=$planArr['Plan']['amount'];$date=CakeTime::format($this->dtFormat,$this->currentDateTime);
            $remarks="";
            if($email)
            {
                if($this->emailNotification)
                {                          
                    /* Send Email */
                    $this->loadModel('Emailtemplate');
                    $emailSettingArr=$this->Emailtemplate->findByType('PPD');
                    if($emailSettingArr['Emailtemplate']['status']=="Published")
                    {
                        $message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($email);
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->subject($emailSettingArr['Emailtemplate']['name']);
                        $Email->send($message);
                        /* End Email */
                    }
                }
            }
            if($this->smsNotification)
            {
                /* Send Sms */
                $this->loadModel('Smstemplate');
                $smsTemplateArr=$this->Smstemplate->findByType('PPD');
                if($smsTemplateArr['Smstemplate']['status']=="Published")
                {
                    $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                    $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                }
                /* End Sms */
            }
        }
    }
}