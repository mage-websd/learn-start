<?php
class Smartosc_Helloworld_Model_Item extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('helloworld/item');
        parent::_construct();
    }
}