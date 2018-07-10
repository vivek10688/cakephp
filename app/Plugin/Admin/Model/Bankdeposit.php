<?php
class Bankdeposit extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Member.name'));
  public $validate = array('status' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Please Select an item in the list')),
                            );
  public $belongsTo=array('Member','Plan');
}
?>