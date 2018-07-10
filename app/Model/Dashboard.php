<?php
class Dashboard extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="members";
  public $belongsTo=array('City','State','Country','Caste','Religion','Education','Employed','Occupation','Height','Rashy','Habit','Maritialstatus','Mothertongue');
  
  
}
?>