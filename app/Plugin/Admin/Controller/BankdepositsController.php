<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime', 'Utility');
class BankdepositsController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Bankdeposit.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        try{
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $cond= array();
        $this->Paginator->settings['conditions'] = array($this->Bankdeposit->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Bankdeposit', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Bankdeposit->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $recordArr=array('id'=>$this->request->data['Bankdeposit']['id'],'status'=>$this->request->data['Bankdeposit']['status'],'remarks'=>$this->request->data['Bankdeposit']['remarks']);
                if ($this->Bankdeposit->save($recordArr))
                {
                    if($this->request->data['Bankdeposit']['status']=="Approved"){
                        $recordArr=array();
                        $status=__('Approved');
                        $this->loadModel('Payment');
                        $this->loadModel('MembersPayment');
                        $transactionId=uniqid(rand());
                        $paymentArr=array('member_id'=>$post['Bankdeposit']['member_id'],'plan_id'=>$post['Bankdeposit']['plan_id'],'transaction_id'=>$transactionId,
                                         'amount'=>$post['Plan']['amount'],'remarks'=>$this->request->data['Bankdeposit']['remarks'],'status'=>'Approved','type'=>__('Bank Deposit'),'date'=>$this->currentDateTime);
                        if($this->MembersPayment->save($paymentArr))
                        { 
                            $this->Payment->save(array('Payment'=>array('plan_id'=>$post['Bankdeposit']['plan_id'],'amount'=>$post['Plan']['amount'],'type'=>'TS','date'=>$this->currentDateTime)));
                            $expiryDate=CakeTime::format($this->dtFormat,$this->CustomFunction->memberPlanContact($post['Bankdeposit']['member_id'],$post['Bankdeposit']['plan_id'],$this->currentDate));                            
                        
                            $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                            $email=$post['Member']['email'];$memberName=$post['Member']['name'];
                            $mobileNo=$post['Member']['phone'];
                            $plan=$post['Plan']['name'];$amount=$post['Plan']['amount'];$date=CakeTime::format($this->dtFormat,$post['Bankdeposit']['modified']);
                            $remarks=$this->request->data['Bankdeposit']['remarks'];
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
                    else
                    {
                        $status=__('Rejected');
                        $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                        $email=$post['User']['email'];$memberName=$post['User']['name'];
                        $mobileNo=$post['User']['mobile'];
                        $remarks=$this->request->data['Bankdeposit']['remarks'];
                        if($email)
                        {
                            if($this->emailNotification)
                            {                          
                                /* Send Email */
                                $this->loadModel('Emailtemplate');
                                $emailSettingArr=$this->Emailtemplate->findByType('PPR');
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
                            $smsTemplateArr=$this->Smstemplate->findByType('PPR');
                            if($smsTemplateArr['Smstemplate']['status']=="Published")
                            {
                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                            }
                            /* End Sms */
                        }
                    }
                    $this->Session->setFlash(__('Record has been %s',$status),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        $this->request->data = $post;
    }
    public function delete($id) {
        if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
        }
        if ($this->Bankdeposit->delete($id)) {
        $this->Session->setFlash(__('Record has been deleted'),'flash',array('alert'=>'success'));
        return $this->redirect(array('action' => 'index'));
        }
    }
}