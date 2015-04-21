<?php
/**
 * Newsletter queue collection.
 *
 * @category   Mage
 * @package    Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class SM_Xpermission_Model_Mysql4_Newsletter_Queue_Collection extends Mage_Newsletter_Model_Mysql4_Queue_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
        $this->getSelect()->join(
                array('store_table' => $this->getTable('newsletter/queue_store_link')),
                'main_table.queue_id = store_table.queue_id',
                array()
                )
                ->where('store_table.store_id in (?)', $_storeList)
                ->group('main_table.queue_id');
        return $this;
    }
}
