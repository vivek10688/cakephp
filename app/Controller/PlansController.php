<?php
App::uses('Paypal', 'Paypal.Lib');
class PlansController extends AppController {
    public function beforeFilter()
    {
	parent::beforeFilter();
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
            $this->merchantId=$paySetting['PaypalConfig']['username'];
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
    public function index()
    {
         try{
           $this->loadModel('Plan');
           $this->loadModel('Content');
           $this->set('plan',$this->Plan->find('all'));
           $bankArr=$this->Content->findByPageUrl('Bank-Detail');
	   $this->set('bankDetail',$bankArr['Content']['main_content']);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function bankdeposit($id=null)
    {
	parent::beforeFilter();
        $this->authenticate();
	$userId=$this->userValue['Member']['id'];
	$this->set('id',$id);
	$this->set('plan',$this->Plan->find('list'));
	if ($this->request->is(array('post', 'put')))
        {
            try
            {
		$this->loadModel('Bankdeposit');
		$post=$this->Bankdeposit->findByMemberIdAndStatus($userId,'Pending');
		if(!$post)
		{
		    $recordArr=array('member_id'=>$userId,'plan_id'=>$this->request->data['Plan']['plan'],'transaction_id'=>$this->request->data['Plan']['transaction_no'],
				     'user_remarks'=>$this->request->data['Plan']['remarks'],'status'=>'Pending');
		    $this->Bankdeposit->save($recordArr);
		    $this->Session->setFlash(__('Thanks for bank deposit. Please wait for approval.'),'flash',array('alert'=>'success'));
		    return $this->redirect(array('action' => 'index'));
		}
		else
		{
		    $this->Session->setFlash(__('Your previous request pending! Please wait for approval'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
		
	    }
	    catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
    }
}
