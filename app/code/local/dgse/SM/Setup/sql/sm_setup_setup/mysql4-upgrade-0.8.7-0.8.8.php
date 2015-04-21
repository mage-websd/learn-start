<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$attributeId = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', 'locations')->getId();

$installer->startSetup();
$installer->run("
DELETE
FROM catalog_product_entity_int
WHERE attribute_id = $attributeId
");
$installer->endSetup();