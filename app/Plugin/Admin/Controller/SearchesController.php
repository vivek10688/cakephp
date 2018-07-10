<?php
class SearchesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Search.name'=>'asc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->memberId=$this->userValue['Member']['id'];        
    }
    public function index($id=null,$name=null)
    {
        try
        {
	    $countryId=null;$stateId=null;$religionId=null;
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
            $this->Session->setFlash($e.$e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function view($id = null)
    {
	try
        {
	    $this->layout = null;
	    if (!$id)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->loadModel('MembersPhoto');
            $postPhoto = $this->MembersPhoto->findAllByMemberId($id);
	    $this->loadModel('Member');
	    $this->Member->bindModel(array('belongsTo'=>array('City','State','Country','Caste','Religion','Education','Employed','Occupation','Height','Rashy','Habit','Maritialstatus','Mothertongue')));
            $post = $this->Member->findById($id);
            if (!$post)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->set('postPhoto', $postPhoto);
            if(strlen($post['Member']['photo'])>0)
            $std_img='member_thumb/'.$post['Member']['photo'];
            else
            $std_img='User.png';
            $this->set('post', $post);
            $this->set('std_img', $std_img);
            $this->set('id', $id);
            $this->set('luserId',$this->luserId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function regularsearch($name=null)
    {
        try{
	    $searchArr=array();
            if(isset($this->params['named']['photo']) && $this->params['named']['photo']>0)
            {
              $searchArr[]=array('Search.photo <>'=>null);
            }
            if(isset($this->params['named']['rashi']) && $this->params['named']['rashi']>0)
            {
              $searchArr[]=array('Search.rashy_id <>'=>null);
            }
            if(isset($this->params['named']['profileId']) && strlen($this->params['named']['profileId'])>0)
            {
              $searchArr[]=array('Search.profileId'=>$this->params['named']['profileId']);
            }
            if(isset($this->params['named']['sex']) && strlen($this->params['named']['sex'])>0)
            {
              $searchArr[]=array('sex'=>$this->params['named']['sex']);
            }
            if(isset($this->params['named']['state_id']) && strlen($this->params['named']['state_id'])>0)
            {
              $searchArr[]=array('Search.state_id'=>$this->params['named']['state_id']);
            }
	    if(isset($this->params['named']['city_id']) && strlen($this->params['named']['city_id'])>0)
            {
              $searchArr[]=array('Search.city_id'=>$this->params['named']['city_id']);
            }
            $searchageArr=null;
            if(isset($this->params['named']['age_from']) && isset($this->params['named']['age_to']) && strlen($this->params['named']['age_from'])>0 && strlen($this->params['named']['age_to'])>0)
            {
              $searchageArr='TIMESTAMPDIFF(YEAR,Search.dob, CURDATE()) >='.$this->params['named']['age_from'].' AND '.'TIMESTAMPDIFF(YEAR,Search.dob, CURDATE()) <='.$this->params['named']['age_to'];
            }
            
            if(isset($this->params['named']['habit_id']) && strlen($this->params['named']['habit_id'])>0)
            {
              $searchArr[]=array('Search.habit_id'=>$this->params['named']['habit_id']);
            }
            if(isset($this->params['named']['maritialstatus_id']) && strlen($this->params['named']['maritialstatus_id'])>0)
            {
              $searchArr[]=array('Search.maritialstatus_id'=>$this->params['named']['maritialstatus_id']);
            }
            if(isset($this->params['named']['country_id']) && strlen($this->params['named']['country_id'])>0)
            {
              $searchArr[]=array('Search.country_id'=>$this->params['named']['country_id']);
            }
            if(isset($this->params['named']['religion_id']) && strlen($this->params['named']['religion_id'])>0)
            {
              $searchArr[]=array('Search.religion_id'=>$this->params['named']['religion_id']);
            }
            if(isset($this->params['named']['mothertongue_id']) && strlen($this->params['named']['mothertongue_id'])>0)
            {
              $searchArr[]=array('Search.mothertongue_id'=>$this->params['named']['mothertongue_id']);
            }
            if($name=="religion")
            {
              $searchArr[]=array('religion_id'=>$id);
            }
            if($name=="state")
            {
              $searchArr[]=array('state_id'=>$id);
            }
            if($name=="mothertongue")
            {
              $searchArr[]=array('mothertongue_id'=>$id);
            }
            $this->Paginator->settings['fields']=array('Search.*','City.*','Occupation.*','Habit.*','Maritialstatus.*','Rashy.*','Caste.*','Religion.*','Employed.*','Mothertongue.*','Country.*','State.*','Education.*','Height.*');
            $this->Prg->commonProcess();
            $this->Paginator->settings['conditions']=array($searchArr,$searchageArr);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
	    $this->Paginator->settings['order']=array('Search.name'=>'asc');
            $post=$this->Paginator->paginate();
            $this->set('memberId',$this->adminId);
            $this->set('post',$post );
            if ($this->request->is('ajax'))
            {
                $this->render('regularsearch','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function viewprofile($id=null)
    {
	try{
	    $this->layout=null;
	    $this->Search->virtualFields=array('age'=>'TIMESTAMPDIFF(YEAR,Search.dob, CURDATE())');
	    $post=$this->Search->find('first',array('conditions'=>array('Search.id'=>$id)));
	    $this->Search->virtualFields=array();
	    $this->loadModel('MembersPhoto');
            $postPhoto = $this->MembersPhoto->findAllByMemberIdAndPhotoStatus($id,'Approved');
	    $this->set('postPhoto',$postPhoto);
	    $this->set('value',$post);
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}
