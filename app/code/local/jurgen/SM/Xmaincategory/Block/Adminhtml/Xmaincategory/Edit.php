<?php

class SM_Xmaincategory_Block_Adminhtml_Xmaincategory_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xmaincategory';
        $this->_controller = 'adminhtml_xmaincategory';
        
        $this->_updateButton('save', 'label', Mage::helper('xmaincategory')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('xmaincategory')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('xmaincategory_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'xmaincategory_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'xmaincategory_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('xmaincategory_data') && Mage::registry('xmaincategory_data')->getId() ) {
            return Mage::helper('xmaincategory')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('xmaincategory_data')->getTitle()));
        } else {
            return Mage::helper('xmaincategory')->__('Add Item');
        }
    }
}