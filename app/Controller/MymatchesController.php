<?php
class MymatchesController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Mymatch.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
	$this->authenticate();
        $this->memberId=$this->userValue['Member']['id'];        
    }
    public function index($id=null,$name=null)
    {
        try
        {
	    $this->loadModel('Dashboard');
	    $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);

	    $this->loadModel('Expressinterest');
	    $expressArr=$this->Expressinterest->findByMemberId($this->memberId);
	    if(!$expressArr)
	    {
		$this->Session->setFlash('No Match found ! Please set Express Intereset','flash',array('alert'=>'danger'));
		$this->redirect(array('controller'=>'Expressinterests','action' => 'index','No'));
	    }
            $searchArr=array();
	    if(isset($expressArr['Expressinterest']['sex']) && strlen($expressArr['Expressinterest']['sex'])>0)
            {
              $searchArr[]=array('Mymatch.sex'=>$expressArr['Expressinterest']['sex']);
            }
	    if(isset($expressArr['Expressinterest']['family_status']) && strlen($expressArr['Expressinterest']['family_status'])>0)
            {
              $searchArr[]=array('Mymatch.family_status'=>$expressArr['Expressinterest']['family_status']);
            }
	    if(isset($expressArr['Expressinterest']['family_type']) && strlen($expressArr['Expressinterest']['family_type'])>0)
            {
              $searchArr[]=array('Mymatch.family_type'=>$expressArr['Expressinterest']['family_type']);
            }
	    if(isset($expressArr['Expressinterest']['family_value']) && strlen($expressArr['Expressinterest']['family_value'])>0)
            {
              $searchArr[]=array('Mymatch.family_value'=>$expressArr['Expressinterest']['family_value']);
            }
	    if(isset($expressArr['Expressinterest']['body_type']) && strlen($expressArr['Expressinterest']['body_type'])>0)
            {
              $searchArr[]=array('Mymatch.body_type'=>$expressArr['Expressinterest']['body_type']);
            }
	    if(isset($expressArr['Expressinterest']['children']) && strlen($expressArr['Expressinterest']['children'])>0)
            {
              $searchArr[]=array('Mymatch.children'=>$expressArr['Expressinterest']['children']);
            }
	    if(isset($expressArr['Expressinterest']['complexion']) && strlen($expressArr['Expressinterest']['complexion'])>0)
            {
              $searchArr[]=array('Mymatch.complexion'=>$expressArr['Expressinterest']['complexion']);
            }
	    if(isset($expressArr['Expressinterest']['physical']) && strlen($expressArr['Expressinterest']['physical'])>0)
            {
              $searchArr[]=array('Mymatch.physical'=>$expressArr['Expressinterest']['physical']);
            }
	    if(isset($expressArr['Expressinterest']['manglik']) && strlen($expressArr['Expressinterest']['manglik'])>0)
            {
              $searchArr[]=array('Mymatch.manglik'=>$expressArr['Expressinterest']['manglik']);
            }
	    if(isset($expressArr['Expressinterest']['height_id']) && strlen($expressArr['Expressinterest']['height_id'])>0)
            {
              $searchArr[]=array('Mymatch.height_id'=>$expressArr['Expressinterest']['height_id']);
            }
	    if(isset($expressArr['Expressinterest']['occupation_id']) && strlen($expressArr['Expressinterest']['occupation_id'])>0)
            {
              $searchArr[]=array('Mymatch.occupation_id'=>$expressArr['Expressinterest']['occupation_id']);
            }
	    if(isset($expressArr['Expressinterest']['education_id']) && strlen($expressArr['Expressinterest']['education_id'])>0)
            {
              $searchArr[]=array('Mymatch.education_id'=>$expressArr['Expressinterest']['education_id']);
            }
	    if(isset($expressArr['Expressinterest']['employed_id']) && strlen($expressArr['Expressinterest']['employed_id'])>0)
            {
              $searchArr[]=array('Mymatch.employed_id'=>$expressArr['Expressinterest']['employed_id']);
            }
	    if(isset($expressArr['Expressinterest']['caste_id']) && strlen($expressArr['Expressinterest']['caste_id'])>0)
            {
              $searchArr[]=array('Mymatch.caste_id'=>$expressArr['Expressinterest']['caste_id']);
            }
            
            if(isset($expressArr['Expressinterest']['rashy_id']) && strlen($expressArr['Expressinterest']['rashy_id'])>0)
            {
              $searchArr[]=array('Mymatch.rashy_id'=>$expressArr['Expressinterest']['rashy_id']);
            }
            if(isset($expressArr['Expressinterest']['state_id']) && strlen($expressArr['Expressinterest']['state_id'])>0)
            {
              $searchArr[]=array('Mymatch.state_id'=>$expressArr['Expressinterest']['state_id']);
            }
            if(isset($expressArr['Expressinterest']['habit_id']) && strlen($expressArr['Expressinterest']['habit_id'])>0)
            {
              $searchArr[]=array('Mymatch.habit_id'=>$expressArr['Expressinterest']['habit_id']);
            }
            if(isset($expressArr['Expressinterest']['maritialstatus_id']) && strlen($expressArr['Expressinterest']['maritialstatus_id'])>0)
            {
              $searchArr[]=array('Mymatch.maritialstatus_id'=>$expressArr['Expressinterest']['maritialstatus_id']);
            }
            if(isset($expressArr['Expressinterest']['country_id']) && strlen($expressArr['Expressinterest']['country_id'])>0)
            {
              $searchArr[]=array('Mymatch.country_id'=>$expressArr['Expressinterest']['country_id']);
            }
	    if(isset($expressArr['Expressinterest']['city_id']) && strlen($expressArr['Expressinterest']['city_id'])>0)
            {
              $searchArr[]=array('Mymatch.city_id'=>$expressArr['Expressinterest']['city_id']);
            }
            if(isset($expressArr['Expressinterest']['religion_id']) && strlen($expressArr['Expressinterest']['religion_id'])>0)
            {
              $searchArr[]=array('Mymatch.religion_id'=>$expressArr['Expressinterest']['religion_id']);
            }
            if(isset($expressArr['Expressinterest']['mothertongue_id']) && strlen($expressArr['Expressinterest']['mothertongue_id'])>0)
            {
              $searchArr[]=array('Mymatch.mothertongue_id'=>$expressArr['Expressinterest']['mothertongue_id']);
            }
            $searchArr[]=array('status'=>'Active');
	    $searchArr[]=array('Mymatch.id <>'=>$this->memberId);
	    $this->Paginator->settings['fields']=array('Mymatch.*','TIMESTAMPDIFF(YEAR,Mymatch.dob, CURDATE()) age','Occupation.*','City.*','Habit.*','Maritialstatus.*','Rashy.*','Caste.*','Religion.*','Employed.*','Mothertongue.*','Country.*','State.*','Education.*','Height.*');
            $this->Prg->commonProcess();
            $this->Paginator->settings['conditions']=array($searchArr);
	    $this->Paginator->settings['joins']=array(array('table'=>'members_expressinterests','type'=>'LEFT','alias'=>'MembersExpressinterest','conditions'=>array('Mymatch.id=MembersExpressinterest.member_id')));
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $post=$this->Paginator->paginate();
            $this->set('memberId',$this->adminId);
            $this->set('post',$post);
	    if ($this->request->is('ajax'))
            {
               $this->render('index','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e.$e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    
    
}
