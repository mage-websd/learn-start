<?php
class SM_Xpermission_Model_Mysql4_User extends Mage_Admin_Model_Mysql4_User {
    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('xpermission/user_website'))
                ->where('user_id = ?', $object->getId());

        if ($result = $this->_getReadAdapter()->fetchRow($select)) {
            $object->setData('website_id', $result['website_id']);
            $object->setData('default_store_id', $result['default_store_id']);
        }

        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('xpermission/root'))
                ->where('user_id = ?', $object->getId());

        if ($result = $this->_getReadAdapter()->fetchRow($select)) {
            $object->setData('is_root', $result['is_root']);
        } else {
            $object->setData('is_root', 0);
        }
        return parent::_afterLoad($object);
    }
    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('core/store'))
                ->where('store_id = ?', $object->default_store_id);
        $result = $this->_getReadAdapter()->fetchRow($select);
        $_adapter = $this->_getWriteAdapter();
        $_adapter->beginTransaction();
        try {
            if ($result) {
                $_adapter->delete($this->getTable('xpermission/user_website'), "user_id = {$object->user_id}");
                $data = array(
                        'user_id'     => $object->user_id,
                        'website_id'     => (int)$result['website_id'],
                        'default_store_id'     => (int)$object->default_store_id);
                $_adapter->insert($this->getTable('xpermission/user_website'), $data);
            }
            if (isset($object->is_root)) {
                $_adapter->delete($this->getTable('xpermission/root'), "user_id = {$object->user_id}");
                $data = array('user_id' => $object->user_id, 'is_root' => (int)$object->is_root);
                $_adapter->insert($this->getTable('xpermission/root'), $data);
            }else {
                $_adapter->delete($this->getTable('xpermission/root'), "user_id = {$object->user_id}");
                $data = array('user_id' => $object->user_id, 'is_root' => '0');
                $_adapter->insert($this->getTable('xpermission/root'), $data);
            }
            $_adapter->commit();
        } catch (Mage_Core_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            $_adapter->rollBack();
        }

        return parent::_afterSave($object);
    }
    public function delete(Mage_Core_Model_Abstract $user) {
        $userID = $user->getId();
        $_adapter = $this->_getWriteAdapter();
        $_adapter->beginTransaction();
        try {
            $_adapter->delete($this->getTable('xpermission/user_website'), "user_id=$userID");
            $_adapter->delete($this->getTable('xpermission/root'), "user_id=$userID");
        } catch (Mage_Core_Exception $e) {
            throw $e;
            return false;
        } catch (Exception $e) {
            $_adapter->rollBack();
            return false;
        }
        $_adapter->commit();

        return parent::delete($user);
    }
}