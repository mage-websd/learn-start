<?php

class SM_Youtube_Block_Adminhtml_Youtube_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'sm_youtube';
        $this->_controller = 'adminhtml_youtube';

        $this->_updateButton('save', 'label', Mage::helper('sm_youtube')->__('Save Youtube'));
        $this->_updateButton('delete', 'label', Mage::helper('sm_youtube')->__('Delete'));
    }

    public function getHeaderText()
    {
        $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
        $this->_headerText = $newOrEdit . ' ' . $this->__('Manage Youtube');
        return parent::getHeaderText();
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/'.$this->_controller.'/save', array('_current'=>true, 'back'=>null));
    }
}