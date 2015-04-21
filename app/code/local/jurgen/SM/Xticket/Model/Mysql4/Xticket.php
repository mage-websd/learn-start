<?php

class SM_Xticket_Model_Mysql4_Xticket extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        // Note that the softicket_id refers to the key field in your database table.
        $this->_init('xticket/xticket', 'ID');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        foreach($object->getData('stores') as $value) {
            $condition = array(
                $this->_getWriteAdapter()->quoteInto('id = ?', $object->getId()),
                $this->_getWriteAdapter()->quoteInto('store_id = ?', $value)
            );
            $this->_getReadAdapter()->delete($this->getTable('tickets_store'), $condition);
        }
        if (!$object->getData('stores')) {
            $storeArray = array();
            $storeArray['ticket_id'] = $object->getId();
            $storeArray['store_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('tickets_store'), $storeArray);
        } else {
            foreach ((array)$object->getData('stores') as $store) {
                $storeArray = array();
                $storeArray['ticket_id'] = $object->getId();
                $storeArray['store_id'] = $store;
                $this->_getWriteAdapter()->insert($this->getTable('tickets_store'), $storeArray);
            }
        }
        return parent::_afterSave($object);
    }

    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
		 $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('tickets_store'))
                ->where('store_id = ?', $object->getId());
        $result = $this->_getReadAdapter()->fetchAll($select);
        $storesArray = array();
        foreach ($result as $row) {
            $storesArray[] = $row['store_id'];
        }
        $object->setData('store_id', $storesArray);

        return parent::_afterLoad($object);
    }

    protected function _getLoadSelect($field, $value, $object) { //die('_getLoadSelect');
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $select->join(array('ts' => $this->getTable('tickets_store')), $this->getMainTable().'.id = `ts`.ticket_id')
                    ->where('`ts`.store_id in (0, ?) ', $object->getStoreId())
                    ->order('store_id DESC')
                    ->limit(1);
        }
        return $select;
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object) { 
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xticket/tickets_store'), 'ticket_id='.$object->getId());
    }

}