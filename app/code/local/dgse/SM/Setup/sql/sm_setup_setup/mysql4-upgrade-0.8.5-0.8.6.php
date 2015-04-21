<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$config = Mage::app()->getConfig();
$config ->saveConfig('catalog/search/search_type', "2");
$installer->endSetup();