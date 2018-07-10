<?php
App::uses('CakeTime', 'Utility');
class DashboardsController extends AppController
{
   public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);        
    }
    public function deactive($id = null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Dashboard->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
            try
            {
                $record=array('id'=>$id,'status'=>'Suspend');
               // $this->Dashboard->unbindValidation('remove', array('user_name','email','name','password','address','phone','dob','sex','country_id','state_id','city_id','birth_place'), true);
                if ($this->Dashboard->save($record))
                {
                  $this -> Session -> destroy();
                    $this->Session->setFlash(__('Profile Deactivated Successfully'),'flash',array('alert'=>'success'));
                    $this->redirect(array('controller'=>'Users','action' => 'login'));
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
    }
}
