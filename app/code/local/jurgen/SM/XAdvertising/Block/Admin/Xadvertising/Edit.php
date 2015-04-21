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
 * XAdvertising admin form edit
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Block_Admin_Xadvertising_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xadvertising';
        $this->_controller = 'admin_xadvertising';
        
        $this->_updateButton('save', 'label', Mage::helper('xadvertising')->__('Save Advertising'));
        $this->_updateButton('delete', 'label', Mage::helper('xadvertising')->__('Delete Advertising'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('xadvertising_data') && Mage::registry('xadvertising_data')->getId() ) {
            return Mage::helper('xadvertising')->__("Edit Post '%s'", $this->htmlEscape(Mage::registry('xadvertising_data')->getTitle()));
        } else {
            return Mage::helper('xadvertising')->__('Add Advertising');
        }
    }
}
