<?php
/**
 * setup block
 */
/* @var  Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$table = $installer->getTable('premiumrate_shipping/premiumrate');
$installer->run("
    UPDATE $table SET `price`='19.5' WHERE `delivery_type`='Over 10kg'
");

$installer->endSetup();