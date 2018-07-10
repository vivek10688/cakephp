<?php
class Transactionhistory extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="members_payments";
  public $belongsTo=array('Plan'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Plan.id=Transactionhistory.plan_id')),);
}
?>