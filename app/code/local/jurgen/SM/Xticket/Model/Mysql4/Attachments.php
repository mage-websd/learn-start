<?php

class SM_Xticket_Model_Mysql4_Attachments extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('xticket/attachments', 'ID');
    }

}