<?php

class SM_Xmaincategory_Block_Adminhtml_Xmaincategory_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('xmaincategory_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xmaincategory')->__('Main Category Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xmaincategory')->__('Item Information'),
          'title'     => Mage::helper('xmaincategory')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('xmaincategory/adminhtml_xmaincategory_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}