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
$installer->run("
    Create table `sm_pickupcheckout_orderlocation`(
      `id` int(11) not null auto_increment,
      `order_id` int(11) not null,
      `location_id` int(11) not null,
      primary key (id)
    ) ENGINE = InnoBD default charset=utf8;
");
$installer->endSetup();