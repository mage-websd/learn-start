<?php
class SM_Xpermission_Block_Poll_Grid extends Mage_Adminhtml_Block_Poll_Grid {
    protected function _prepareCollection() {
        $collection = Mage::getModel('poll/poll')->getCollection();
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            //filter by website
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $collection->addWebsiteFilter($_websiteList);
        }
        $this->setCollection($collection);
        if (!Mage::app()->isSingleStoreMode()) {
            $this->getCollection()->addStoreData();
        }
        return $this;
    }
}
