<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * XAdvertising model mysql4 xadvertising collection
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq (thuanlq@smartos.com)
 */
class SM_XAdvertising_Model_Mysql4_XAdvertising_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
		parent::_construct();
	        $this->_init('xadvertising/xadvertising');
    }
}
