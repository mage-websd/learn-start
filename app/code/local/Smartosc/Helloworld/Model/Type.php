<?php
class Smartosc_Helloworld_Model_Type extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('helloworld/type');
        parent::_construct();
    }
}