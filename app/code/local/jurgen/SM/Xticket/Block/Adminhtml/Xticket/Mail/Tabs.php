<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


class SM_Xticket_Block_Adminhtml_Xticket_Mail_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
  	  $this->setId('xticket_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xticket')->__('Mail Responses'));
      parent::__construct();

  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xticket')->__('Mail Responses'),
          'title'     => Mage::helper('xticket')->__('Mail Responses'),
          'content'   => $this->getLayout()->createBlock('xticket/adminhtml_xticket_mail_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}