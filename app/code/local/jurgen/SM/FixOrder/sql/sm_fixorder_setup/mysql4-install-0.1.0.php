<?php
/**
 * Created by PhpStorm.
 * User: Safio
 * Date: 16/09/2014
 * Time: 13:53
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup
        config id increment for order, shipping, invoice, creditmemo of store proteinedieet
 */

$installer = $this;
$installer->startSetup();

$store = Mage::getModel('core/store')->load("proteinedieet");
if($store->getStoreId()) {
    $storeId = $store->getStoreId();
    $orderIncrementIdMax = 3100100; //id default increment

    //get id eav_entity_type
    $idsEntity = Mage::getModel('eav/entity_type')->getCollection()
        ->addFieldToSelect('entity_type_id')
        ->addFieldToFilter('entity_type_code',array(in=>array('order','invoice','shipment','creditmemo')))
        ->getColumnValues('entity_type_id');
    if(count($idsEntity)>0){
        $resource = Mage::getModel('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $tableEntityStore =$resource->getTableName('eav/entity_store');
        $query = "select max(increment_last_id) as idMax from $tableEntityStore where store_id='$storeId'";
        $results = $readConnection->fetchOne($query);

        //id_increment assign order, invoice, shipment, creditmemo
        $idMax = $results ? ($results+10) : $orderIncrementIdMax;

        foreach($idsEntity as $idEntity) {
            $query = "select entity_store_id from $tableEntityStore where store_id='$storeId'
                        and entity_type_id='$idEntity'";
            $results = $readConnection->fetchOne($query);

            if(!$results) { //if code not exist then insert
                $readConnection->insert(
                    $tableEntityStore,
                    array(
                        'entity_type_id' => $idEntity,
                        'store_id' => $storeId,
                        'increment_prefix' => $storeId,
                        'increment_last_id' => $idMax,
                    )
                );
            }
            else { //if code exist then update
                $readConnection->update(
                    $tableEntityStore,
                    array('increment_last_id' => $idMax),
                    array(
                        'entity_store_id = ?' => $results,
                    )
                );
            }
        }
    }
}
$installer->endSetup();