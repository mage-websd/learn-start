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
 * XAdvertising Admin Head block:
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Block_Admin_Head extends Mage_Adminhtml_Block_Template
{
    public function __construct()
    {
        parent::__construct();
		//$this->setTemplate('xadvertising/head.phtml');
    }
    public function isUseTextEditor()
    {
        return Mage::getStoreConfig('xadvertising/xadvertising/userte');
    }
   
}