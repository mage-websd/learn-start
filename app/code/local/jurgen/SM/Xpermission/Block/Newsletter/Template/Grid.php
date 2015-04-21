<?php
/**
 * Adminhtml newsletter templates grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Newsletter_Template_Grid extends Mage_Adminhtml_Block_Newsletter_Template_Grid {
    protected function _prepareCollection() {
        $collection = Mage::getResourceSingleton('newsletter/template_collection')
                ->useOnlyActual();
        if (!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
}

