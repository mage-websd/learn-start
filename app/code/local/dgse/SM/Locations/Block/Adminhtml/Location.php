<?php

class SM_Locations_Block_Adminhtml_Location extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'sm_locations';
        $this->_controller = 'adminhtml_location';
        $this->_headerText = $this->__('Location');

        parent::__construct();
    }
}