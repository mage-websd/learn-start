<?php
class SM_Xblock_Model_Mysql4_Item_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('xblock/item');

    }

    public function addEnableFilter($status) {
        $this->getSelect()
                ->where('is_active = ?', $status);
        return $this;
    }

    public function addItemFilter($blockID) {
        $this->getSelect()
                ->where('main_table.block_id = ?', $blockID);
        return $this;
    }

    public function addStoreFilter($storeId) {
            $this->getSelect()->join(
                                array('store_table' => $this->getTable('store')),
                                'main_table.block_id = store_table.block_id',
                                array()
                                )
                    ->where('store_table.store_id in (?)', array(0, $storeId));
            return $this;
    }

    public function addRandom($blockID){
        $this->getSelect()
                ->where('main_table.block_id = ?', $blockID)->order('RAND()')->limit(1);
        return $this;
    }
}
