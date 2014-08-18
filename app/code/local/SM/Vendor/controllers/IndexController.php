<?php

class SM_Vendor_IndexController extends Mage_Core_Controller_Front_Action
{
    private $_vendor; //cusotmer loggedin
    private $_vendorId;

    /**
     * check loggedin
     *
     * @return Mage_Core_Controller_Front_Action|void
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if(!Mage::getSingleton('customer/session')->isLoggedIn()) {
            $this->_redirect('customer/account');
            return;
        };
        $id = Mage::getSingleton("customer/session")->getData('id');
        $customer = Mage::getModel('customer/customer')->load($id);

        if($customer->getData('customer_type') != 'vendor') {
            $this->_redirect('customer/account');
            return;
        }
        $this->_vendor = $customer;
        $this->_vendorId = $id;
    }

    /**     *
     * indexAction: show list product vendor
     */
    public function indexAction()
    {
        $product = Mage::getModel('catalog/product');
        $productCollection = $product->getCollection()
            ->addAttributeToSelect('description')
            ->addAttributeToFilter('of_vendor',array('eq'=>$this->_vendorId));

        //array product
        $productArray = [];
        foreach($productCollection as $value) {
            $idproduct = $value->getData('entity_id');
            $productArray[] = $product->load($idproduct)->getData();
        }
        Mage::register('products',$productArray);
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * vendor info
     */
    public function infoAction()
    {
        Mage::register('vendor',$this->_vendor->getData());
        $this->loadLayout();
        $this->renderLayout();
    }
}