<?php
class TransactionhistorysController extends AppController
{
    public $helpers = array('Paginator');
    public $components = array('Paginator');
    public $currentDateTime;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Transactionhistory.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->memberId=$this->userValue['Member']['id'];
    }
    public function index()
    {
        $this->loadModel('Dashboard');
        $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
        $this->loadModel('MembersContact');
        $contactArr =$this->MembersContact->findByMemberId($this->memberId,array(),array('id'=>'desc'));
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('Transactionhistory.member_id'=>$this->memberId,'Transactionhistory.status'=>'Approved');
        $this->set('Transactionhistory',$this->Paginator->paginate());
        if($contactArr)
        $this->set('totalContact',$contactArr['MembersContact']['total_contact']);
        else
        $this->set('totalContact','0');
        
    }    
}
