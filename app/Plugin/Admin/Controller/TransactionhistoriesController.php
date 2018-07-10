<?php
class TransactionhistoriesController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Transactionhistory.id'=>'desc'));
    public function index()
    {
        try{
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $cond= array('Transactionhistory.status'=>'Approved');
        $this->Paginator->settings['conditions'] = array($this->Transactionhistory->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Transactionhistory', $this->Paginator->paginate());
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
