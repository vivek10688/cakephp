<?php
class ViewprofilesController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1);
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->memberId=$this->userValue['Member']['id'];        
    }
    public function index($id=null,$name=null)
    {
        try
        {            
            $searchArr=array();
            if(isset($this->params['named']['photo']) && $this->params['named']['photo']>0)
            {
              $searchArr[]=array('Viewprofile.photo <>'=>null);
            }
            if(isset($this->params['named']['rashi']) && $this->params['named']['rashi']>0)
            {
              $searchArr[]=array('Viewprofile.rashy_id <>'=>null);
            }
            if(isset($this->params['named']['profileId']) && strlen($this->params['named']['profileId'])>0)
            {
              $searchArr[]=array('Viewprofile.profileId'=>$this->params['named']['profileId']);
            }
            if(isset($this->params['named']['sex']) && strlen($this->params['named']['sex'])>0)
            {
              $searchArr[]=array('sex'=>$this->params['named']['sex']);
            }
            if(isset($this->params['named']['state_id']) && strlen($this->params['named']['state_id'])>0)
            {
              $searchArr[]=array('Viewprofile.state_id'=>$this->params['named']['state_id']);
            }
	    if(isset($this->params['named']['city_id']) && strlen($this->params['named']['city_id'])>0)
            {
              $searchArr[]=array('Viewprofile.city_id'=>$this->params['named']['city_id']);
            }
            
            $searchageArr=null;
            if(isset($this->params['named']['age_from']) && isset($this->params['named']['age_to']) && strlen($this->params['named']['age_from'])>0 && strlen($this->params['named']['age_to'])>0)
            {
              $searchageArr='TIMESTAMPDIFF(YEAR,Viewprofile.dob, CURDATE()) >='.$this->params['named']['age_from'].' AND '.'TIMESTAMPDIFF(YEAR,Viewprofile.dob, CURDATE()) <='.$this->params['named']['age_to'];
            }
            
            if(isset($this->params['named']['habit_id']) && strlen($this->params['named']['habit_id'])>0)
            {
              $searchArr[]=array('Viewprofile.habit_id'=>$this->params['named']['habit_id']);
            }
            if(isset($this->params['named']['maritialstatus_id']) && strlen($this->params['named']['maritialstatus_id'])>0)
            {
              $searchArr[]=array('Viewprofile.maritialstatus_id'=>$this->params['named']['maritialstatus_id']);
            }
            if(isset($this->params['named']['country_id']) && strlen($this->params['named']['country_id'])>0)
            {
              $searchArr[]=array('Viewprofile.country_id'=>$this->params['named']['country_id']);
            }
            if(isset($this->params['named']['religion_id']) && strlen($this->params['named']['religion_id'])>0)
            {
              $searchArr[]=array('Viewprofile.religion_id'=>$this->params['named']['religion_id']);
            }
            if(isset($this->params['named']['mothertongue_id']) && strlen($this->params['named']['mothertongue_id'])>0)
            {
              $searchArr[]=array('Viewprofile.mothertongue_id'=>$this->params['named']['mothertongue_id']);
            }
            if($name=="religion")
            {
              $searchArr[]=array('Viewprofile.religion_id'=>$id);
            }
            if($name=="state")
            {
              $searchArr[]=array('Viewprofile.state_id'=>$id);
            }
            if($name=="mothertongue")
            {
              $searchArr[]=array('Viewprofile.mothertongue_id'=>$id);
            }
	    $fcondition=array();
	    if($this->userValue){
		$searchArr[]=array('Viewprofile.id <>'=>$this->userValue['Member']['id']);
		$fcondition=array('sex <>'=>$this->userValue['Member']['sex']);
	    }
            $searchArr[]=array('status'=>'Active');
            $this->Paginator->settings['fields']=array('Viewprofile.*','TIMESTAMPDIFF(YEAR,Viewprofile.dob, CURDATE()) age','City.*','Occupation.*','Habit.*','Maritialstatus.*','Rashy.*','Caste.*','Religion.*','Employed.*','Mothertongue.*','Country.*','State.*','Education.*','Height.*');
            $this->Prg->commonProcess();
            $this->Paginator->settings['conditions']=array($searchArr,$searchageArr);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $post=$this->Paginator->paginate();
            $this->set('memberId',$this->adminId);
            $this->set('post',$post);
	    $this->loadModel('Member');
	    $this->set('featured',$this->Member->find('all',array('joins'=>array(array('table'=>'countries','type'=>'LEFT','alias'=>'Country','conditions'=>array('Member.country_id=Country.id')),
									      array('table'=>'states','type'=>'LEFT','alias'=>'State','conditions'=>array('Member.state_id=State.id')),
									      array('table'=>'cities','type'=>'LEFT','alias'=>'City','conditions'=>array('Member.city_id=City.id'))),
							   'fields'=>array('State.name','Member.profileId','City.name','Member.sex','Member.id','Member.name','Country.name','Member.photo','Member.photo_status','TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
							   'conditions'=>array('feature'=>'Yes','status'=>'Active',$fcondition),
							   'order'=>array('Member.id'=>'desc','rand()'),
							   'limit'=>'15',
							      )));
                    
            if ($this->request->is('ajax'))
            {
		$this->loadModel('Member');
		$this->set('featured',$this->Member->find('all',array('joins'=>array(array('table'=>'countries','type'=>'LEFT','alias'=>'Country','conditions'=>array('Member.country_id=Country.id')),
									      array('table'=>'states','type'=>'LEFT','alias'=>'State','conditions'=>array('Member.state_id=State.id')),
									      array('table'=>'cities','type'=>'LEFT','alias'=>'City','conditions'=>array('Member.city_id=City.id'))),
							   'fields'=>array('State.name','Member.profileId','City.name','Member.sex','Member.id','Member.name','Country.name','Member.photo','Member.photo_status','TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
							   'conditions'=>array('feature'=>'Yes','status'=>'Active'),
							   'order'=>array('Member.id'=>'desc','rand()'),
							   'limit'=>'15',
							      )));
                
               $this->render('index','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e.$e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    
    public function view($id = null,$age=null)
    {
	$this->loadModel('MembersVprofile');
	$this->layout=null;
	$flag=1;$viewed=0;
	$post = $this->Viewprofile->findById($id);
	$this->set('value',$post);
	$this->set('age',$age);
	$this->set('id',$this->memberId);
        $this->loadModel('MembersPhoto');
        $photoArr=$this->MembersPhoto->findAllByMemberId($id);
        $this->set('flag',$flag);
        $this->set('photoArr',$photoArr);
	$studentVArr=$this->MembersVprofile->findByMemberIdAndViewerId($this->memberId,$id);
	if($studentVArr)
	{
	    $viewed=1;
	    
	}
	$this->set('viewed',$viewed);
	$this->set('memberId',$this->memberId);
	    
    }
    public function contact($id=null)
    {
	$this->autoRender = false;
        $this->request->onlyAllow('ajax');	
	$this->loadModel('MembersContact');
        $this->loadModel('MembersVprofile');
	$this->loadModel('Member');
	$flag=1;
        $contactArr =$this->MembersContact->findBymemberId($this->memberId,array(),array('id'=>'desc'));
	if(!$contactArr){
	    $flag=0;
	}
	else if($contactArr['MembersContact']['total_contact']==0 || $contactArr['MembersContact']['expiry_date']<$this->currentDate)
	{
	  $flag=0;
	}
	else
	{
	    $studentVArr=$this->MembersVprofile->findByMemberIdAndViewerId($this->memberId,$id);                
	    if(!$studentVArr)
	    {
		$contact=$contactArr['MembersContact']['total_contact']-1;
		$recordArr=array('id'=>$contactArr['MembersContact']['id'],'member_id'=>$this->memberId,'total_contact'=>$contact);   
		$this->MembersContact->save($recordArr);
		$recordVArr=array('member_id'=>$this->memberId,'viewer_id'=>$id,'date'=>$this->currentDateTime);
		$this->MembersVprofile->save($recordVArr);
	    }
	    else
	    {
		$recordVArr=array('id'=>$studentVArr['MembersVprofile']['id'],'date'=>$this->currentDateTime);
		$this->MembersVprofile->saveAll($recordVArr);
	    }
	    $memberArr=$this->Member->findById($id);
	    echo json_encode($memberArr);
	    die();
	}
	echo json_encode($flag);
    }
    public function favourite($id,$status)
    {
        $this->layout=null;
        $this->autoRender=false;
        $favUrl=Router::url(array('controller' => 'Viewprofiles', 'action' => 'favourite'));
        return $this->CustomFunction->favouriteMember($favUrl,$id,$status);
    }
    public function shortlist($id,$status)
    {
        $this->layout=null;
        $this->autoRender=false;
        $favUrl=Router::url(array('controller' => 'Viewprofiles', 'action' => 'shortlist'));
        return $this->CustomFunction->shortlistMember($favUrl,$id,$status);
    }
   
    
}
