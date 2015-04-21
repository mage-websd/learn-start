<?php
/* @var $installer Mage_Core_Model_Resource_Setup 
		Add link for special catalog in menu
*/
$installer = $this;
$installer->startSetup();

//enable menu top in store proteinedieet
$store = Mage::getModel('core/store')->load("proteinedieet");
if($store->getStoreId()){
	$config = new Mage_Core_Model_Config();
    $config->saveConfig("custom_menu/speciallinks/newproduct" , "{{base_url}}catalognew/", "stores", $store->getStoreId());
    $config->saveConfig("custom_menu/speciallinks/promotionproduct" , "{{base_url}}catalogsale/", "stores", $store->getStoreId());
    $config->saveConfig("custom_menu/speciallinks/bestseller" , "{{base_url}}catalognew/bestseller/", "stores", $store->getStoreId());
}
$installer->endSetup();