<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Cat_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xticket';
        $this->_controller = 'adminhtml_xticket';
        
        $this->_updateButton('delete', 'label', Mage::helper('xticket')->__('Delete Department'));
        
        $this->_updateButton('save', 'label', Mage::helper('xticket')->__('Save Department'));
        
    }
    

    public function getHeaderText()
    {
        if( Mage::registry('cat_data') && Mage::registry('cat_data')->getId() ) {
            return Mage::helper('xticket')->__("Edit Department '%s'", Mage::registry('cat_data')->getData('name'));
        } else {
            return Mage::helper('xticket')->__('New Department');
        }
    }
}