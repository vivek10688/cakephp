<?php
class Payment extends AppModel
{
    public $validationDomain = 'validation';
    public $name = 'Payment';
    public $useTable = 'paypal_configs';
    public $primaryKey = 'id';
}
?>