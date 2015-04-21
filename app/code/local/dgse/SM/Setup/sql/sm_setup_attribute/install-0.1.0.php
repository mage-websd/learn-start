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
/* change attribute value*/

/* clarity_id change option postion*/
$resource = Mage::getModel('core/resource');
$connectRead = $resource->getConnection('core_read');
$connectWrite = $resource->getConnection('core_write');

$tableAttribute = $resource->getTableName('eav/attribute');
$tableAttributeOption = $resource->getTableName('eav/attribute_option');
$tableAttributeOptionValue = $resource->getTableName('eav/attribute_option_value');

$query = "select attribute_id from {$tableAttribute} where attribute_code = 'clarity_id'";
$attributeId = $connectRead->fetchOne($query);
if($attributeId) {
    $attrOptionArray = array(
        'FL','IF','VVS1','VVS2','VS1','VS2','SI1','SI2','I1','I2','I3',
    );
    try {
        foreach ($attrOptionArray as $key => $value) {
            $query = "UPDATE {$tableAttributeOption} SET sort_order='{$key}'
          WHERE attribute_id='{$attributeId}' AND option_id IN
            (SELECT option_id FROM {$tableAttributeOptionValue}
              WHERE value='{$value}')";
            $connectWrite->query($query);
        }
    }
    catch (Exception $e) {
        Mage::log($e);
    }
}

/* change sort name */
$installer->updateAttribute(
    'catalog_product',
    'name',
    'used_for_sort_by',
    '0'
);

$installer->endSetup();