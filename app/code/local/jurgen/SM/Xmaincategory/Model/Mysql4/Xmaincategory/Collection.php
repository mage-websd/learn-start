<?php

class SM_Xmaincategory_Model_Mysql4_Xmaincategory_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xmaincategory/xmaincategory');
    }
}