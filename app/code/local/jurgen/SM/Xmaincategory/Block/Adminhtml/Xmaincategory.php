<?php
class SM_Xmaincategory_Block_Adminhtml_Xmaincategory extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_xmaincategory';
    $this->_blockGroup = 'xmaincategory';
    $this->_headerText = Mage::helper('xmaincategory')->__('Main Category Manager');
    $this->_addButtonLabel = Mage::helper('xmaincategory')->__('Add Main Category');
    parent::__construct();
  }
}