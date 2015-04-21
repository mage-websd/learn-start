<?php
class SM_Xblock_Model_Mysql4_Xblock_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('xblock/xblock');

    }

    public function addEnableFilter($status) {
        $this->getSelect()
                ->where('is_active = ?', $status);
        return $this;
    }


    /**
     * Add Filter by store
     *
     * @param int|Mage_Core_Model_Store $store
     * @return Mage_Cms_Model_Mysql4_Page_Collection
     */
    public function addStoreFilter($store) {
        if (!Mage::app()->isSingleStoreMode()) {
            if ($store instanceof Mage_Core_Model_Store) {
                $store = array($store->getId());
            }

            $this->getSelect()->join(
                    array('store_table' => $this->getTable('store')),
                    'main_table.block_id = store_table.block_id',
                    array()
                    )
                    ->where('store_table.store_id in (?)', array(0, $store));

            return $this;
        }
        return $this;
    }

    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();

        $this->getSelect()->join(
                array('store_table' => $this->getTable('store')),
                'main_table.block_id = store_table.block_id',
                array()
                )
                ->where('store_table.store_id in (?)', $_storeList)
                ->group('main_table.block_id');

        return $this;
    }
}
