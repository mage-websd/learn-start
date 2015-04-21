<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->run("
UPDATE `sns_menu_items`
SET `data_type` = 'http://dgse.imiqa.com/repair'
WHERE `title` LIKE 'Repair';
");
$installer->endSetup();