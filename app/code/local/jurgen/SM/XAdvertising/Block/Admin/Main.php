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
 * XAdvertising Admin main block
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Block_Admin_Main extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
    	$this->_controller = 'admin_xadvertising';
        $this->_addButtonLabel = Mage::helper('xadvertising')->__('Add new advertive');
        $this->_blockGroup = 'xadvertising';
        $this->_headerText = Mage::helper('xadvertising')->__('Manager list link of advertive(s)');
        parent::__construct();
       // $this->setTemplate('xadvertising/main.phtml');
    }
    protected function _prepareLayout()
    {
        $this->setChild('add_new_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('xadvertising')->__('Add advertising'),
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
        $this->setChild('grid', $this->getLayout()->createBlock('xadvertising/admin_xadvertising_grid','xadvertising.grid'));
        return parent::_prepareLayout();
    }
    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_new_button');
    }
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
    public function getStoreSwitcherHtml()
    {
        return $this->getChildHtml('store_switcher');
    }
   
}