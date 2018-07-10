<?php
class Memberfavourite extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="favourites";
  public $belongsTo=array('Member'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Member.id=Memberfavourite.member_id')),
                          'State'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('State.id=Member.state_id')),
                          'Country'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Country.id=Member.country_id')),
                          'City'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('City.id=Member.city_id')),);
  
}
?>