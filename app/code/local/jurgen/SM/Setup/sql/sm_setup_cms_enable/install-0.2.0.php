<?php
/**
 * @var $installer Mage_Core_Model_Resource_Setup
 * add store for cms/page
 */
$installer = $this;
$installer->startSetup();

// new store Proteinedieet
$store = Mage::getModel('core/store')->load('proteinedieet');
if($store->getStoreId()) {
    $storeId = $store->getStoreId();
    $cmsIds = Mage::getModel('cms/page')->getCollection()
        ->addFieldToSelect('page_id')
        ->addFieldToFilter('identifier',
            array('in'=>array(
                            'eiwitdieet',
                            'reacties',
                            'transportkost',
                            'betaalwijzen',
                        )))
        ->getColumnValues('page_id');
    if(count($cmsIds) > 0) {
        foreach($cmsIds as $cmsId) {
            $cms = Mage::getModel('cms/page')->load($cmsId);
            $storeIdArray = $cms->getStoreId(); //Store current of cms/page
            if(!in_array($storeId, $storeIdArray)) {
                $storeIdArray[] = $store->getStoreId();
            }
            $cms->setData('store_id',$storeIdArray);
            $cms->save();
        }
    }
}

$installer->endSetup();
