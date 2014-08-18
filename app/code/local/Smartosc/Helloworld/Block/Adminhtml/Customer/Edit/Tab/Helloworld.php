<?php
class Smartosc_Helloworld_Block_Adminhtml_Customer_Edit_Tab_Helloworld
    extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        $this->setTemplate('smartosc/helloworld/customer/main.phtml');
        parent::_construct();
    }
    public function getCustomerId()
    {
        return Mage::registry('current_customer')->getId();
    }
    public function getTabLabel()
    {
        return $this->__('Helloworld List');
    }
    public function getTabTitle()
    {
        return $this->__
            ('Click to view the customer Smartosc Helloworld');
    }
    public function canShowTab()
    {
        return true;
    }
    public function isHidden()
    {
        return false;
    }
}