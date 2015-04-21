<?php
class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('xblock_item_tabs');
      $this->setDestElementId('edit_form');
//      $this->setTitle(Mage::helper('xblock')->__('Post Information'));
  }

  protected function _beforeToHtml()
  {
      
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xblock')->__('Item Information'),
          'title'     => Mage::helper('xblock')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_edit_tab_form')->toHtml(),
      ));
      return parent::_beforeToHtml();
  }
}
