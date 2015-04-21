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
$result = $installer->getConnection()->raw_fetchRow("SHOW COLUMNS from {$this->getTable('locations')} like '%telephone%'");
if(!is_array($result) || !in_array('telephone', $result)){
    $installer->run("
    ALTER TABLE  `{$this->getTable('locations')}`
        ADD  `telephone` VARCHAR( 255 ) AFTER  `location_page`
    ");
}

$installer->endSetup();