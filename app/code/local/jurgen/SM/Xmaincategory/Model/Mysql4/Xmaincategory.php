<?php

class SM_Xmaincategory_Model_Mysql4_Xmaincategory extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the xmaincategory_id refers to the key field in your database table.
        $this->_init('xmaincategory/xmaincategory', 'xmaincategory_id');
    }
}