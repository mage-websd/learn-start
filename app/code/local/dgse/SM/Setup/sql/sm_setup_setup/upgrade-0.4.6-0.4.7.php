<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/7/14
 * Time: 11:06 AM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
/* change attribute value*/

$resource = Mage::getModel('core/resource');
$connectWrite = $resource->getConnection('core_write');
$table = $resource->getTableName('core/config_data');

//update allow special country
$query="UPDATE {$table} SET value = '1' WHERE path LIKE '%carriers%sallowspecific%'";
$result = $connectWrite->query($query);

////update special country US and CA
$country = "US,CA";
$query ="UPDATE {$table} SET value='{$country}' WHERE path LIKE '%carriers%specificcountry%'";
$result = $connectWrite->query($query);

// update special country US and CA for general
$query ="UPDATE {$table} SET value='{$country}' WHERE path = 'general/country/allow'";
$result = $connectWrite->query($query);

$installer->endSetup();