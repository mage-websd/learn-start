<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$switch = new Mage_Core_Model_Config();
$switch ->saveConfig('customer/startup/redirect_dashboard', "1", 'default', 0);
$installer->endSetup();