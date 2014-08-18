<?php
class Smartosc_Helloworld_Model_Mysql4_Type extends 
            Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/type', 'type_id');
    }
}?>
