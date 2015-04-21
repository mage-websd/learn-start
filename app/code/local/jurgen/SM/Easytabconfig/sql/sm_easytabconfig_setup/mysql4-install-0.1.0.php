<?php
/**
 * Created by PhpStorm.
 * User: BuiManhHa
 * Date: 9/11/14
 * Time: 11:34 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup
   enable easytab config on product detail page for store Proteinedieet
 */
$installer = $this;
$installer->startSetup();

$store = Mage::getModel('core/store')->load("proteinedieet");
if($store)
{
    $storeId = $store->getStoreId();
    if($storeId)
    {
        $_config = new Mage_Core_Model_Config();
        $_config->saveConfig('easy_tabs/general/enabled', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/descriptiontabbed', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/upsellproductstabbed', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/additionaltabbed', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/relatedtabbed', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/tagstabbed', "1", 'stores', $storeId);
        $_config->saveConfig('easy_tabs/general/reviewtabbed', "1", 'stores', $storeId);
    }
    $installer->endSetup();
}