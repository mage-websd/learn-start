<?php
class Smartosc_Helloworld_Model_Mysql4_Item extends 
        Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/item', 'item_id');
    }
}