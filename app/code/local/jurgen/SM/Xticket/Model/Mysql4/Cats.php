<?php

class SM_Xticket_Model_Mysql4_Cats extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        // Note that the id refers to the key field in your database table.
       $this->_init('xticket/cats', 'id');
    }
    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $condition = $this->_getWriteAdapter()->quoteInto('department_id = ?', $object->getId());
        $this->_getReadAdapter()->delete($this->getTable('categories_store'), $condition);
        if (!$object->getData('stores')) {
            $storeArray = array();
            $storeArray['department_id'] = $object->getId();
            $storeArray['store_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('categories_store'), $storeArray);
        }
        else {
            foreach ((array)$object->getData('stores') as $store) {
                $storeArray = array();
                $storeArray['department_id'] = $object->getId();
                $storeArray['store_id'] = $store;
                $this->_getWriteAdapter()->insert($this->getTable('categories_store'), $storeArray);
            }
        }
        return parent::_afterSave($object);
    }

    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
		$select = $this->_getReadAdapter()->select()
                ->from($this->getTable('categories_store'))
                ->where('department_id = ?', $object->getId());
        $result = $this->_getReadAdapter()->fetchAll($select);
        $storesArray = array();
        foreach ($result as $row) {
            $storesArray[] = $row['store_id'];
        }
        $object->setData('store_id', $storesArray);

        return parent::_afterLoad($object);
    }

    protected function _getLoadSelect($field, $value, $object) { 
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $select->join(array('cs' => $this->getTable('categories_store')), $this->getMainTable().'.id = `cs`.department_id')
                    ->where('`cs`.store_id in (0, ?) ', $object->getStoreId())
                    ->order('store_id DESC')
                    ->limit(1);
        }
		
		return $select;
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xticket/categories_store'), 'department_id='.$object->getId());
    }

    public function getDepartmentActive() {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xticket/cats'))
                ->where('is_active = ?', 1);
        //echo $select._($select); exit;
        return $this->_getReadAdapter()->fetchAll($select);
    }

    public function getDepartmentByEmail($email) {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xticket/cats'))
                ->where('email= ?', $email);
        //echo $select._($select); exit;
        return $this->_getReadAdapter()->fetchOne($select);
    }

}