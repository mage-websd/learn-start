<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->updateAttribute('catalog_product', 'description', 'frontend_class', 'validate-length maximum-length-750');
$installer->endSetup();