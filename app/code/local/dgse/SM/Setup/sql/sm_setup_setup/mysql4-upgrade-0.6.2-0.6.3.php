<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
INSERT INTO `eav_attribute_option` VALUES(NULL, 1041, 999);
INSERT INTO `eav_attribute_option_value` VALUES(NULL, LAST_INSERT_ID(), 0, 'Other');
");

$installer->endSetup();