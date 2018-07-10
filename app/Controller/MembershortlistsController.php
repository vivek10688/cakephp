<?php
App::uses('CakeTime', 'Utility');
class MembershortlistsController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1);
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
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
            $this->Prg->commonProcess();
            $this->Paginator->settings['fields']=array('Membershortlist.*','Member.*','TIMESTAMPDIFF(YEAR,Member.dob, CURDATE()) age','Country.*','State.*','City.*');
            $this->Paginator->settings['conditions']=array('Membershortlist.viewer_id'=>$this->userValue['Member']['id']);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $post=$this->Paginator->paginate();
            $this->set('post',$post);
            if ($this->request->is('ajax'))
            {
                $this->render('index','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}
