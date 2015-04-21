<?php
/**
 * Tag collection model
 *
 * @category   Mage
 * @package    Mage_Tag
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class SM_Xpermission_Model_Mysql4_Tag_Collection extends Mage_Tag_Model_Mysql4_Tag_Collection {
    public function addWebsiteFilter($websiteID) {
        $_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();

        $this->getSelect()->join(
                array('store_table' => $this->getTable('tag/relation')),
                'main_table.tag_id = store_table.tag_id',
                array()
                )
                ->where('store_table.store_id in (?)', $_storeList)
                ->group('main_table.tag_id');
        return $this;
    }
}