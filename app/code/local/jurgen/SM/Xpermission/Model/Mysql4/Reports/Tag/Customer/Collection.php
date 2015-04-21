<?php
/**
 * Tags customer collection
 *
 * @category   Mage
 * @package    Mage_Tag
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Reports_Tag_Customer_Collection extends Mage_Reports_Model_Mysql4_Tag_Customer_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('tr.store_id in (?)', $_storeList);
		//print_r($this->getSelect()->__toString());die;
        return $this;
    }
}