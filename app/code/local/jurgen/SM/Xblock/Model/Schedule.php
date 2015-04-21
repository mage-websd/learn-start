<?php
/**
 *
 * @category   SM
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */
class SM_Xblock_Model_Schedule extends Mage_Core_Model_Abstract{
    public function _construct(){
        parent::_construct();
        $this->_init('xblock/schedule');
    }
}
