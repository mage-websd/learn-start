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
    UPDATE `shipping_premiumrate` SET `weight_to_value` = '10.0000',`price_from_value` = '400.0000' WHERE `delivery_type` = 'Free Shipping';
");

$installer->endSetup();