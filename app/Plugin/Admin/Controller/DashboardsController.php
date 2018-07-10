<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class DashboardsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        try{
            $this->loadModel('Payment');
            $this->loadModel('Bankdeposit');
            $this->loadModel('MembersPhoto');
            $date=CakeTime::format('d',$this->currentDate);
            for($i=0;$i<5;$i++)
            {
                
                $date=CakeTime::format("-$i days",'%d',$this->siteTimezone);
                $month=CakeTime::format("-$i days",'%m',$this->siteTimezone);
                $year=CakeTime::format("-$i days",'%Y',$this->siteTimezone);
                $paymentDate=CakeTime::format("-$i days",'%d-%m-%Y',$this->siteTimezone);
                $this->Payment->virtualFields=array('total'=>'SUM(Payment.amount)');
                $payment=$this->Payment->find('first',array('fields'=>array('total'),
                                                          'conditions'=>array('DAY(Payment.date)'=>$date,'MONTH(Payment.date)'=>$month,'YEAR(Payment.date)'=>$year)));
                if($payment['Payment']['total']==null)
                $payment['Payment']['total']=0;
                else
                $payment['Payment']['total']=$payment['Payment']['total'];
                $paymentArr[]=array($paymentDate,$payment);
            }
            $this->loadModel('Plan');
            $plans=$this->Plan->find('all');
            $count=$this->Dashboard->find('count',array('conditions'=>array('status'=>'Active')));
            $countMale=$this->Dashboard->find('count',array('conditions'=>array('sex'=>'Male','status'=>'Active')));
            $countFemale=$this->Dashboard->find('count',array('conditions'=>array('sex'=>'Female','status'=>'Active')));
            $members=$this->Dashboard->find('all',array('conditions'=>array('feature'=>'Yes','status'=>'Active'),
                                                        'order'=>array('Dashboard.id'=>'desc','rand()'),
                                                        'limit'=>'5'));
            $bankDeposit=$this->Bankdeposit->find('all',array('joins'=>array(array('table'=>'members','alias'=>'Member','type'=>'Left','conditions'=>array('Member.id=Bankdeposit.member_id')),
                                                                             array('table'=>'plans','alias'=>'Plan','type'=>'Left','conditions'=>array('Plan.id=Bankdeposit.plan_id'))),
                                                              'fields'=>array('Member.name','Plan.name','Bankdeposit.status','Bankdeposit.created'),
                                                              'order'=>array('Bankdeposit.id'=>'desc'),
                                                              'limit'=>'5'));
            $memberPhotoPending=$this->Dashboard->find('count',array('conditions'=>array('photo_status'=>'Pending')));
            $memberPhotosPending=$this->MembersPhoto->find('count',array('conditions'=>array('photo_status'=>'Pending')));
            $pendingPhotos=$memberPhotoPending+$memberPhotosPending;
            
            $this->set('payment',$paymentArr);
            $this->set('members',$members);
            $this->set('bankDeposit',$bankDeposit);
            $this->set('plans',$plans);
            $this->set('count',$count);
            $this->set('countMale',$countMale);
            $this->set('countFemale',$countFemale);
            $this->set('pendingPhotos',$pendingPhotos);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
               
    }    
}