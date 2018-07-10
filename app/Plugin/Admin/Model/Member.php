<?php
class Member extends AppModel
{
   public $validationDomain = 'validation';
   public $belongsTo=array('City','State','Country','Caste','Religion','Education','Employed','Occupation','Height','Rashy','Habit','Maritialstatus','Mothertongue');
   public $actsAs = array('search-master.Searchable');   
   public $validate = array('user_name' => array('rule1' => array('rule' => '/^[a-z0-9A-Z_]*$/i','required' => true,'message' => 'Invalid User Name'),
						'rule2' => array('rule' => '/^(?!admin).*$/i','required' => true,'message' => 'Reserved User Name'),
						'isUnique'=>array('rule'=>'isUnique','message'=>'Username already exists. Please choose a different username')),
			   'email' => array('email'=>array('rule'=>'email','message'=>'Enter a valid email','allowEmpty'=>true),
                                           'isUnique'=>array('rule' => 'isUnique','allowEmpty'=>true,'message' => 'This Email has already been exist! try new one')),
                          'name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                          'password' => array('alphaNumeric'=>array('rule'=>'alphaNumeric','required' => true,'message'=>'Password required'),
                                              'between'=>array('rule'=>array('minLength','4'),'message'=>'Password minimum 4 character long')),
                          'address' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message'=>'Only Alphabets')),
                          'phone' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),                         
                          'dob' => array('date'=>array('rule'=>array('date','ymd'),'allowEmpty'=>true,'required' => true,'message' => 'Only Date format allowed')),
                          'sex' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message' => 'Please select')),
                          'country_id' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message' => 'Please select')),
                          'state_id' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message' => 'Please select')),
                          'city_id' => array('alphaNumeric'=>array('rule' =>'alphaNumeric','required'=>true,'allowEmpty'=>true,'message'=>'Please select')),
                          'birth_place' => array('alphaNumeric'=>array('rule' =>'alphaNumeric','allowEmpty'=>true,'message'=>'Only Alphabets'))
                          );
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Member.profileId'));
  
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Member']['password'])) {
      $this->data['Member']['password'] = $this->passwordHasher($this->data['Member']['password']);
      }
      if (!empty($this->data['Member']['renewal_date'])) {
      $this->data['Student']['renewal_date'] = $this->dateTimeFormatBeforeSave($this->data['Member']['renewal_date']);
      }
      if (!empty($this->data['Member']['dob'])) {
      $this->data['Member']['dob'] = $this->dateFormatBeforeSave($this->data['Member']['dob']);
      
      }
      return true;
  }  
}
?>