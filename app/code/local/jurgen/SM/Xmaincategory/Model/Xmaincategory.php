<?php

class SM_Xmaincategory_Model_Xmaincategory extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xmaincategory/xmaincategory');
    }
}