<?php
class Contact extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable=false;
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed')),
                             'email' => array('email'=>array('rule'=>'email','message'=>'Enter a valid email')),
                             'phone' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                             'subject' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed')),
                             'message' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed'))
                            );
    
}
