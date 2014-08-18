<?php
class Smartosc_Helloworld_Model_Resource_Datatest_Collection extends
    Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('helloworld/datatest');
        parent::_construct();
    }
    public function getListGiang(){
        return 'giang';
    }
}
