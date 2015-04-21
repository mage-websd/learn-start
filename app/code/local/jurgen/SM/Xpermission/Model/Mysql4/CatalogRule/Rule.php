<?php
/**
 * Catalog rules resource model
 */
class SM_Xpermission_Model_Mysql4_CatalogRule_Rule extends Mage_CatalogRule_Model_Mysql4_Rule
{
    /**
     * Prepare object data for saving
     *
     * @param Mage_Core_Model_Abstract $object
     */
    public function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if(is_null($object->getData('website_ids'))) {
            $object->setData('website_ids', Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }

        parent::_beforeSave($object);
    }

}