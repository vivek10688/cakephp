<?php
class Plan extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Plan.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed'),
                                                 'isUnique'=>array('rule' => 'isUnique','message' => 'Plan Name  already exist')),
                           'expiry' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),                         
                           'amount' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed'))
                            );
  
  
}
?>