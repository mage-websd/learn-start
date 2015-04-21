<?php
/**
 * Template db resource
 *
 * @category   Mage
 * @package    Mage_Core
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Email_Template extends Mage_Core_Model_Mysql4_Email_Template {
    public function _afterLoad(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('xpermission/email_template_website'))
                ->where('template_id=?', $object->getId());

        if ($result = $this->_getReadAdapter()->fetchRow($select)) {
            $object->setData('website_id', $result['website_id']);
        }
        return parent::_afterLoad($object);
    }

    public function _beforeDelete(Mage_Core_Model_Abstract $object) {
        // delete record in table sm_email_template_website
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xpermission/email_template_website'), 'template_id='.$object->getId());
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $this->_write->beginTransaction();
        try {
            $_websiteTable = Mage::getSingleton('core/resource')->getTableName('xpermission/email_template_website');
            $this->_write->delete($_websiteTable, $this->_write->quoteInto('template_id=?', $object->getId()));
            if (Mage::getSingleton('admin/session')->getUser()->isRoot()) {
                if (Mage::app()->getRequest()->getPost('website_id')) {
                    $data = array(
                            'template_id'     => $object->getId(),
                            'website_id'     => Mage::app()->getRequest()->getPost('website_id'));
                } else {
                    $data = array(
                            'template_id'     => $object->getId(),
                            'website_id'     => 0);
                }
            } else {
                $data = array(
                        'template_id'     => $object->getId(),
                        'website_id'     => Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
            }
            $this->_write->insert($_websiteTable, $data);

            $this->_write->commit();
        }
        catch (Exception $e) {
            $this->_write->rollBack();
            throw $e;
        }
    }
}