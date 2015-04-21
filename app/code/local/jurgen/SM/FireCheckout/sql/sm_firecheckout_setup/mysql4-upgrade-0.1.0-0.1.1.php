<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giga
 * Date: 3/3/14
 * Time: 5:55 PM
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$config = new Mage_Core_Model_Config();
$config->saveConfig('firecheckout/general/enabled', 1, 'default', 0);

$installer->endSetup();