<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->run("
UPDATE `sns_menu_items`
SET `type` = '4',
    `data_type` = 'category/39'
WHERE `title` LIKE 'Loose Diamonds';
");
$installer->endSetup();