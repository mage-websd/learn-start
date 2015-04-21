<?php
/**
 * Report Reviews collection
 *
 * @category   Mage
 * @package    Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class SM_Xpermission_Model_Mysql4_Reports_Review_Collection extends Mage_Reports_Model_Mysql4_Review_Collection {

    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('store_id in (?)', $_storeList);
        return $this;
    }
}
