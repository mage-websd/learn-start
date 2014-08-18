<?php
class Smartosc_Helloworld_Model_Datatest extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('helloworld/datatest');
        parent::_construct();
    }

    public function getOne($id)
    {
        return $this->load($id)->getData();

    }
}