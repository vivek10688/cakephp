<?php
App::uses('CakeTime', 'Utility');
class MailsController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Mail.date'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->mailType=$this->userValue['Member']['user_name'];
        $this->loadModel('Dashboard');
        $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
    }
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'mail_type'=>'To','status <>'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Mail', $this->Paginator->paginate());
        $this->set('mailType',$this->mailType);
        $this->set('mailPageName','Inbox');
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function sent()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'mail_type'=>'From','status <>'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Mail', $this->Paginator->paginate());
        $this->set('mailType',$this->mailType);
        $this->set('mailPageName','Sent Message');
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        else
        $this->render('index');
    }
    public function trash()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'status'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Mail', $this->Paginator->paginate());
        $this->set('mailType',$this->mailType);
        $this->set('mailPageName','Trash');
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        else
        $this->render('index');
    }
    public function compose($type=null,$id=null)
    { 
        if ($this->request->is('post'))
        {
            try
            {
                $this->loadModel('Member');
                $this->loadModel('User');
                $adminArr=$this->User->findById(1);
                $adminName=$adminArr['User']['name'];
                $memberArr=$this->Member->findByUserNameAndStatus($this->request->data['Mail']['to_email'],'Active');
                if($this->request->data['Mail']['to_email']!=$adminName)
                {
                    $this->loadModel('MembersVprofile');
                    $memberVArr=$this->MembersVprofile->findByMemberIdAndViewerId($this->userValue['Member']['id'],$memberArr['Member']['id']);
                    if(!$memberVArr)
                    {
                        $this->Session->setFlash(__('You can not send message without viewing profile'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                if($memberArr || $this->request->data['Mail']['to_email']==$adminName)
                {
                    $this->Mail->create();
                    $toEmail=$this->request->data['Mail']['to_email'];
                    $currentDateTime=$this->currentDateTime;
                    $this->request->data['Mail']['date']=$currentDateTime;
                    $this->request->data['Mail']['from_email']=$this->mailType;
                    $this->request->data['Mail']['email']=$this->request->data['Mail']['to_email'];
                    if ($this->Mail->save($this->request->data))
                    {
                        $this->Mail->create();
                        $this->request->data['Mail']['to_email']=$toEmail;
                        $this->request->data['Mail']['from_email']=$this->mailType;
                        $this->request->data['Mail']['email']=$this->mailType;
                        $this->request->data['Mail']['type']="Read";
                        $this->request->data['Mail']['mail_type']="From";                        
                        $this->Mail->save($this->request->data);
                        $this->Session->setFlash(__('Message has been sent'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Invalid User Name'),'flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        if($type=="new"){
            $this->request->data['Mail']['to_email']=$id;
        }
        else{
            $post = $this->Mail->findById($id);
            if($post)
            {
                if($post['Mail']['to_email']==$this->mailType)
                $this->request->data['Mail']['to_email']=$post['Mail']['from_email'];
                else
                $this->request->data['Mail']['to_email']=$post['Mail']['to_email'];
                $this->request->data['Mail']['subject']=$post['Mail']['subject'];
                if($type=="forward")
                {
                    $message="<p>----------".__('Forwarded message')."----------</p>\n<p>".__('From').": ".$this->request->data['Mail']['to_email']."</p>\n<p>".CakeTime::format('D, M d, Y',$post['Mail']['date']).".__('at').".CakeTime::format('h:i A',$post['Mail']['date']).
                    "</p>\n<p>".__('Subject').":".$this->request->data['Mail']['subject']."</p>\n";
                    $this->request->data['Mail']['message']=$message.$post['Mail']['message'];
                }
            }
        }
    }
    
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Mail->findById($id);
        $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
        if($post)
        $this->Mail->save(array('id'=>$id,'type'=>'Read'));
        $this->set('post',$post);
    }
    public function trashall()
    {
        try
        {
            if($this->data['type']=="read")
            {
                $this->moveMark($this->data,"Read");
            }
            elseif($this->data['type']=="unread")
            {
                $this->moveMark($this->data,"Unread");
            }
            else
            {
                if ($this->request->is('post'))
                {
                    $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                    if($this->data['Mail']['id'])
                    {
                        foreach($this->data['Mail']['id'] as $key => $value)
                        {
                            if($value>0)
                            $this->Mail->save(array('id'=>$value,'status'=>'Trash'));
                        }
                    }
                    $this->Session->setFlash(__('The mail has been moved to the Trash'),'flash',array('alert'=>'success'));
                }        
                $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    } 
    public function deleteall()
    {
        try
        {
            if($this->data['type']=="inbox")
            {
                $this->moveInbox($this->data,"Inbox");
            }
            else
            {
                if ($this->request->is('post'))
                {
                    if($this->data['Mail']['id'])
                    {
                        foreach($this->data['Mail']['id'] as $key => $value)
                        {
                            $this->Mail->delete($value);
                        }
                    }
                    $this->Session->setFlash(__('Your Mail has been deleted'),'flash',array('alert'=>'success'));
                }        
                $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function moveInbox($record)
    {
        try
        {
            if ($record)
            {
                $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                if($this->data['Mail']['id'])
                {
                    foreach($record['Mail']['id'] as $key => $value)
                    {
                        if($value>0)
                        $this->Mail->save(array('id'=>$value,'status'=>'Live'));
                    }
                }
                $this->Session->setFlash(__('The mail has been moved to the Inbox'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'trash'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function moveMark($record,$type)
    {
        try
        {
            if ($record)
            {
                $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                if($this->data['Mail']['id'])
                {
                    foreach($record['Mail']['id'] as $key => $value)
                    {
                        if($value>0)
                        $this->Mail->save(array('id'=>$value,'type'=>$type));
                    }
                }
                if($type=="Read")
                {
                    $this->Session->setFlash(__("The mail has been marked as Read"),'flash',array('alert'=>'success'));
                }
                else
                {
                   $this->Session->setFlash(__("The mail has been marked as Unread"),'flash',array('alert'=>'success')); 
                }
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    } 
}
