<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 6/9/14
 * Time: 8:44 AM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;


$installer->startSetup();
$result = $installer->getConnection()->raw_fetchRow("SHOW COLUMNS from {$this->getTable('locations')} like '%location_page%'");
if(!is_array($result) || !in_array('location_page', $result)){
    $installer->run("
    ALTER TABLE  `{$this->getTable('locations')}`
        ADD  `location_page` VARCHAR( 255 ) NULL AFTER  `location_title`
    ");
}

$installer->endSetup();