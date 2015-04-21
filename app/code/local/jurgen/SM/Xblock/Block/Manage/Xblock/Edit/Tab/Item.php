<?php
class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{                     
		$this->_controller = 'manage_xblock';
		$this->_blockGroup = 'xblock';
		$this->_headerText = Mage::helper('xblock')->__('Block Manager1');
		parent::__construct();
//        $this->_addButton('saveandcontinue', array(
//            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit1'),
//            'onclick'   => 'saveAndContinueEdit()',
//            'class'     => 'save',
//        ), -100);
		//$this->setChild('grid', $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_grid', 'item.grid'));
		//$this->setGridHtml('grid');
//            $message = Mage::helper('sales')->__('Are you sure you want to cancel this order?');
//            $this->_addButton('order_cancel', array(
//                'label'     => Mage::helper('sales')->__('Cancel'),
//                'onclick'   => 'deleteConfirm(\''.$message.'\', \'' . $this->getCancelUrl() . '\')',
//            ));
		
		$this->setTemplate('sm_xblock/items.phtml');
	}

    protected function _prepareLayout()
    {
//        $this->setChild('add_new_button',
//            $this->getLayout()->createBlock('adminhtml/widget_button')
//                ->setData(array(
//                    'label'     => Mage::helper('xblock')->__('Add Item1'),
//                    'onclick'   => "setLocation('".$this->getUrl('*/*/new')."')",
//                    'class'   => 'add'
//                    ))
//                );
        $blockId = (int) Mage::app()->getRequest()->getParam('id', false);
		$this->setChild('add_new_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('xblock')->__('Add Item'),
                    //'onclick'   => "setLocation('".$this->getUrl('*/*/new')."')",
                    'onclick'	=>	"setLocation('". $this->getUrl('*/manage_item/new/', array('block_id' => $blockId))."')",
					'class'   => 'add'
                    ))
                );				
        /**
         * Display store switcher if system has more one store
         */
//        if (!Mage::app()->isSingleStoreMode()) {
//            $this->setChild('store_switcher',
//                $this->getLayout()->createBlock('adminhtml/store_switcher')
//                    ->setUseConfirm(false)
//                    ->setSwitchUrl($this->getUrl('*/*/*', array('store'=>null)))
//            );
//        }
       $this->setChild('grid', $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_grid', 'item.grid'));
       // return parent::_prepareLayout();
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
