<?php
/**
 * Created by PhpStorm.
 * User: GiangNT
 * Date: 10/7/14
 * Time: 11:06 AM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
/* change attribute value*/

/* watch_type change option name*/
$resource = Mage::getModel('core/resource');
$connectRead = $resource->getConnection('core_read');
$connectWrite = $resource->getConnection('core_write');

$tableAttribute = $resource->getTableName('eav/attribute');
$tableAttributeOption = $resource->getTableName('eav/attribute_option');
$tableAttributeOptionValue = $resource->getTableName('eav/attribute_option_value');

$query = "select attribute_id from {$tableAttribute} where attribute_code = 'watch_type'";
$attributeId = $connectRead->fetchOne($query); ///1088
if($attributeId) {
    $attrOptionArray = array(
        'Estate' => 'Pre-owned',
    );
    try {
        foreach ($attrOptionArray as $key => $value) {
            $query = "UPDATE {$tableAttributeOptionValue} SET value='{$value}'
          WHERE value = '{$key}' AND option_id IN
            (SELECT option_id FROM {$tableAttributeOption}
              WHERE attribute_id = '{$attributeId}')";
            $connectWrite->query($query);
        }
    }
    catch (Exception $e) {
        Mage::log($e);
    }
}

$installer->endSetup();