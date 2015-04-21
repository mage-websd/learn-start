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
/*change information store*/
Mage::getModel('core/config')->saveConfig('general/store_information/name','Dallas Gold & Silver Exchange');

$installer->endSetup();