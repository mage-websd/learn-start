<?php
/**
 * Report Products Tags collection
 *
 * @category   Mage
 * @package    Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class SM_Xpermission_Model_Mysql4_Reports_Tag_Product_Collection extends Mage_Reports_Model_Mysql4_Tag_Product_Collection {
    public function addWebsiteFilterReports($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('store_id in (?)', $_storeList);
        return $this;
    }
}
