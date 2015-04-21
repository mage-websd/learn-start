<?php
/**
 *
 * @category   Smart
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */

class SM_Xblock_Model_Mysql4_Schedule_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract{
    public function _construct(){
        $this->_init('xblock/schedule');
    }

	
    protected function _afterLoad(){
		$items = $this->getColumnValues('block_id');
		if (count($items)) {
			$select = $this->getConnection()->select()
					->from($this->getTable('schedule'));
			if ($result = $this->getConnection()->fetchPairs($select)) {
				foreach ($this as $item) {
					if (!isset($result[$item->getData('block_id')])) {
						continue;
					}
				}
			}
		}

        parent::_afterLoad();
    }
	
//	
//	public function addStoreFilter($store){
//		if (!Mage::app()->isSingleStoreMode()) {
//			if ($store instanceof Mage_Core_Model_Store) {
//				$store = array($store->getId());
//			}
//	
//			$this->getSelect()->joinLeft(
//				array('store_table' => $this->getTable('cat_store')),
//				'main_table.cat_id = store_table.cat_id',
//				array()
//			)
//			->where('store_table.store_id = 0 
//					OR store_table.store_id = \''.$store.'\'
//					OR store_table.store_id IS NULL
//			');
//			
//	
//	
//	
//			return $this;
//		}
//		return $this;
//	}
//	
//	public function addPostFilter($postId){
//		$this->getSelect()->join(
//			array('cat_table' => $this->getTable('post_cat')),
//			'main_table.cat_id = cat_table.cat_id',
//			array()
//		)
//		->where('cat_table.post_id = ?', $postId);

//		return $this;
//    }
}
