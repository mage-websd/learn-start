<?php
$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('sm_xadvertising')}
	ADD `orders` TINYINT( 11 ) NOT NULL DEFAULT 1 AFTER `status` ;
");

$installer->endSetup(); 
