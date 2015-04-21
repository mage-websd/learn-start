<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$switch = new Mage_Core_Model_Config();
$switch ->saveConfig('cataloginventory/item_options/min_sale_qty', "1", 'default', 0);
$installer->endSetup();