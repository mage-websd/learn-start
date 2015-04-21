<?php

class SM_Xticket_Model_Mysql4_CatStore extends Mage_Core_Model_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('xticket/categories_store');
    }

    public function getStoreById($id) {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xticket/categories_store'))
                ->where('store_id = ?', $id);
        return $this->_getReadAdapter()->fetchAll($select);
    }
}