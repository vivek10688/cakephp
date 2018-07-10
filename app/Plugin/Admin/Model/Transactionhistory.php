<?php
class Transactionhistory extends AppModel
{
  public $validationDomain = 'validation';
   public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Member.name'));
  public $useTable="members_payments";
  public $belongsTo=array('Plan'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Plan.id=Transactionhistory.plan_id')),
                          'Member'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Member.id=Transactionhistory.member_id')),);
}
?>