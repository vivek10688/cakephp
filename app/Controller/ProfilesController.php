<?php
App::uses('CakeTime','Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ProfilesController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Time');
    public $components = array('Session');
    public $presetVars = true;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        $this->loadModel('Member');
        $id=$this->userValue['Member']['id'];
        $post = $this->Member->findById($id);
        if(strlen($post['Member']['photo'])>0)
        $std_img='member_thumb/'.$post['Member']['photo'];
        else
        $std_img='User.png';
        $this->set('post', $post);
        $this->set('std_img', $std_img);
    }    
    public function editProfile()
    {
        $this->layout=null;
        $this->loadModel('Religion');
        $this->loadModel('Caste');
        $this->loadModel('Country');
        $this->loadModel('State');
        $this->loadModel('City');
        $this->set('religionName',$this->Religion->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('countryName',$this->Country->find('list',array('order'=>array('name'=>'asc'))));
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        $country=$post['Profile']['country_id'];
        $state=$post['Profile']['state_id'];
        $religion=$post['Profile']['religion_id'];
        $this->set('post',$post);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Profile->id = $id;
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__('Profile Updated Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
            }
            $country=$this->request->data['Profile']['country_id'];
            $state=$this->request->data['Profile']['state_id'];
            $religion=$this->request->data['Profile']['religion_id'];
        }
        $stateName=$this->State->find('list',array('order'=>array('name'=>'asc'),
                                                   'conditions'=>array('State.country_id'=>$country)));
        $this->set('stateName',$stateName);
        $cityName=$this->City->find('list',array('order'=>array('name'=>'asc'),
                                                 'conditions'=>array('City.state_id'=>$state)));
        $this->set('cityName',$cityName);
        $casteName=$this->Caste->find('list',array('order'=>array('name'=>'asc'),
                                                   'conditions'=>array('Caste.religion_id'=>$religion)));
        $this->set('casteName',$casteName);
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }        
    }
    public function editdetailprofile()
    {
        $this->layout=null;
        $this->loadModel('Education');
        $this->loadModel('Mothertongue');
        $this->loadModel('Habit');
        $this->loadModel('Maritialstatus');        
        $this->loadModel('Occupation');
        $this->loadModel('Employed');
        $this->loadModel('Height');
        $this->loadModel('Rashy');
        $this->set('educationName',$this->Education->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('mothertongueName',$this->Mothertongue->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('habitName',$this->Habit->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('maritialstatusName',$this->Maritialstatus->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('occupationName',$this->Occupation->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('employedName',$this->Employed->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('heightName',$this->Height->find('list',array('order'=>array('name'=>'asc'))));
        $this->set('rashiName',$this->Rashy->find('list',array('order'=>array('name'=>'asc'))));
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        $this->set('post',$post);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Profile->id = $id;
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__('Profile Updated Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
            }
        }
        
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }        
    }
    public function editmyfamilyprofile()
    {
        $this->layout=null;
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        $this->set('post',$post);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Profile->id = $id;
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__('Profile Updated Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
            }
        }
        
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }        
    }
    public function cprofilePhoto()
    {
        $this->layout=null;
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $dirName="member";
            $this->Profile->id = $id;
            $this->request->data['Profile']['photo_status']='Pending';
            $photoName=$this->request->data['Profile']['photo']['name'];
            $photoTmp=$this->request->data['Profile']['photo']['tmp_name'];
            $fileName=$this->CustomFunction->upload($photoTmp,$photoName,$dirName,$this->siteOrganization);
            if($post['Profile']['photo']){$this->CustomFunction->fileDelete($post['Profile']['photo'],'member');}
            if(strlen($fileName)>0)
            {
                $this->request->data['Profile']['photo']=$fileName;
            }
            $recordArr=array('Profile'=>array('photo'=>$fileName,'photo_status'=>'Pending'));
            if($this->Profile->save($recordArr))
            {
                $this->Session->setFlash(__('Photo updated successfully and pending for admin approval.'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
            }
        }
    }
    public function rprofilePhoto()
    {
        $this->layout=null;
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        if($post){
            if($post['Profile']['photo'] && $post['Profile']['photo_status']=='Approved'){
                $photo='member_thumb/'.$post['Profile']['photo'];
            }
            else{
                $photo='User.png';
            }
            $this->set('photo',$photo);
            if ($this->request->is(array('post', 'put')))
            {
                $this->CustomFunction->fileDelete($post['Profile']['photo'],'member');
                $recordArr=array('id'=>$id,'photo'=>null);
                if($this->Profile->save($recordArr))
                {
                  $this->Session->setFlash(__('Profile Photo Remove Successfully'),'flash',array('alert'=>'success'));
                  $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
                }
            }
        }
    }
    public function changePhoto()
    {
        $this->layout=null;
        $this->loadModel('MembersPhoto');
        $id=$this->userValue['Member']['id'];
        $post = $this->Profile->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $photoArr=array();
            $dirName="member";
            foreach($this->request->data['Pr']['photo'] as $Photo)
            {
                $fileName=$this->CustomFunction->upload($Photo['tmp_name'],$Photo['name'],$dirName,$this->siteOrganization);
                if(strlen($fileName)>0)
                {
                    $photoArr[]=(array('member_id'=>$id,'photo' => $fileName));
                }
            }
            if ($this->MembersPhoto->saveAll($photoArr))
            {
                $this->Session->setFlash(__('Photo updated successfully and pending for admin approval.'),'flash',array('alert'=>'success'));
                $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
            }
        }        
    }
    public function removePhoto()
    {
        $this->layout=null;$photo=null;
        $this->loadModel('MembersPhoto');
        $id=$this->userValue['Member']['id'];
        $post = $this->MembersPhoto->findAllByMemberId($id);
        $this->set('post',$post);
        if ($this->request->is(array('post', 'put')))
        {   foreach($this->request->data['MembersPhoto']['id'] as $key =>$photoId)
            {
                if($photoId!=0)
                {                       
                    $deleteArr = $this->MembersPhoto->findById($photoId);
                    $this->CustomFunction->fileDelete($deleteArr['MembersPhoto']['photo'],'member');
                    $this->MembersPhoto->Delete($photoId);
                    $this->Session->setFlash(__('Photo Remove Successfully'),'flash',array('alert'=>'success'));
                }
            }
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }        
    }
    public function changePass()
    {
        $this->layout=null;
        if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $id=$this->userValue['Member']['id'];
            $post = $this->Profile->findById($id);
            if($post['Profile']['password']==$passwordHasher->hash($this->request->data['Profile']['oldPassword']))
            {
                $this->Profile->id = $id;
                $this->Profile->unbindValidation('remove', array('photo'), true);
                $recordArr=array('Profile'=>array('password'=>$passwordHasher->hash($this->request->data['Profile']['password'])));    
                if ($this->Profile->save($recordArr))
                {
                    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
                }                
            }
            else
            {
                $this->Session->setFlash(__('Invalid Password'),'flash',array('alert'=>'danger'));
            }
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
    }    
}
