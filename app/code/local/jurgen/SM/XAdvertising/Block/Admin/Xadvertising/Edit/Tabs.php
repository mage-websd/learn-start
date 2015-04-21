<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * XAdvertising edit tabs block
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Block_Admin_Xadvertising_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('xadvertising_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('xadvertising')->__('Xadvertising Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('xadvertising')->__('Information'),
          'title'     => Mage::helper('xadvertising')->__('Information'),
          'content'   => $this->getLayout()->createBlock('xadvertising/admin_xadvertising_edit_tab_form')->toHtml(),
      ));
	 
      return parent::_beforeToHtml();
  }
}
