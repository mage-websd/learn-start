<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$attributeModel = Mage::getModel('eav/entity_attribute');
$attributeModel->loadByCode('catalog_product', 'manufacturer')->setData('is_comparable', 0)->save();
$attributeModel->loadByCode('catalog_product', 'color')->setData('is_comparable', 0)->save();
$attributeModel->loadByCode('catalog_product', 'grade')->setData('is_comparable', 0)->save();
$attributeModel->loadByCode('catalog_product', 'grading_service')->setData('is_comparable', 0)->save();
$attributeModel->loadByCode('catalog_product', 'certificate_authority ')->setData('is_comparable', 1)->save();
$installer->endSetup();