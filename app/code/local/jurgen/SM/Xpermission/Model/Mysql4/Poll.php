<?php


class SM_Xpermission_Model_Mysql4_Poll extends Mage_Poll_Model_Mysql4_Poll {

    public function _afterSave(Mage_Core_Model_Abstract $object) {
        /** stores */
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $deleteWhere = $this->_getWriteAdapter()->quoteInto('poll_id = ?', $object->getId());
            $this->_getWriteAdapter()->delete($this->getTable('poll/poll_store'), $deleteWhere);

            foreach ($object->getStoreIds() as $storeId) {
                $pollStoreData = array(
                        'poll_id'   => $object->getId(),
                        'store_id'  => $storeId
                );
                $this->_getWriteAdapter()->insert($this->getTable('poll/poll_store'), $pollStoreData);
            }

            /** answers */
            foreach ($object->getAnswers() as $answer) {
                $answer->setPollId($object->getId());
                $answer->save();
            }
        }else {
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $_storeList = Mage::getModel('core/website')->load($_websiteList)->getStoreIds();
            $_storeList = implode(",", $_storeList);
            //Sua lai menh de where
            //$where = $this->_getWriteAdapter()->quoteInto('poll_id IN (?)', $object->getId());
            $where = " poll_store.store_id in (".$_storeList.")";
            $this->_getWriteAdapter()->delete($this->getTable('poll/poll_store'), $where);
            foreach ($object->getStoreIds() as $storeId) {
                $pollStoreData = array(
                        'poll_id'   => $object->getId(),
                        'store_id'  => $storeId
                );
                $this->_getWriteAdapter()->insert($this->getTable('poll/poll_store'), $pollStoreData);
            }

            /** answers */
            foreach ($object->getAnswers() as $answer) {
                $answer->setPollId($object->getId());
                $answer->save();
            }
        }
    }

    public function delete(Mage_Core_Model_Abstract $object) {
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $this->_beforeDelete($object);
            $this->_getWriteAdapter()->delete(
                    $this->getMainTable(),
                    $this->_getWriteAdapter()->quoteInto($this->getIdFieldName().'=?', $object->getId())
            );
            $this->_afterDelete($object);
            return $this;
        }else{
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $_storeList = Mage::getModel('core/website')->load($_websiteList)->getStoreIds();
            $_storeList = implode(",", $_storeList);
            $where = " poll_store.store_id in (".$_storeList.")";
            $this->_getWriteAdapter()->delete($this->getTable('poll/poll_store'), $where);
        }
    }
}