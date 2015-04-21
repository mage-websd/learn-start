<?php

$installer = $this;
$installer->startSetup();

$store = Mage::getModel('core/store')->load('proteinedieet');
$config = Mage::getModel('core/config');

if(!empty($store)) {
    $config->saveConfig('advanced/modules_disable_output/Copernica_MarketingSoftware', '1', 'stores', $store->getStoreId());
}

$installer->endSetup();
