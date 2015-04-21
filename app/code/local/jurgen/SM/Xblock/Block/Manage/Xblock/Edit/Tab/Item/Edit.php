<?php
/**
 * @category   SmartOSC
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */
class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {                       
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xblock';
        $this->_controller = 'manage_xblock';
        
        $this->_updateButton('save', 'label', Mage::helper('xblock')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('xblock')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";

    }

    public function getHeaderText()
    {
        if( Mage::registry('xblock_data') && Mage::registry('xblock_data')->getId() ) {
            return Mage::helper('xblock')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('xblock_data')->getTitle()));
        } else {
            return Mage::helper('xblock')->__('Add Item');
        }
    }
}
