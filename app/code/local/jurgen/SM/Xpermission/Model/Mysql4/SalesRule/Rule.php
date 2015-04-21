<?php
class SM_Xpermission_Model_Mysql4_SalesRule_Rule extends Mage_SalesRule_Model_Mysql4_Rule {
    public function _beforeSave(Mage_Core_Model_Abstract $object) {
        parent::_beforeSave($object);
        if(is_null($object->getData('website_ids'))) {
            $object->setData('website_ids', Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
    }

}