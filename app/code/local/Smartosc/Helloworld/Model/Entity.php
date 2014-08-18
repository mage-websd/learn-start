<?php
class Smartosc_Helloworld_Model_Entity extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('helloworld/entity');
        parent::_construct();
    }
}