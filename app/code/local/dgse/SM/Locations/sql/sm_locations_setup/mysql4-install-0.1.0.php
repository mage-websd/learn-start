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
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('locations')};
CREATE TABLE {$this->getTable('locations')} (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `location_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `location_content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
");

$installer->endSetup();