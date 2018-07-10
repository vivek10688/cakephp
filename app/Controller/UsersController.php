<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class UsersController extends AppController
{
    var $name = 'Users';
    var $helpers = array('Form');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function login($page=null)
    {
        if (empty($this->data['User']['email']) == false)
        {
            $this->loadModel('Member');
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);            
            $user = $this->Member->find('first',array('conditions' => array('OR'=>array('Member.email' =>array($this->data['User']['email']),'Member.user_name'=>$this->data['User']['email']),'Member.password' =>$password)));
            if($user != false)
            {
                if($user['Member']['status']=="Active")
                {
                    $expiryDays=$user['Member']['expiry_days'];
                    if($expiryDays>0)
                    {
                        $expiryDate=date('Y-m-d',strtotime($user['Member']['renewal_date']."+$expiryDays days"));
                        if($this->currentDate>$expiryDate)
                        {
                            $this->Session->setFlash(__('Your account has expired. Please contact administrator'),'flash', array('alert'=> 'danger'));
                            $this->redirect(array('action' => 'login'));
                            exit(); 
                        }
                    }
                    $sessionId=time().rand();
                    $recordArr=array('Member'=>array('id'=>$user['Member']['id'],'last_login'=>$this->currentDateTime,'session_id'=>$sessionId));
                    $this->Member->save($recordArr);
                    $user=$this->Member->findById($user['Member']['id']);
                    $this->Session->setFlash(__('You have been logged in successfully'),'flash', array('alert'=> 'success'));
                    $this->Session->write('Member', $user);
                    $planArr=$this->Session->read('Plan');
                    if($planArr){
                        $this->redirect(array('controller' => 'Payments', 'action' => 'paymentgateway',$planArr['Plan']['id'],$planArr['Plan']['gateway']));
                    }
                    else if($page=='Viewprofiles')
                    {
                       $this->redirect(array('controller' => 'Viewprofiles', 'action' => 'index')); 
                    }
                    else if($page=='Pages')
                    {
                       $this->redirect(array('controller' => 'Pages', 'action' => '../')); 
                    }
                    else{
                        $this->redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                    }
                    exit();
                }
                elseif($user['Member']['status']=="Pending" && $user['Member']['reg_status']=="Live")
                {
                    $this->Session->setFlash(__('Your email not verified! Please click on link sent to your email inbox or spam'),'flash', array('alert'=> 'danger'));
                    $this->redirect(array('action' => 'login'));
                    exit();
                }
                else
                {
                    $status=$user['Member']['status'];
                    $this->Session->setFlash(__d('default','You are %s Member! Please contact administrator',$status),'flash', array('alert'=> 'danger'));
                    $this->redirect(array('action' => 'login'));
                    exit();
                }
            }
            else
            {
                $this->Session->setFlash(__('Incorrect username/password'),'flash', array('alert'=> 'danger'));
                $this->redirect(array('action' => 'login'));
                exit();
            }
        } 
    }
    public function logout()
    {
        $this -> Session -> destroy();
        $this -> Session -> setFlash(__('You have been logged out successfully'),'flash', array('alert'=> 'success'));
        $this -> redirect(array('action' => 'login'));
        exit();
    }    
}
