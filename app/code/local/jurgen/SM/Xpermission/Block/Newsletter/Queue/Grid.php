<?php
/**
 * Adminhtml newsletter queue grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Newsletter_Queue_Grid extends Mage_Adminhtml_Block_Newsletter_Queue_Grid {
    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('newsletter/queue_collection')
                ->addTemplateInfo()
                ->addSubscribersInfo();
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            //filter by website
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $collection->addWebsiteFilter($_websiteList);
        }
        $this->setCollection($collection);
        return $this;
    }
}

