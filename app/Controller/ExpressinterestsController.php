<?php
App::uses('CakeTime','Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ExpressinterestsController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Time');
    public $components = array('Session');
    public $presetVars = true;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index($modal='Yes')
    {
	$countryId=null;$stateId=null;$religionId=null;
        $this->loadModel('Religion');
        $this->loadModel('Caste');
        $this->loadModel('State');
        $this->loadModel('City');
        $this->loadModel('Country');
        $this->loadModel('Education');
        $this->loadModel('Mothertongue');
        $this->loadModel('Habit');
        $this->loadModel('Maritialstatus');        
        $this->loadModel('Occupation');
        $this->loadModel('Employed');
        $this->loadModel('Height');
        $this->loadModel('Rashy');
        $this->set('religionName',$this->Religion->find('list'));
        $this->set('countryName',$this->Country->find('list'));
        $this->set('educationName',$this->Education->find('list'));
        $this->set('mothertongueName',$this->Mothertongue->find('list'));
        $this->set('habitName',$this->Habit->find('list'));
        $this->set('maritialstatusName',$this->Maritialstatus->find('list'));
        $this->set('occupationName',$this->Occupation->find('list'));
        $this->set('employedName',$this->Employed->find('list'));
        $this->set('heightName',$this->Height->find('list'));
        $this->set('rashiName',$this->Rashy->find('list'));
        $id=$this->userValue['Member']['id'];
        $post=$this->Expressinterest->findByMemberId($id);
	if($post)
	{
	    $countryId=$post['Expressinterest']['country_id'];
	    $stateId=$post['Expressinterest']['state_id'];
	    $religionId=$post['Expressinterest']['religion_id'];
	}
	$this->loadModel('Dashboard');
	$this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
        if ($this->request->is(array('post', 'put')))
        {
	    try
            {
		if($post){
		    $this->request->data['Expressinterest']['id']=$post['Expressinterest']['id'];
		}        
		$this->request->data['Expressinterest']['member_id']=$id;
		if ($this->Expressinterest->save($this->request->data))
		{
		    $this->Session->setFlash(__('Express Interest Save Successfully'),'flash',array('alert'=>'success'));
		    if($modal=="Yes"){
			$this->redirect(array('controller'=>'Dashboards','action' => 'index'));
		    }
		    else{
			$this->redirect(array('controller'=>'Expressinterests','action' => 'index',$modal));
		    }
		}
	    }
	    catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
            $this->set('isError',true);
        }
	else
        {
            if($modal=="Yes"){
		$this->layout = null;
		$this->set('isError',false);
	    }
	    else{
		$this->set('isError',true);
	    }
        }
	$stateName=$this->State->find('list',array('conditions'=>array('State.country_id'=>$countryId)));
	$this->set('stateName',$stateName);
	$cityName=$this->City->find('list',array('conditions'=>array('City.state_id'=>$stateId)));
	$this->set('cityName',$cityName);
	$casteName=$this->Caste->find('list',array('conditions'=>array('Caste.religion_id'=>$religionId)));
        $this->set('casteName',$casteName);
	$this->set('modal',$modal);
	if (!$this->request->data)
        {
            $this->request->data = $post;
        }        
    }
}
