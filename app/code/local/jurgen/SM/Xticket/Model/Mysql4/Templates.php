<?php

class SM_Xticket_Model_Mysql4_Templates extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        // Note that the id refers to the key field in your database table.
        $this->_init('xticket/templates', 'id');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) { 
        $condition = $this->_getWriteAdapter()->quoteInto('template_id = ?', $object->getId());
		
        $this->_getReadAdapter()->delete($this->getTable('templates_store'), $condition);
        //print"<pre>"; print_r($object->getData('stores')); die;
        if (!$object->getData('stores')) {
            $storeArray = array();
            $storeArray['template_id'] = $object->getId();
            $storeArray['store_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('templates_store'), $storeArray);
        }
        else {
            foreach ((array)$object->getData('stores') as $store) {
                $storeArray = array();
                $storeArray['template_id'] = $object->getId();
                $storeArray['store_id'] = $store;
                //print"<pre>"; print_r($storeArray); die;
                $this->_getWriteAdapter()->insert($this->getTable('templates_store'), $storeArray);
            }
        }
        return parent::_afterSave($object);
    }
    
    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('templates_store'))
                ->where('template_id = ?', $object->getId());
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
            $select->join(array('ts' => $this->getTable('templates_store')), $this->getMainTable().'.id = `ts`.template_id')
                    ->where('`ts`.store_id in (0, ?) ', $object->getStoreId())
                    ->order('store_id DESC')
                    ->limit(1);
        }
        return $select;
    }
    
    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xticket/templates_store'), 'id='.$object->getId());
    }


    public function getTemplateActive() {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xticket/templates'))
                ->where('is_active = ?', 1);
        return $this->_getReadAdapter()->fetchAll($select);
    }

    public function getTemplate($id) {
        $select = $this->_getReadAdapter()
                ->select()
                ->from($this->getTable('xticket/templates'))
                ->where('id = ?', $id)
                ->where('is_active = ?', 1);
        return $this->_getReadAdapter()->fetchAll($select);
    }
}