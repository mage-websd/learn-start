<?php
class Smartosc_Helloworld_Model_Mysql4_Type_Collection extends 
            Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/type');
        parent::_construct();
    }
}