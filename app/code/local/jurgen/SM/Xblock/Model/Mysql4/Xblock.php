<?php
class SM_Xblock_Model_Mysql4_Xblock extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        $this->_init('xblock/xblock', 'block_id');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $condition = $this->_getWriteAdapter()->quoteInto('block_id = ?', $object->getId());
        $this->_getReadAdapter()->delete($this->getTable('store'), $condition);
        $this->_getReadAdapter()->delete($this->getTable('xblock/category'), $condition);

        if (!$object->getData('stores')) {
            $storeArray = array();
            $storeArray['block_id'] = $object->getId();
            $storeArray['store_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
        }
        else {
            foreach ((array)$object->getData('stores') as $store) {
                $storeArray = array();
                $storeArray['block_id'] = $object->getId();
                $storeArray['store_id'] = $store;
                $this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
            }
        }

        if (!$object->getData('category_ids')) {
            $categoryArray = array();
            $categoryArray['block_id'] = $object->getId();
            $categoryArray['category_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('xblock/category'), $categoryArray);
        }
        else {
            if(($object->getData('category_ids'))) {
                $category_exp = explode(',', $object->getData('category_ids'));
                $category_exp = array_unique($category_exp);
            }
            foreach ($category_exp as $category) {
                if(strlen($category) > 0) {
                    $categoryArray = array();
                    $categoryArray['block_id'] = $object->getId();
                    $categoryArray['category_id'] = $category;
                    $this->_getWriteAdapter()->insert($this->getTable('xblock/category'), $categoryArray);
                }

            }
        }
        return parent::_afterSave($object);
    }

    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('store'))
                ->where('block_id = ?', $object->getId());
        $result = $this->_getReadAdapter()->fetchAll($select);
        $storesArray = array();
        foreach ($result as $row) {
            $storesArray[] = $row['store_id'];
        }
        $object->setData('store_id', $storesArray);

        $selectCategory = $this->_getReadAdapter()->select()
                ->from($this->getTable('category'))
                ->where('block_id = ?', $object->getId());
        $resultCategory = $this->_getWriteAdapter()->fetchAll($selectCategory);
        $categoryArray = array();
        foreach( $resultCategory as $row) {
            $categoryArray[] = $row['category_id'];
        }
        $object->setData('category_id', $categoryArray);
        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object) { //die('_getLoadSelect');
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $select->join(array('bs' => $this->getTable('store')), $this->getMainTable().'.block_id = `bs`.block_id')
                    ->join(array('item' => $this->getTable('item')), $this->getMainTable().'.block_id = `item`.block_id' )
                    ->where('`bs`.store_id in (0, ?) ', $object->getStoreId())
                    ->order('store_id DESC')
                    ->limit(1);
        }
//        $result = $this->_getReadAdapter()->fetchAll($select);
//        print"<pre>"; print_r($result); die;
        return $select;
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xblock/store'), 'block_id='.$object->getId());
        $adapter->delete($this->getTable('xblock/category'), 'block_id='.$object->getId());
        $adapter->delete($this->getTable('xblock/item'), 'block_id='.$object->getId());
    }

    public function getBlockId($position) {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xblock/xblock'))
                ->where('is_active = ?', 1)
                ->where('default_position = ?', $position);
        return (int)$this->_getReadAdapter()->fetchOne($select);
    }

    public function getBlockCategoryId($position) {
        $categoryId = (int) Mage::app()->getRequest()->getParam('id', false);
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xblock/xblock'))
                ->join(array('cat' => $this->getTable('category')), $this->getMainTable().'.block_id = `cat`.block_id')
                ->join(array('s' => $this->getTable('store')), $this->getMainTable().'.block_id = `s`.block_id')
                ->join(array('i' => $this->getTable('item')), $this->getMainTable().'.block_id = `i`.block_id')
                ->where($this->getMainTable().'.is_active = ?', 1)
                ->where('i'.'.is_active_item = ?', 1)
                ->where('default_position = ?', $position)
                ->where('`cat`.category_id = ?', $categoryId)
                ->order('rand()')
        ;
        //echo $select._($select); exit;
        return (int)$this->_getReadAdapter()->fetchOne($select);
    }

    public function getDataById($blockId) {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xblock/xblock'))
                ->where('is_active = ?', 1)
                ->where('block_id = ?', $blockId);
        return $this->_getReadAdapter()->fetchRow($select);
    }
}
