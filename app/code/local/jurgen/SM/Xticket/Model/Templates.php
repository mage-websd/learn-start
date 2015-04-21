<?php

class SM_Xticket_Model_Templates extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xticket/templates');
    }

}