<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 11/3/2014
 * Time: 6:16 AM
 */

class SM_Youtube_Block_Adminhtml_Youtube extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_youtube';
        $this->_blockGroup = 'sm_youtube';
        $this->_headerText = Mage::helper('sm_youtube')->__('Manager Youtube');
        $this->_addButtonLabel = Mage::helper('sm_youtube')->__('Add New Youtube');

        parent::__construct();
    }

}
