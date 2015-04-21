<?php
/**
 * Adminhtml newsletter problem grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Newsletter_Problem_Grid extends Mage_Adminhtml_Block_Newsletter_Problem_Grid {
    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('newsletter/problem_collection')
                ->addSubscriberInfo()
                ->addQueueInfo();

        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            //filter by website
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $collection->addWebsiteFilter($_websiteList);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
}
