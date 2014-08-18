<?php
class Smartosc_Helloworld_Block_Adminhtml_Registries extends
    Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct(){
        $this->_controller = 'adminhtml_registries';
        $this->_blockGroup = 'helloworld';
        $this->_headerText = Mage::helper
            ('helloworld')->__('Gift Registry Manager');
        parent::__construct();
    }
}