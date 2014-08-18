<?php
class Smartosc_Helloworld_Model_Resource_Entity extends
    Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/entity', 'entity_id');
    }
}