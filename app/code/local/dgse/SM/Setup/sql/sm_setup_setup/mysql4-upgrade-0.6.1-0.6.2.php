<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
UPDATE `eav_attribute_option_value` SET `value` = 'Lady''s' WHERE `option_id` =35;
UPDATE `eav_attribute_option_value` SET `value` = 'Men''s' WHERE `option_id` =36;
");

$installer->endSetup();