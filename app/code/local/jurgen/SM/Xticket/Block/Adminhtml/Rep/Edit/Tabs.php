<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Rep_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
  	  $this->setId('rep_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xticket')->__('Representative'));
      parent::__construct();

  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xticket')->__('Representative'),
          'title'     => Mage::helper('xticket')->__('Representative'),
          'content'   => $this->getLayout()->createBlock('xticket/adminhtml_rep_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}