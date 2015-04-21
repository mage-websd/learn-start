<?php
/**
 * Template db resource
 *
 * @category   Mage
 * @package    Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Newsletter_Template extends Mage_Newsletter_Model_Mysql4_Template {

    public function _afterLoad(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('xpermission/newsletter_template_website'))
                ->where('template_id=?', $object->getId());

        if ($result = $this->_getReadAdapter()->fetchRow($select)) {
            $object->setData('website_id', $result['website_id']);
            // print_r($data['website_id']);die;
        }
        return parent::_afterLoad($object);
    }

    //    Perform actions after object save
    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $_adapter = $this->_getWriteAdapter();
        $_adapter->beginTransaction();
        try {
            $_websiteTable = Mage::getSingleton('core/resource')->getTableName('xpermission/newsletter_template_website');
            $_adapter->delete($_websiteTable, $_adapter->quoteInto('template_id=?', $object->getId()));
            if (Mage::getSingleton('admin/session')->getUser()->isRoot()) {
//                if (Mage::app()->getRequest()->getPost('website_id')) {
                $data = array(
                        'template_id'     => $object->getId(),
                        'website_id'     => Mage::app()->getRequest()->getPost('website_id'));
//                } else {
//                    $data = array(
//                            'template_id'     => $object->getId(),
//                            'website_id'     => 0);
//                }
            } else {
                $data = array(
                        'template_id'     => $object->getId(),
                        'website_id'     => Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
            }
            $_adapter->insert($_websiteTable, $data);
            $_adapter->commit();
        } catch (Mage_Core_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            $_adapter->rollBack();
        }
        return parent::_afterSave($object);
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {

        // delete record in table sm_newsletter_template_website
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('xpermission/newsletter_template_website'), 'template_id='.$object->getId());
    }
}
