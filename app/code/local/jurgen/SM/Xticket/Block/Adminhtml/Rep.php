<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


class SM_Xticket_Block_Adminhtml_Rep extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_rep';
    $this->_blockGroup = 'xticket';
    $this->_headerText = Mage::helper('xticket')->__('View Representative');
    $this->_addButtonLabel = Mage::helper('xticket')->__('New Representative');
    parent::__construct();
  }
}