<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
//enable filter for attribute
$installer->updateAttribute(
    'catalog_product',
    'clarity_id',
    'is_filterable',
    '1'
);
$installer->updateAttribute(
    'catalog_product',
    'certificate_authority',
    'is_filterable',
    '1'
);
$installer->endSetup();