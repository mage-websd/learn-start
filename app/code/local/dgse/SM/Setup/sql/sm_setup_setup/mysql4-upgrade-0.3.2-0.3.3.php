<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$switch = new Mage_Core_Model_Config();
$switch ->saveConfig('design/footer/copyright', "DGSE Companies, Inc. All Rights Reserved.", 'default', 0);
$installer->endSetup();