<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 9/8/14
 * Time: 3:23 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();


//#addWebsite
/** @var $website Mage_Core_Model_Website */
$website = Mage::getModel('core/website')->getCollection()->addFieldToFilter("code", "proteinedieet_web")->getFirstItem();
if(!$website->getWebsiteId()){
    $website = Mage::getModel('core/website');
    $website->setCode('proteinedieet_web')
        ->setName('Proteinedieet.net')
        ->save();
}

//Add root category for store
$nameCategoryRoot = 'Proteinedieet.net Root Category';
$categoryRoot = Mage::getModel('catalog/category');
$categoryRoot->setData('name',$nameCategoryRoot);
$categoryRoot->setData('is_active',1);
$categoryRoot->setData('include_in_menu',1);
$categoryRoot->setPath('1');
$categoryRoot->save();

//#addStoreGroup
/** @var $storeGroup Mage_Core_Model_Store_Group */
$storeGroup = Mage::getModel('core/store_group');
$storeGroup->setWebsiteId($website->getId())
    ->setName('Proteinedieet.net')
    ->setRootCategoryId($categoryRoot->getId())
    ->save();
//#addStore
/** @var $store Mage_Core_Model_Store */

$store = Mage::getModel('core/store')->getCollection()->addFieldToFilter("code", "proteinedieet")->getFirstItem();
if(!$store->getStoreId()){
    $store = Mage::getModel('core/store');
    $store->setCode('proteinedieet')
        ->setWebsiteId($storeGroup->getWebsiteId())
        ->setGroupId($storeGroup->getId())
        ->setName('Proteinedieet.net')
        ->setIsActive(1)
        ->save();
}

$installer->endSetup();