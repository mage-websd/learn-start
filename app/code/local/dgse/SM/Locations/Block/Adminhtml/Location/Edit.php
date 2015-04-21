<?php

class SM_Locations_Block_Adminhtml_Location_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'sm_locations';
        $this->_controller = 'adminhtml_location';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Location'));
        $this->_updateButton('delete', 'label', $this->__('Delete Loctation'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        }
    }

    public function getHeaderText()
    {
        if(Mage::registry('sm_locations')->getId())
        {
            return $this->__('Edit Location');
        } else {
            return $this->__('New Location');
        }
    }

}