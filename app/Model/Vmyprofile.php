<?php
class Vmyprofile extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $useTable='members_vprofiles';
  //public $belongsTo=array('City','State','Country','Caste','Religion','Education','Employed','Occupation','Height','Rashy','Habit','Maritialstatus','Mothertongue');
   
}
?>