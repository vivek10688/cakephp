<?php
class Dashboard extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable = 'members';
    public $belongsTo=array('Education','Occupation','Country','State');
    
}
