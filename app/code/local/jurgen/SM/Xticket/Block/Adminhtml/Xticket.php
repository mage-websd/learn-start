<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
 
class SM_Xticket_Block_Adminhtml_Xticket extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_xticket';
    $this->_blockGroup = 'xticket';
    $this->_headerText = Mage::helper('xticket')->__('View Tickets');
    $this->_addButtonLabel = Mage::helper('xticket')->__('New Ticket');
    parent::__construct();
    $this->setTemplate('sm_xticket/tickets.phtml');
  }

    protected function _prepareLayout() {
        $this->setChild('add_new_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label'     => Mage::helper('xticket')->__('Add Ticket'),
                'onclick'   => "setLocation('".$this->getUrl('*/*/new')."')",
                'class'   => 'add'
                ))
        );
        /**
         * Display store switcher if system has more one store
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $this->setChild('store_switcher',
                    $this->getLayout()->createBlock('adminhtml/store_switcher')
                    ->setUseConfirm(false)
                    ->setSwitchUrl($this->getUrl('*/*/*', array('store'=>null)))
            );
        }
        $this->setChild('grid', $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid', 'xticket.grid'));
        return parent::_prepareLayout();
    }
    public function getAddNewButtonHtml() {
        return $this->getChildHtml('add_new_button');
    }

    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    public function getStoreSwitcherHtml() {
        return $this->getChildHtml('store_switcher');
    }
}