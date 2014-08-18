<?php
class Smartosc_Helloworld_Model_Resource_Type_Collection extends
            Mage_Core_Model_Resource_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/type');
        parent::_construct();
    }
}