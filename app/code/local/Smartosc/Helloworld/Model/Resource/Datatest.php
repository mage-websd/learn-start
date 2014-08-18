<?php
class Smartosc_Helloworld_Model_Resource_Datatest extends
    Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/datatest', 'id');
    }
    public function getResourceGiang()
    {
        return 'khong';
    }
}