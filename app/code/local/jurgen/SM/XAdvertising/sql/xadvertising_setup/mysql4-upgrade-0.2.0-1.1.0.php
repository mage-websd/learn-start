<?php
$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('sm_xadvertising')}
	CHANGE COLUMN `content` `adv_content` TEXT  CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL;
");

$installer->endSetup(); 

