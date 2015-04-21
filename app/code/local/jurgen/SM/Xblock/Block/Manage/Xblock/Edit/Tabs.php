<?php
class SM_Xblock_Block_Manage_Xblock_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('xblock_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xblock')->__('Block Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xblock')->__('Block Information'),
          'title'     => Mage::helper('xblock')->__('Block Information'),
          'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_form')->toHtml(),
      ));
      $this->addTab('content_section', array(
          'label'     => Mage::helper('xblock')->__('Content'),
          'title'     => Mage::helper('xblock')->__('Content'),
          'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_grid', 'xblock.grid')->toHtml(),
      ));
      $this->addTab('content_section', array(
          'label'     => Mage::helper('xblock')->__('Content'),
          'title'     => Mage::helper('xblock')->__('Content'),
          'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item')->toHtml(),
      ));
      $this->addTab('schedule_section', array(
          'label'     => Mage::helper('xblock')->__('Schedule'),
          'title'     => Mage::helper('xblock')->__('Schedule'),
          'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_schedule')->toHtml(),
      )); 
	  $this->addTab('categories', array(
	      'label'     => Mage::helper('catalog')->__('Categories'),
	      'content'   => $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_categories')->toHtml(),
	  ));	    
//        $this->addTab('categories', array(
//            'label'     => Mage::helper('xblock')->__('Categories'),
//            'url'       => $this->getUrl('catalog_product/'),
//            'class'     => 'ajax',
//        ));            
      return parent::_beforeToHtml();
  }
}
