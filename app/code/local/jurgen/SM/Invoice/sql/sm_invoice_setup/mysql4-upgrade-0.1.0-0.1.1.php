<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giga
 * Date: 2/27/14
 * Time: 1:36 PM
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$stores = Mage::getModel('core/store')->getCollection();
foreach($stores as $store){
    if($store->getCode()=='regimeproteine_com_view') {
        $store_id = $store->getId();
    }
}

$entity_types = Mage::getModel('eav/entity_type')->getCollection();
foreach ($entity_types as $type) {
    if($type->getEntityTypeCode() == 'invoice') {
        $type_id =  $type->getId();
    }
}

$entity_store = Mage::getModel('eav/entity_store')->loadByEntityStore($type_id,$store_id);
$entity_store_id = $entity_store->getId();

$model = Mage::getModel('eav/entity_store');
$model->setId($entity_store_id)->delete();

$installer->endSetup();