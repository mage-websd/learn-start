<?php
/**
 * Created by PhpStorm.
 * User: Ms TRANG
 * Date: 9/10/14
 * Time: 11:05 AM
 */ 
/* @var  Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    UPDATE `shipping_premiumrate` SET `price_to_value` = '10000000.0000' WHERE `delivery_type` = 'AusPost Express';
    UPDATE `shipping_premiumrate` SET `price_to_value` = '10000000.0000' WHERE `delivery_type` = 'Courier';
");

$installer->endSetup();