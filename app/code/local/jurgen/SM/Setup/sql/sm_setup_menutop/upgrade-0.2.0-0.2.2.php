<?php
/* @var $installer Mage_Core_Model_Resource_Setup
        enable mega menu for ie
 */

$installer = $this;
$installer->startSetup();

$store = Mage::getModel('core/store')->load("proteinedieet");
if($store->getStoreId()){
    $config = new Mage_Core_Model_Config();
    $config->saveConfig("custom_menu/general/ie6_ignore" , "0", "stores", $store->getStoreId());
}

$installer->endSetup();