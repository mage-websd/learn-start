<?php
$installer = $this;
$installer->startSetup();

//enable bpost shipping manager extension in store proteinedieet
$store = Mage::getModel('core/store')->load("proteinedieet");
$config = new Mage_Core_Model_Config();
if($store->getStoreId()){
    $config->saveConfig("carriers/bpost/active" , "1", "stores", $store->getStoreId());
}

$installer->endSetup();