<?php
class Profile extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="members";
  public $belongsTo=array('State','Country','Caste','Religion','Education','Employed','Occupation','Height','Rashy','Habit','Maritialstatus','Mothertongue');
  public function beforeSave($options = array())
  {
      if (!empty($this->data['Profile']['dob'])) {
      $this->data['Profile']['dob'] = $this->dateTimeFormatBeforeSave($this->data['Profile']['dob']);
      }
      
      return true;
  }
}
?>