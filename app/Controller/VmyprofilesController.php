<?php
class VmyprofilesController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Vmyprofile.id'=>'desc'));
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

	    $this->Paginator->settings['fields']=array('Member.*','TIMESTAMPDIFF(YEAR,Member.dob, CURDATE()) age','Country.*','State.*','City.*','Religion.*','Height.*');
            $this->Prg->commonProcess();
	    $this->Paginator->settings['joins']=array(array('table'=>'members','type'=>'LEFT','alias'=>'Member','conditions'=>array('Member.id=Vmyprofile.member_id')),
						      array('table'=>'countries','type'=>'LEFT','alias'=>'Country','conditions'=>array('Country.id=Member.country_id')),
						      array('table'=>'states','type'=>'LEFT','alias'=>'State','conditions'=>array('State.id=Member.state_id')),
						      array('table'=>'cities','type'=>'LEFT','alias'=>'City','conditions'=>array('City.id=Member.city_id')),
						      array('table'=>'religions','type'=>'LEFT','alias'=>'Religion','conditions'=>array('Religion.id=Member.religion_id')),
						      array('table'=>'heights','type'=>'LEFT','alias'=>'Height','conditions'=>array('Height.id=Member.height_id')));
            $this->Paginator->settings['conditions']=array('Vmyprofile.viewer_id'=>$this->memberId);
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
