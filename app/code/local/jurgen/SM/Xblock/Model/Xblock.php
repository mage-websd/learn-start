<?php
class SM_Xblock_Model_Xblock extends Mage_Core_Model_Abstract{
    public function _construct(){
        parent::_construct();
        $this->_init('xblock/xblock');
    }
}
