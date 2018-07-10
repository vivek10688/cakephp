<?php
class Register extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="members";
  var $captcha = '';
  public $validate = array('user_name' => array('rule1' => array('rule' => '/^[a-z0-9A-Z_]*$/i','required' => true,'message' => 'Invalid User Name'),
						'rule2' => array('rule' => '/^(?!admin).*$/i','required' => true,'message' => 'Reserved User Name'),
						'isUnique'=>array('rule'=>'isUnique','message'=>'Username already exists. Please choose a different username')),
			   'email' => array('isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one'),
					    'email'=>array('rule'=>'email','message'=>'Enter a valid email')),
			   'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
			   'password' => array('alphaNumeric'=>array('rule'=>'alphaNumericCustom','required' => true,'message'=>'Password required'),
					       'between'=>array('rule'=>array('minLength','4'),'message'=>'Password minimum 4 character long')),
			   'phone' => array('numeric'=>array('rule'=>'numeric','allowEmpty' => false,'required' => true,'message'=>'Only Number')),
			   );
		  
  function matchCaptcha($inputValue)	{
	  return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
  }

  function setCaptcha($value)	{
	  $this->captcha = $value; //setting captcha value
  }

  function getCaptcha()	{
	  return $this->captcha; //getting captcha value
  }
}
?>