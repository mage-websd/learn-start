<?php
class Smartosc_Helloworld_Model_Mysql4_Entity extends 
        Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/entity', 'entity_id');
    }
}