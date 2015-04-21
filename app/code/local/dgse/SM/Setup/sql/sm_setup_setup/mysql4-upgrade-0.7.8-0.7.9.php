<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->run("
UPDATE `sns_menu_items`
SET `type` = '4',
    `data_type` = 'category/81'
WHERE `title` LIKE 'Watches' AND `type` = '2';
");
$installer->endSetup();