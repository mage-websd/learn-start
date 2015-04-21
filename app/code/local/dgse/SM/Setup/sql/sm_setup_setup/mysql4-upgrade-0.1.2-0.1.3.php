<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/7/14
 * Time: 11:06 AM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$Config = Mage::app()->getConfig();
$Config ->saveConfig('design/theme/template', "sm_dmmk_modify");
$Config ->saveConfig('design/theme/skin', "sm_dmmk_modify");
$Config ->saveConfig('design/theme/layout', "sm_dmmk_modify");

$installer->endSetup();