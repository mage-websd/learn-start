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
 * XAdvertising model xadvertising:
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Model_Xadvertising extends Mage_Core_Model_Abstract{
	
	/**
	 * class constructor
	 * @see lib/Varien/Varien_Object#_construct()
	 */
    public function _construct(){
        parent::_construct();
        $this->_init('xadvertising/xadvertising');
    }
}
