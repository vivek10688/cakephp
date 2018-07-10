<?php
App::uses('CakeEmail', 'Network/Email');
class IestudentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','ExportCsv.Export');
    
    public function index()
    {
        try
        {
            $this->loadModel('Group');
            $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
    public function importcsv()
    {
        try
        {
            if ($this->request->is('post'))
            {
                if(is_array($this->request->data['StudentGroup']['group_name']))
                {
                    $groupName=$this->request->data['StudentGroup']['group_name'];
                    $filename = null;$extension=null;
                    $password="ed5f1633fa872f7e37a0fd8c142278643260abf6b3b3e8d83ae0c09f8ee6441b";
                    $fixed=array('Iestudent'=>array('status'=>'Active','reg_status'=>'Done','password'=>$password,'renewal_date'=>$this->currentDateTime));
                    $extension = pathinfo($this->request->data['Iestudent']['file']['name'],PATHINFO_EXTENSION);
                    if($extension=="csv")
                    {
                        if (!empty($this->request->data['Iestudent']['file']['tmp_name']) && is_uploaded_file($this->request->data['Iestudent']['file']['tmp_name']))
                        {
                            $filename = basename($this->request->data['Iestudent']['file']['name']);
                            move_uploaded_file($this->data['Iestudent']['file']['tmp_name'],APP . DS . 'tmp' . DS . 'csv' . DS . $filename);
                            $siteArr=array('siteName'=>$this->siteName,'siteEmail'=>$this->siteEmail,'siteDomain'=>$this->siteDomain,'siteEmailContact'=>$this->siteEmailContact,'emailNotification'=>$this->emailNotification,'smsNotification'=>$this->smsNotification);
                            $this->Iestudent->importCSV(APP . DS . 'tmp' . DS . 'csv' . DS . $filename,$fixed,$groupName,'StudentGroup',$siteArr);
                            $this->Session->setFlash(__('Students imported successfully'),'flash',array('alert'=>'success'));
                            return $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                            $this->Session->setFlash(__('File not uploaded'),'flash',array('alert'=>'danger'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    }
                    else
                    {
                        $this->Session->setFlash(__('Only CSV File supported'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }                    
                }
                else
                {
                    $this->Session->setFlash(__('Please Select Group'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function exportcsv()
    {
        try
        {
            $data=$this->exportData();
            $this->Export->exportCSV($data, 'students.csv');
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
    private function exportData()
    {
        try
        {
            $this->Iestudent->UserWiseGroup($this->userGroupWiseId);
            $post=$this->Iestudent->find('all',array('joins'=>array(array('table'=>'student_groups','type'=>'INNER','alias'=>'StudentGroup','conditions'=>array('Iestudent.id=StudentGroup.student_id')),
                                                              array('table'=>'user_groups','type'=>'INNER','alias'=>'UserGroup','conditions'=>array('StudentGroup.group_id=UserGroup.group_id'))),
                                         'conditions'=>array('UserGroup.user_id'=>$this->luserId),
                                         'group'=>array('Iestudent.id'),
                                         'order'=>array('Iestudent.name'=>'asc')));
            $data=$this->CustomFunction->showStudentData($post);
            return $data;
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
