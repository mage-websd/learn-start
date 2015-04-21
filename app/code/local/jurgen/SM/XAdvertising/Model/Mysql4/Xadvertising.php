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
 * XAdvertising model mysql4 xadvertising
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author    thuanlq (thuanlq@smartos.com)
 */
class SM_XAdvertising_Model_Mysql4_Xadvertising extends Mage_Core_Model_Mysql4_Abstract
{
	/**
	 * define primary key for model xadvertising
	 * @see app/code/core/Mage/Core/Model/Resource/Mage_Core_Model_Resource_Abstract#_construct()
	 */
    public function _construct(){
        $this->_init('xadvertising/xadvertising', 'unique_id');
    }
}
