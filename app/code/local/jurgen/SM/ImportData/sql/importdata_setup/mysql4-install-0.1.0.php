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
    DROP TABLE IF EXISTS `{$installer->getTable('sm_importdata/flag')}`;
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('sm_importdata/flag')}` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `original_id` int(11) NOT NULL,
      `destination_id` int(11) NOT NULL,
      `type` int(1) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
");

$installer->endSetup();