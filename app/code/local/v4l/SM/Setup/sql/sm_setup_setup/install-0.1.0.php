<?php
$installer = $this;
$installer->startSetup();

$resource = Mage::getSingleton('core/resource');
$writeConnection = $resource->getConnection('core_write');
$table = $resource->getTableName('eav_attribute');

$query = "UPDATE {$table} SET `source_model`='' WHERE `attribute_code`='meta_robots' LIMIT 1";

$writeConnection->query($query);
$installer->endSetup();