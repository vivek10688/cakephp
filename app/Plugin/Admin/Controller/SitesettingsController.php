<?php

class SitesettingsController extends AdminAppController
{
  public $components=array('RequestHandler','Paginator');
  public $helpers = array('Html', 'Form','Js'=> array('Jquery'),'Paginator');
  //public $paginate = array('limit' => 2,'order' => array('id' => 'desc'));
  public function index()
  {
  $post=$this->Sitesetting->find('all');
 $this->set('post',$post);
   if ($this->request->is(array('post', 'put'))) {
        if ($this->Sitesetting->saveAll($this->request->data)) {
            $this->Session->setFlash('Form Fields has been saved.','flash',array('alert'=>'success'));


            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}

}

?>