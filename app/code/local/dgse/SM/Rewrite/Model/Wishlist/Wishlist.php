<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/15/14
 * Time: 5:52 PM
 */ 
class SM_Rewrite_Model_Wishlist_Wishlist extends Mage_Wishlist_Model_Wishlist {
    public function getItemCollection()
    {
        if (is_null($this->_itemCollection)) {
            /** @var $currentWebsiteOnly boolean */
            $currentWebsiteOnly = !Mage::app()->getStore()->isAdmin();
            $this->_itemCollection = Mage::getResourceModel('wishlist/item_collection')
                ->addWishlistFilter($this)
                ->addStoreFilter($this->getSharedStoreIds($currentWebsiteOnly));

            if (Mage::app()->getStore()->isAdmin()) {
                $customer = Mage::getModel('customer/customer')->load($this->getCustomerId());
                $this->_itemCollection->setWebsiteId($customer->getWebsiteId());
                $this->_itemCollection->setCustomerGroupId($customer->getGroupId());
            }
        }

        return $this->_itemCollection;
    }
}