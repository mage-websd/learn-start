<?php
class SM_Xblock_Model_Mysql4_Item extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct(){    
        $this->_init('xblock/item', 'item_id');
    }
	
	protected function _afterSave(Mage_Core_Model_Abstract $object){                  //  print"<pre>"; print_r($object->getId());  die();
		$condition = $this->_getWriteAdapter()->quoteInto('item_id = ?', $object->getId());
        //$this->_getWriteAdapter()->delete($this->getTable('store'), $condition);
         
        //print"<pre>"; print_r($object->getData('sort_order')); die("trinhdd");
//		if (!$object->getData('stores'))
//		{
//			$storeArray = array();
//            $storeArray['block_id'] = $object->getId();
//            $storeArray['store_id'] = '0';
//            $this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
//		}
//		else
//		{
//			foreach ((array)$object->getData('stores') as $store) {
//				$storeArray = array();
//				$storeArray['block_id'] = $object->getId();
//				$storeArray['store_id'] = $store;
//				$this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
//			}
//		}

        return parent::_afterSave($object);
    }
	
	/**
     *
     * @param Mage_Core_Model_Abstract $object
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {                                 
        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('store'))
            ->where('block_id = ?', $object->getId());
		$blockId = Mage::app()->getRequest()->getParam('block_id');
		if(!empty($blockId)) 
		{
			$object->setData('block_id', Mage::app()->getRequest()->getParam('block_id'));
		}		
        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $storesArray = array();
            foreach ($data as $row) {
                $storesArray[] = $row['store_id'];
            }
            $object->setData('store_id', $storesArray);
        }

        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {                        
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $select->join(array('cps' => $this->getTable('store')), $this->getMainTable().'.block_id = `cps`.block_id')
                    ->where('`cps`.store_id in (0, ?) ', $object->getStoreId())
                    ->order('store_id DESC')
                    ->limit(1);
        }
        return $select;
    }
	
    protected function _beforeDelete(Mage_Core_Model_Abstract $object){
		
		// Cleanup stats on blog delete
		$adapter = $this->_getReadAdapter();
		// 1. Delete blog/store
		$adapter->delete($this->getTable('xblock/store'), 'block_id='.$object->getId());
	}
}
