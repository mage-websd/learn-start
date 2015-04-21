<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$locationModel = Mage::getModel("sm_locations/locations");
$locationModel->load('Garland', "location_title")->delete();
$locationModel->load('Fort Worth', "location_title")->delete();
$installer->endSetup();