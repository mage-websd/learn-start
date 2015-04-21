<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$attributeId = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', 'locations')->getId();

$installer->startSetup();
$installer->run("
UPDATE eav_attribute SET
entity_type_id = '10',
attribute_model = NULL,
backend_model = 'eav/entity_attribute_backend_array',
backend_type = 'varchar',
backend_table = NULL,
frontend_model = NULL,
frontend_input = 'multiselect',
frontend_class = NULL
WHERE attribute_id = '$attributeId' ;

INSERT INTO catalog_product_entity_varchar ( entity_type_id, attribute_id, store_id, entity_id, value)
SELECT entity_type_id, attribute_id, store_id, entity_id, value
FROM catalog_product_entity_int
WHERE attribute_id = $attributeId
");
$installer->endSetup();