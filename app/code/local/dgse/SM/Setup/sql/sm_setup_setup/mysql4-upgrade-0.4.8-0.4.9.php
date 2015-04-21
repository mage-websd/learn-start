<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$sValue = "972-481-3800";
$storeId = 0;
$installer->setConfigData('general/store_information/phone',$sValue,'default',$storeId);

$installer->endSetup();