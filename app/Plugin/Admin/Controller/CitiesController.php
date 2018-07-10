<?php
class CitiesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('City.name'=>'asc'));
    public function index()
    {
        try{
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->City->parseCriteria($this->Prg->parsedParams());
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('City', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
    public function add()
    {
        $countryId=null;
        if ($this->request->is('post'))
        {
            $this->City->create();
            try
            {
                if ($this->City->save($this->request->data))
                {  
                    $this->Session->setFlash(__('City Added Successfully'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $countryId=$this->request->data['City']['country_id'];
        }
        $this->loadModel('Country');
        $country=$this->Country->find('list',array('order'=>array('name'=>'asc')));
        $this->set('country',$country);
        $this->loadModel('State');
        $state=$this->State->find('list',array('order'=>array('name'=>'asc'),
                                               'conditions'=>array('State.country_id'=>$countryId)));
        $this->set('state',$state);
        
    }
    public function edit($id = null)
    {
        $this->loadModel('Country');
        $this->loadModel('State');
        $country=$this->Country->find('list');
        $this->set('country',$country);
         if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $k=>$id)
        {
            $k++;
            $post[$k]=$this->City->findById($id);
            $state=$this->State->find('list',array('conditions'=>array('State.country_id'=>$post[$k]['City']['country_id'])));
            $this->set("state$k",$state);
        }
        $this->set('City',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->City->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('City has been updated'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }  
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['City']['id'] as $key => $value)
                {
                    $this->City->delete($value);
                }
                $this->Session->setFlash(__('City has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Delete Releted Records first'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
