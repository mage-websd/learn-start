<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 9/8/14
 * Time: 3:23 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$store = Mage::getModel('core/store')->getCollection()->addFieldToFilter("code", "proteinedieet")->getFirstItem();
$_config = new Mage_core_model_config();
if($store->getStoreId()){
    $_config->saveconfig("design/theme/template" ,"proteinenet", "stores", $store->getStoreId());
    $_config->saveconfig("design/theme/skin" ,"proteinenet", "stores", $store->getStoreId());
    $_config->saveconfig("design/theme/layout" ,"proteinenet", "stores", $store->getStoreId());
    $_config->saveconfig("design/theme/default" ,"proteinenet", "stores", $store->getStoreId());
}

$installer->endSetup();