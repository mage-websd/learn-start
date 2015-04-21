<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->run("
UPDATE `sns_menu_items`
SET `title` = 'Repair',
    `type` = '2',
    `data_type` = 'http://dgse.imiqa.com/index.php/repair'
WHERE `title` LIKE 'Collectibles';

UPDATE `sns_menu_items`
SET `status` = '2'
WHERE `data_type` LIKE 'http://dgse.imiqa.com/watches' AND `depth` = '2';
");
$installer->endSetup();