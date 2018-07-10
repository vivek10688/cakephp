<?php
class SearchesController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1);
    public function quick()
    {
	$this->index('Quick');
	$this->render('index');
    }
    public function regular()
    {
	$this->index('Regular');
	$this->render('index');
    }
    public function advanced()
    {
	$this->index('Advanced');
	$this->render('index');
    }
    public function profile()
    {
	$this->index('Profile');
	$this->render('index');
    }
    public function index($name=null)
    {
        try{
	    $countryId=null;$stateId=null;$religionId=null;
            $this->loadModel('Dashboard');
	    $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
	    
            $this->loadModel('Religion');
            $this->loadModel('Education');
	    $this->loadModel('Mothertongue');
	    $this->loadModel('State');
	    $this->loadModel('City');
	    $this->loadModel('Habit');
	    $this->loadModel('Maritialstatus');
            $this->loadModel('Country');
            $this->loadModel('Caste');
            $this->loadModel('Occupation');
            $this->loadModel('Employed');
            $this->set('religion',$this->Religion->find('all',array('order'=>array('name'=>'asc'))));

            $this->set('mothertongue',$this->Mothertongue->find('all',array('order'=>array('name'=>'asc'))));

            $this->set('state',$this->State->find('all',array('order'=>array('name'=>'asc'))));

            $this->set('habitName',$this->Habit->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('maritialstatus',$this->Maritialstatus->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('country',$this->Country->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('mothertongueName',$this->Mothertongue->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('religionName',$this->Religion->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('educationName',$this->Education->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('occupationName',$this->Occupation->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('employedName',$this->Employed->find('list',array('order'=>array('name'=>'asc'))));

            $this->set('name',$name);
	    if ($this->request->is('post'))
            {
		$countryId=$this->request->data['Search']['country_id'];
		$stateId=$this->request->data['Search']['state_id'];
		$cityId=$this->request->data['Search']['city_id'];
	    }	
	    $stateName=$this->State->find('list',array('order'=>array('name'=>'asc'),
						       'conditions'=>array('State.country_id'=>$countryId)));
            $this->set('stateName',$stateName);
	    $cityName=$this->City->find('list',array('order'=>array('name'=>'asc'),
						     'conditions'=>array('City.state_id'=>$stateId)));
            $this->set('cityName',$cityName);
	    $casteName=$this->Caste->find('list',array('order'=>array('name'=>'asc'),
						       'conditions'=>array('Caste.religion_id'=>$religionId)));
            $this->set('casteName',$casteName);
            
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
       
}
