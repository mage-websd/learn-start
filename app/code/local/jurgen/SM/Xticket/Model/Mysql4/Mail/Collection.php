<?php

class SM_Xticket_Model_Mysql4_Mail_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xticket/mail');
    }
}