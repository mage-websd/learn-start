<?php

/**
 * Reports quote collection
 *
 * @category   Mage
 * @package    Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Reports_Quote_Collection extends Mage_Reports_Model_Mysql4_Quote_Collection
{
     public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('main_table.store_id in (?)', $_storeList);
		//print_r($this->getSelect());
        return $this;
    }
}
