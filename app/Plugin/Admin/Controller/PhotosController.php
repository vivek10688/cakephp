<?php
class PhotosController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Photo.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        try
        {
            $this->loadModel('Member');
            $this->loadModel('MembersPhoto');
            $memberPhoto=$this->Member->find('all',array('conditions'=>array('photo_status'=>'Pending')));
            $membersPhotos=$this->MembersPhoto->find('all',array('joins'=>array(array('table'=>'members','alias'=>'Member','type'=>'INNER','conditions'=>array('MembersPhoto.member_id=Member.id'))),
                                                         'fields'=>array('Member.*','MembersPhoto.*'),
                                                         'conditions'=>array('MembersPhoto.photo_status'=>'Pending')));
            $this->set('memberPhoto',$memberPhoto);
            $this->set('membersPhotos',$membersPhotos);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function del($id=null)
    {
        try
        {
            if ($id!=null)
            {         
                $this->loadModel('MembersPhoto');
                $deleteArr = $this->MembersPhoto->findById($id);
                $this->CustomFunction->fileDelete($deleteArr['MembersPhoto']['photo'],'member');
                $this->MembersPhoto->Delete($id);
                $this->Session->setFlash(__('File Remove Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Photos','action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function approvedphoto($id=null)
    {
        try
        {
            $this->loadModel('MembersPhoto');
            $record=array('id'=>$id,'photo_status'=>'Approved');
            $this->MembersPhoto->save($record);
            $this->Session->setFlash(__('File Approved Successfully'),'flash',array('alert'=>'success'));
            $this->redirect(array('controller'=>'Photos','action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function pdel($id=null)
    {
        try
        {
            if ($id!=null)
            {         
                $this->loadModel('Member');
                $deleteArr = $this->Member->findById($id);
                $this->CustomFunction->fileDelete($deleteArr['Member']['photo'],'member');
                $this->Member->save(array('id'=>$id,'photo_status'=>NULL,'photo'=>NULL));
                $this->Session->setFlash(__('File Remove Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Photos','action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function papprovedphoto($id=null)
    {
        try
        {
            $this->loadModel('Member');
            $record=array('id'=>$id,'photo_status'=>'Approved');
            $this->Member->save($record);
            $this->Session->setFlash(__('File Approved Successfully'),'flash',array('alert'=>'success'));
            $this->redirect(array('controller'=>'Photos','action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}