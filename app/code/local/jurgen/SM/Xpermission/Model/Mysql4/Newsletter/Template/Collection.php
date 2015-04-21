<?php
/**
 * Templates collection
 *
 * @category   Mage
 * @package    Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Newsletter_Template_Collection extends Mage_Newsletter_Model_Mysql4_Template_Collection {
    public function addWebsiteFilter($websiteID) {
        $this->getSelect()->join(
                array('website_table' => Mage::getSingleton('core/resource')->getTableName('xpermission/newsletter_template_website')),
                'newsletter_template.template_id = website_table.template_id',
                array()
                )
                ->where('website_table.website_id in (?)', $websiteID)
                ->group('website_table.template_id');
        return $this;
    }
}