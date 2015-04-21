<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

//enable menu top in store proteinedieet
$store = Mage::getModel('core/store')->load("proteinedieet");
$config = new Mage_Core_Model_Config();
if($store->getStoreId()){
    $config->saveConfig("custom_menu/general/enabled" , "1", "stores", $store->getStoreId());
}

$installer->endSetup();