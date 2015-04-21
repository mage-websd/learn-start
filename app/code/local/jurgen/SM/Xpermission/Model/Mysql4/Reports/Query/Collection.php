<?php
/**
 * Catalog search query collection
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Reports_Query_Collection extends Mage_CatalogSearch_Model_Mysql4_Query_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('store_id in (?)', $_storeList);
		//print"<pre>"; print_r($this->getSelect());
        return $this;
    }
}
