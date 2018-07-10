<?php
class AjaxcontentsController extends AppController
{
    public $helpers = array('Html', 'Form');
    
    public function state()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('State');
        $stateName=$this->State->find('list',array('conditions'=>array('country_id'=>$id),'order'=>array('State.name'=>'asc')));
        $this->set(compact('stateName'));
    }
    public function city()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('City');
        $cityName=$this->City->find('list',array('conditions'=>array('state_id'=>$id),'order'=>array('City.name'=>'asc')));
        $this->set(compact('cityName'));
    }
    public function caste()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('Caste');
        $casteName=$this->Caste->find('list',array('conditions'=>array('religion_id'=>$id),'order'=>array('Caste.name'=>'asc')));
        $this->set(compact('casteName'));
    }
}
