<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class RegistersController extends AppController
{
    var $components = array('CustomFunction');
    var $helpers = array('Captcha');
    public function beforeFilter()
    {
        parent::beforeFilter();
        if($this->frontRegistration==0)
        return $this->redirect(array('controller'=>'','action'=>'index'));
    }
    public function captcha() {
        $this->autoRender = false;
        $this->layout='ajax';
        if(!isset($this->Captcha)) { //if Component was not loaded through $components array()
        $this->Captcha = $this->Components->load('Captcha', array(
        'width' => 150,
        'height' => 50,
        'theme' => 'random', //possible values : default, random ; No value means 'default'
        )); //load it
        }
        $this->Captcha->create();
    }
    public function index()
    {
        $this->loadModel("Maritialstatus");
        $this->loadModel("Religion");
        $this->loadModel("Occupation");
        $this->loadModel("Habit");
        $this->loadModel("State");
        $this->set('status',$this->Maritialstatus->find('list'));
        $this->set('religion',$this->Religion->find('list'));
        $this->set('occupation',$this->Occupation->find('list'));
        $this->set('habbit',$this->Habit->find('list'));
        $this->set('state',$this->State->find('list'));
        $this->Captcha = $this->Components->load('Captcha', array('captchaType'=>$this->captchaType, 'jquerylib'=>false, 'modelName'=>'Register', 'fieldName'=>'captcha')); //load it
        if(!isset($this->Captcha))
        {
            //if Component was not loaded throug $components array()
            $this->Captcha = $this->Components->load('Captcha'); //load it
        }
        if(isset($this->request->data['Register']['captcha']))
        {
            $plainPassword=$this->request->data['Register']['password'];
            if($this->request->data['Register']['captcha']==$this->Captcha->getVerCode())
            {
                if ($this->request->is('post'))
                {
                    try
                    {
                            $profileId=substr(rand(),0,6);
                            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                            $password=$this->request->data['Register']['password'];
                            $this->request->data['Register']['password'] = $passwordHasher->hash($password);
                            $this->request->data['Register']['reg_code']=$this->CustomFunction->generate_rand();
                            $this->request->data['Register']['reg_status']="Live";
                            $this->request->data['Register']['renewal_date']=$this->currentDate;
                            $this->request->data['Register']['profileId']=$profileId;
                            unset($this->request->data['Register']['status']);
                            $this->Register->create();
                            if($this->Register->save($this->request->data))
                            {
                                $photoName=$this->request->data['Register']['photoimg']['name'];
                                $photoTmp=$this->request->data['Register']['photoimg']['tmp_name'];
                                $fileName=$this->CustomFunction->upload($photoTmp,$photoName,'member',$this->siteOrganization);
                                if(strlen($fileName)>0)
                                {
                                    $this->Register->unbindValidation('remove', array('user_name','email','name','password','phone'), true);
                                    $record=array('Register'=>array('id'=>$this->Register->id,'photo'=>$fileName));
                                    $this->Register->save($record);
                                }
                                $memberName=$this->request->data['Register']['name'];
                                $code=$this->request->data['Register']['reg_code'];
                                $email=$this->request->data['Register']['email'];
                                $mobileNo=$this->request->data['Register']['phone'];
                                $rand1=$this->CustomFunction->generate_rand(35);
                                $rand2=rand();
                                $url="$this->siteDomain/Emailverifications/emailcode/$code/$rand1/$rand2";
                                $siteName=$this->siteName;
                                $siteEmailContact=$this->siteEmailContact;
                                
                                    /* Send Email */
                                    $this->loadModel('Emailtemplate');
                                    $emailTemplateArr=$this->Emailtemplate->findByType('SRN');
                                    if($emailTemplateArr['Emailtemplate']['status']=="Published")
                                    {
                                        $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                                        $Email = new CakeEmail();
                                        $Email->transport($this->emailSettype);
                                        if($this->emailSettype=="Smtp")
                                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                                        $Email->from(array($this->siteEmail =>$this->siteName));
                                        $Email->to($email);
                                        $Email->template('default');
                                        $Email->emailFormat('html');
                                        $Email->subject($emailTemplateArr['Emailtemplate']['name']);
                                        $Email->send($message);
                                    
                                    /* End Email */
                                    }
                                if($this->smsNotification)
                                {
                                    /* Send Sms */
                                    $this->loadModel('Smstemplate');
                                    $smsTemplateArr=$this->Smstemplate->findByType('SRN');
                                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                                    {
                                        $url="$this->siteDomain";
                                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                        
                                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                                    }
                                    /* End Sms */
                                }
                                $this->Session->setFlash(__('A verification Code send to your Email inbox or Spam'),'flash',array('alert'=>'success'));
                                return $this->redirect(array('controller'=>'Emailverifications','action' => 'index'));
                            }
                            $this->request->data['Register']['password']=$plainPassword;
                    }
                    catch (Exception $e)
                    {
                        $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                    }
                }            
            }
            else
            {
                $this->Session->setFlash(__('Invalid Security Code'),'flash',array('alert'=>'danger'));
            }
        }
    }
}
