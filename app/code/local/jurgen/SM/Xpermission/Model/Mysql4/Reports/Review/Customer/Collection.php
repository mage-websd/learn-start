<?php
/**
 * Report Customers Review collection
 *
 * @category   Mage
 * @package    Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Reports_Review_Customer_Collection extends Mage_Reports_Model_Mysql4_Review_Customer_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('store_id in (?)', $_storeList);
        return $this;
    }
}