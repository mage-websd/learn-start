<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Xticket_Edit_NewTabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('xticket_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xticket')->__('Ticket Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xticket')->__('Ticket Information'),
          'title'     => Mage::helper('xticket')->__('Ticket Information'),
          'content'   => $this->getLayout()->createBlock('xticket/adminhtml_xticket_edit_tab_newgeneral')->toHtml(),
      ));
      $this->addTab('form_section_note', array(
          'label'     => Mage::helper('xticket')->__('Notes'),
          'title'     => Mage::helper('xticket')->__('Notes'),
          'content'   => $this->getLayout()->createBlock('xticket/adminhtml_xticket_edit_tab_note')->toHtml(),
      ));     
      return parent::_beforeToHtml();
  }
  
  
}