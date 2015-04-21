<?php
class SM_Xpermission_Model_Mysql4_Poll_Collection extends Mage_Poll_Model_Mysql4_Poll_Collection {

    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();

        $this->getSelect()->join(
                array('store_table' => $this->getTable('poll/poll_store')),
                'main_table.poll_id = store_table.poll_id',
                array()
                )
                ->where('store_table.store_id in (?)', $_storeList)
                ->group('main_table.poll_id');

        return $this;
    }
}