<?php
class SM_Xpurchase_Block_Customer_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('customer')->__('Customer Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('account', array(
            'label'     => Mage::helper('customer')->__('Account Information'),
            'content'   => $this->getLayout()->createBlock('adminhtml/customer_edit_tab_account')->initForm()->toHtml(),
            'active'    => Mage::registry('current_customer')->getId() ? false : true
        ));

        $this->addTab('addresses', array(
            'label'     => Mage::helper('customer')->__('Addresses'),
            'content'   => $this->getLayout()->createBlock('adminhtml/customer_edit_tab_addresses')->initForm()->toHtml(),
        ));


        // load: Orders, Shopping Cart, Wishlist, Product Reviews, Product Tags - with ajax

        if (Mage::registry('current_customer')->getId()) {
            $this->addTab('orders', array(
                'label'     => Mage::helper('customer')->__('Orders'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/orders', array('_current' => true)),
             ));

            $this->addTab('cart', array(
                'label'     => Mage::helper('customer')->__('Shopping Cart'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/carts', array('_current' => true)),
            ));

            $this->addTab('wishlist', array(
                'label'     => Mage::helper('customer')->__('Wishlist'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/wishlist', array('_current' => true)),
            ));

            $this->addTab('newsletter', array(
                'label'     => Mage::helper('customer')->__('Newsletter'),
                'content'   => $this->getLayout()->createBlock('adminhtml/customer_edit_tab_newsletter')->initForm()->toHtml()
            ));

            $this->addTab('reviews', array(
                'label'     => Mage::helper('customer')->__('Product Reviews'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/productReviews', array('_current' => true)),
            ));

            $this->addTab('tags', array(
                'label'     => Mage::helper('customer')->__('Product Tags'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/productTags', array('_current' => true)),
            ));

            $this->addTab('purchases', array(
                'label'     => Mage::helper('customer')->__('Purchases'),
                'class'     => 'ajax',
                'url'       => $this->getUrl('xpurchase_admin/customer/purchases', array('_current' => true)),
            ));
        }
        
        $this->_updateActiveTab();
        Varien_Profiler::stop('customer/tabs');
        return parent::_beforeToHtml();
    }

    protected function _updateActiveTab()
    {
    	$tabId = $this->getRequest()->getParam('tab');
    	if( $tabId ) {
    		$tabId = preg_replace("#{$this->getId()}_#", '', $tabId);
    		if($tabId) {
    			$this->setActiveTab($tabId);
    		}
    	}
    }
}