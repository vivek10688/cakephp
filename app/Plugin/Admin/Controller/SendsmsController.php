<?php
ini_set('max_execution_time', 900);
class SendsmsController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index()
    {
        $this->loadModel('Smssetting');
        $this->loadModel('Smstemplate');
        $this->loadModel('Member');
        $this->set('smsTemplate',$this->Smstemplate->find('list',array('fields'=>array('description','name'),'conditions'=>array('status'=>'Published','type'=>NULL),'order'=>array('name'=>'asc'))));
        $smsSettingArr=$this->Smssetting->findById(1);
        $smsMessage=null;
        if($this->request->is('post'))
        {
            try
            {
                $type=$this->request->data['Sendsms']['type'];
                $emailTemplate=$this->request->data['Sendsms']['sms_template'];
                $memberId=$this->request->data['Sendsms']['member_id'];
                $anySms=$this->request->data['Sendsms']['any_sms'];
                $message=$this->request->data['Sendsms']['message'];
                if($type==null)
                {
                    $this->Session->setFlash(__('Please select any type in the list'),'flash',array('alert'=>'danger'));
                }
                elseif($type=='Any' && $anySms==null)
                {
                    $this->Session->setFlash(__('Please type any name'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    $toSmsArr=null;
                    if($type=="Member" && $memberId!=null)
                    {
                        $toSmsArr=explode(",",$memberId);
                    }
                    if($type=="Member" && $memberId==null)
                    {
                        $typeArr=$this->Member->find('all',array('fields'=>array('Member.phone'),'conditions'=>array('Member.status'=>'Active')));
                        foreach($typeArr as $value)
                        $toSmsArr[]=$value['Member']['phone'];
                        unset($value);
                    }
                   if($type=="Any")
                    {
                        $toSmsArr=explode(",",$anySms);
                        
                    }
                    if($toSmsArr)
                    {
                        foreach($toSmsArr as $toSms)
                        {
                            if($toSms)
                            {
                                $smsMessage=$this->CustomFunction->sendSms($toSms,$message,$smsSettingArr);
                            }
                        }
                        $this->Session->setFlash($smsMessage,'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('No sms to send'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function membersearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Member');
        $term = $this->request->query['q'];
        $users = $this->Member->find('all',array('conditions' => array('Member.name LIKE' => '%'.$term.'%')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Member']['phone'];
            $result[$key]['text'] = $user['Member']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    
}