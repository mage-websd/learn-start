<?php
$installer = $this;
$installer->startSetup();

$content = 'BLOCK CONTENT HERE';
//if you want one block for each store view, get the store collection
//$stores = Mage::getModel('core/store')->getCollection()->addFieldToFilter('store_id', array('gt'=>0))->getAllIds();
//if you want one general block for all the store viwes, uncomment the line below
$stores = array(0);
foreach ($stores as $store){

    // create sale condition block
    $block = Mage::getModel('cms/block');
    $block->setTitle('Sales Conditions');
    $block->setIdentifier('sale_condition');
    $block->setStores(array($store));
    $block->setIsActive(1);
    $block->setContent($content);
    $block->save();

    // create shipping & return block
    $block = Mage::getModel('cms/block');
    $block->setTitle('Shipping & Returns');
    $block->setIdentifier('shipping_return');
    $block->setStores(array($store));
    $block->setIsActive(1);
    $block->setContent($content);
    $block->save();

}

$installer->endSetup();
