<?php
/**
 * Adminhtml newsletter subscribers grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Newsletter_Subscriber_Grid extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid {
    /**
     * override Prepare collection for grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection() {
        parent::_prepareCollection();
        $collection = $this->getCollection();
        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);
        return $this;
    }

//    /**
//     * Retrieve Website Options array
//     *
//     * @return array
//     */
    protected function _getWebsiteOptions() {
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            return Mage::getModel('adminhtml/system_store')->getWebsiteOptionHash();
        }
        $_websiteId = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
        return array($_websiteId=>Mage::getModel('core/website')->load($_websiteId)->getName());
    }
    /**
     * Retrieve Store Group Options array
     *
     * @return array
     */
    protected function _getStoreGroupOptions() {
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            return Mage::getModel('adminhtml/system_store')->getStoreGroupOptionHash();
        }
        $_websiteId = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
        $store_group = Mage::getModel('core/store_group')->getCollection()->addWebsiteFilter($_websiteId)->toOptionArray();
        //Convert array two dimensional into one dimentional and reverse
        $store_group = array_reverse($this->_getOptions($store_group));
        return $store_group;

    }
//    /**
//     * Retrieve Store Options array
//     *
//     * @return array
//     */
    protected function _getStoreOptions() {
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            return Mage::getModel('adminhtml/system_store')->getStoreOptionHash();
        }
        $_websiteId = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
        $stores = Mage::getModel('core/store')->getCollection()->addWebsiteFilter($_websiteId)->toOptionArray();
        //Convert array two dimensional into one dimentional
        $stores = $this->_getOptions($stores);
        return $stores;
    }
}
