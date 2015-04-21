<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Setting extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xticket';
        $this->_controller = 'adminhtml_xticket';
        $this->_updateButton('save', 'label', Mage::helper('xticket')->__('Save Settings'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('xticket_settingdata') ) {
            return Mage::helper('xticket')->__("Edit Settings");
        }
    }
}