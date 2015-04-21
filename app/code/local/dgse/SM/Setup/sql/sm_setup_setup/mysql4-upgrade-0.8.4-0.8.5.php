<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$config = Mage::app()->getConfig();
$config ->saveConfig('design/email/logo', "default/logo.png");
$installer->endSetup();