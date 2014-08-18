<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->removeAttribute('catalog_product','featured');

$installer->addAttribute('catalog_product', 'featured',  array(
    'type'     => 'int',
    'label'    => 'Featured',
    'input'    => 'checkbox',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => false,
    'group'             => 'General',
));

$installer->endSetup();