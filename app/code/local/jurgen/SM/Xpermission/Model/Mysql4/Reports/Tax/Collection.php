<?php

/**
 * Reports tax collection
 *
 * @category   Mage
 * @package    Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Reports_Tax_Collection extends Mage_Reports_Model_Mysql4_Tax_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('store_id in (?)', $_storeList);
        return $this;
    }
}
