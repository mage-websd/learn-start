<?php
class Smartosc_Helloworld_Model_Data extends
    Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('helloworld/data');
        parent::__construct();
    }
}