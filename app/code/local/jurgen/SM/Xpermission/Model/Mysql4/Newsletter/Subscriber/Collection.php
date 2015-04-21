<?php
/**
 * Newsletter Subscribers Collection
 *
 * @category   Mage
 * @package    Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 * @todo       Refactoring this collection to Mage_Core_Model_Mysql4_Collection_Abstract.
 */

class SM_Xpermission_Model_Mysql4_Newsletter_Subscriber_Collection extends Mage_Newsletter_Model_Mysql4_Subscriber_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->where('main_table.store_id in (?)', $_storeList);
        return $this;
    }
}