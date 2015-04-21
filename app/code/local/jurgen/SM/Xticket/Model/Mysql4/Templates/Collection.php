<?php

class SM_Xticket_Model_Mysql4_Templates_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('xticket/templates');
    }

    public function addStoreFilter($store) {
        if (!Mage::app()->isSingleStoreMode()) {
            if ($store instanceof Mage_Core_Model_Store) {
                $store = array($store->getId());
            }

            $this->getSelect()->join(
                    array('store_table' => $this->getTable('templates_store')),
                    'main_table.id = store_table.template_id',
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
                array('store' => $this->getTable('templates_store')),
                'main_table.id = store.template_id',
                array()
                )
                ->where('store.store_id in (?)', $_storeList)
                ->group('main_table.id');

        return $this;
    }
}