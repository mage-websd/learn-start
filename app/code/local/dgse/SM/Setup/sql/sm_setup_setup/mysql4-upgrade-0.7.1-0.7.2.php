<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

if(!Mage::registry('isSecureArea')) {
    Mage::register('isSecureArea', 1);
}
Mage::app()->setUpdateMode(false);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

/*add category other in watch*/
$categoryWatches = Mage::getModel('catalog/category')->getCollection()
    ->addAttributeToFilter('name','Watches')
    ->addAttributeToFilter('level','2')
    ->getFirstItem();
if($categoryWatches->getId()) {
    $categoryRolex = Mage::getModel('catalog/category')->getCollection()
        ->addAttributeTofilter('name','Pre Owned Rolex Watches')
        ->addAttributeTofilter('parent_id',$categoryWatches->getId());
    if($categoryRolex->count() == 1){
        $categoryRolex = $categoryRolex->getFirstItem()
            ->setName('Pre-owned Rolex Watches')
            ->setIsActive(1)
            ->save();
    }
    $menuRolex = Mage::getModel('megamenu/menuitems')->getCollection()
        ->addFieldToFilter('title','Pre Owned Rolex Watches')
        ->addFieldToFilter('depth','3')
        ->addFieldToFilter('rgt','49')
        ->addFieldToFilter('lft','48');
    if($menuRolex->count() == 1) {
        $menuRolex->getFirstItem()
            ->setTitle('Pre-owned Rolex Watches')
            ->save();
    }
}

$installer->endSetup();