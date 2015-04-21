<?php
/* @var $installer Mage_Core_Model_Resource_Setup
update attribute fasens of product on group General
 */
$installer = $this;
$installer->startSetup();

$entityTypeId = $installer->getEntityTypeId('catalog_product');
$attributeSetIds = Mage::getModel('eav/entity_type')->load($entityTypeId)->getAttributeSetCollection()
    ->getColumnValues('attribute_set_id'); // this is the attribute sets associated with this entity
$attributeCode = 'fasens';
$attributeId = $installer->getAttribute($entityTypeId, 'fasens', 'attribute_id');
if(count($attributeSetIds) > 0) {
    foreach ($attributeSetIds as $attributeSetId) {
        $attributeSet = Mage::getModel('eav/entity_attribute_set')->load($attributeSetId);
        $groupId = Mage::getModel('eav/entity_attribute_group')->getCollection()
            ->addFieldToFilter('attribute_set_id',$attributeSetId)
            ->addFieldToFilter('attribute_group_name','General')
            //->setOrder('attribute_group_id',ASC)
            ->getFirstItem()
            ->getId();
        $newItem = Mage::getModel('eav/entity_attribute');
        $newItem->setEntityTypeId($entityTypeId) // catalog_product eav_entity_type id
            ->setAttributeSetId($attributeSetId) // Attribute Set ID
            ->setAttributeGroupId($groupId) // Attribute Group ID
            ->setAttributeId($attributeId) // Attribute ID that need to be added manually
            ->setSortOrder(10) // Sort Order for the attribute in the tab form edit
            ->save();
    }
}

//change label Fasens in store proteinedieet
$store = Mage::getModel('core/store')->load("proteinedieet");
if($store->getStoreId()) {
    $storeId = $store->getStoreId();
    $resource = Mage::getModel('core/resource');
    $readConnection = $resource->getConnection('core_read');
    $tableEntityStore = $resource->getTableName('eav/attribute_label');

    $querySelect = "select attribute_label_id from {$tableEntityStore} where store_id = '{$storeId}' AND attribute_id = '{$attributeId}'";
    $result = $readConnection->fetchOne($querySelect);
    if(!$result) { //if exists then insert
        $readConnection->insert(
            $tableEntityStore,
            array(
                'attribute_id' => "$attributeId",
                'store_id' => "$storeId",
                'value' => 'Vanaf',
            )
        );
    }
    else { //else uipdate
        $readConnection->update(
            $tableEntityStore,
            array('value' => 'Vanaf'),
            array(
                'attribute_label_id = ?' => $result,
            )
        );
    }
}

$installer->endSetup();