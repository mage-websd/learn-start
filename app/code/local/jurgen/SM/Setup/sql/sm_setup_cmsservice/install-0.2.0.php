<?php
/**
* Created by PhpStorm.
* User: BuiManhHa
* Date: 9/25/14
* Time: 10:46 AM
*
* @var $installer Mage_Core_Model_Resource_Setup
* set store view of 'Contact us' page for new store Proteinedieet
*/
$installer = $this;
$installer->startSetup();

// new store Proteinedieet
$newStore = Mage::getModel('core/store')->load('proteinedieet');
$dieetShopStore = Mage::getModel('core/store')->load('proteinedieet_nl');

if(($idNewStore = $newStore->getStoreId()) && ($idDieetShopStore = $dieetShopStore->getStoreId()))
{
	$idCms = Mage::getModel('cms/page')->getCollection()
        ->addFieldToSelect('page_id')
        ->addStoreFilter($idDieetShopStore)
        ->addFieldToFilter('identifier', array('eq'=>'service'))
        ->getColumnValues('page_id');
	if(count($idCms) > 0)
    {
		// add id new store for cms page 'Contact us'
		Mage::getModel('cms/page')->load($idCms[0])
			->setStoreId(array($idNewStore, $idDieetShopStore))
			->save();
	}
}
$installer->endSetup();