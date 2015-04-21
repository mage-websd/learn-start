<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
UPDATE `sns_menu_items`
SET `type` = '2',
    `data_type` = 'http://dgse.imiqa.com/jewelry/diamonds'
WHERE `title` LIKE 'Loose Diamonds';
UPDATE `sns_menu_items`
SET `type` = '2',
    `data_type` = 'http://dgse.imiqa.com/jewelry/watches'
WHERE `title` LIKE 'Watches' AND `custom_class` = '';
");
$installer->endSetup();