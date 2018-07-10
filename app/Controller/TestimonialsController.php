<?php
class TestimonialsController extends AppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Testimonial.id'=>'desc'));
    public function index()
    {
        try{
            
            $this->loadModel('Dashboard');
	    $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
	    
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions']=array('Testimonial.status'=>'Active');
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Testimonials', $this->Paginator->paginate());
        $this->loadModel('Dashboard');
        $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                           'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id']))));
        $this->set('userValueArr',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
        if ($this->request->is('ajax'))
        {
            $this->loadModel('Dashboard');
	    $this->set('ageValue',$this->Dashboard->find('first',array('fields'=>array('TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
                                                               'conditions'=>array('Dashboard.id'=>$this->userValue['Member']['id'])
                                                               )
                                                ));
        $this->set('value',$this->Dashboard->findById($this->userValue['Member']['id']));
        $this->set('id',$this->userValue['Member']['id']);
	    
            $this->render('index','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }    
    public function add()
    {
        $this->layout=null;
        if ($this->request->is('post'))
        {
            $this->Testimonial->create();
            try
            {
                $count=$this->Testimonial->find('count',array('conditions'=>array('member_id'=>$this->userValue['Member']['id'])));
                if($count>0)
                {
                  $record=$this->Testimonial->find('first',array('conditions'=>array('member_id'=>$this->userValue['Member']['id'])));
                  $this->request->data['Testimonial']['status']='Suspend';
                  $this->request->data['Testimonial']['id']=$record['Testimonial']['id'];
                  $this->request->data['Testimonial']['member_id']=$this->userValue['Member']['id'];
                  
                }
                else
                {
                  $this->request->data['Testimonial']['status']='Suspend';
                  $this->request->data['Testimonial']['member_id']=$this->userValue['Member']['id'];
                    
                }
                if ($this->Testimonial->save($this->request->data))
                {  
                    $this->Session->setFlash(__('Success Story Added Successfully'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    
}
