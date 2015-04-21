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
        ->addAttributeTofilter('name','Pre Owned Rolex')
        ->addAttributeTofilter('parent_id',$categoryWatches->getId());
    if($categoryRolex->count() == 1){
        $categoryRolex = $categoryRolex->getFirstItem()
            ->setName('Pre Owned Rolex Watches')
            ->setIsActive(1)
            ->save();
    }
    else {
        $categoryRolex = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeTofilter('name','Pre Owned Rolex Watches')
            ->addAttributeTofilter('parent_id',$categoryWatches->getId())
            ->getFirstItem();
    }
    $categoryAccess = Mage::getModel('catalog/category')->getCollection()
        ->addAttributeTofilter('name','Accessories')
        ->addAttributeTofilter('parent_id',$categoryWatches->getId());
    if($categoryAccess->count() == 0){
        $categoryAccess = Mage::getModel('catalog/category')
            ->setData(array(
                'path' => $categoryWatches->getPath(),
                'name' => 'Accessories',
                'url_key' => 'accessories',
                'is_active' => '1',
                'store_id' => Mage_Core_Model_App::ADMIN_STORE_ID,
            ))
            ->save();
    }
    else {
        $categoryAccess = $categoryAccess->getFirstItem();
    }
    $categoryOther = Mage::getModel('catalog/category')->getCollection()
        ->addAttributeTofilter('name','Other')
        ->addAttributeTofilter('parent_id',$categoryWatches->getId());
    if($categoryOther->count() == 1){
        $categoryOther = $categoryOther->getFirstItem()
            ->setName('Other Watches')
            ->setUrlKey('other-watches')
            ->setIsActive(1)
            ->save();
    }
    else {
        $categoryOther = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeTofilter('name','Other Watches')
            ->addAttributeTofilter('parent_id',$categoryWatches->getId())
            ->getFirstItem();
    }

    $categoryIdsSubWatch = $categoryWatches->getAllChildren(true);

    /*disable sub watches*/
    $categoryIdsSubWatchDisable = $categoryIdsSubWatch;
    unset($categoryIdsSubWatchDisable[array_search($categoryRolex->getId(),$categoryIdsSubWatchDisable)]);
    unset($categoryIdsSubWatchDisable[array_search($categoryOther->getId(),$categoryIdsSubWatchDisable)]);
    unset($categoryIdsSubWatchDisable[array_search($categoryAccess->getId(),$categoryIdsSubWatchDisable)]);
    unset($categoryIdsSubWatchDisable[array_search($categoryWatches->getId(),$categoryIdsSubWatchDisable)]);
    if(count($categoryIdsSubWatchDisable) > 0) {
        foreach($categoryIdsSubWatchDisable as $cateId) {
            Mage::getModel('catalog/category')->load($cateId)->setIsActive(0)->save();
        }
    }

    unset($categoryIdsSubWatch[array_search($categoryRolex->getId(),$categoryIdsSubWatch)]);/*except rolex sub*/
    /*add product other watch*/
    $collectionProducts = Mage::getResourceModel('catalog/product_collection')
        ->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id=entity_id', null, 'left')
        ->addAttributeToFilter('category_id', array('in' => $categoryIdsSubWatch));
    $select = clone $collectionProducts->getSelect();
    $select->reset(Zend_Db_Select::COLUMNS)->columns('e.entity_id')->group('e.entity_id');
    $productIds = $collectionProducts->getConnection()->fetchAll($select);
    if(count($productIds)) {
        $arrayPostedProducts = array();
        foreach($productIds as $productId) {
            $arrayPostedProducts[$productId['entity_id']] = 1;
        }
    }
    $categoryOther->setData('posted_products',$arrayPostedProducts)->save();


    $menuRolex = Mage::getModel('megamenu/menuitems')->getCollection()
        ->addFieldToFilter('title','Pre Owned Rolex')
        ->addFieldToFilter('depth','3')
        ->addFieldToFilter('rgt','49')
        ->addFieldToFilter('lft','48');
    if($menuRolex->count() == 1) {
        $menuRolex->getFirstItem()
            ->setTitle('Pre Owned Rolex Watches')
            ->save();
    }
    $menuOther = Mage::getModel('megamenu/menuitems')->getCollection()
        ->addFieldToFilter('title','Other')
        ->addFieldToFilter('depth','3')
        ->addFieldToFilter('rgt','49')
        ->addFieldToFilter('lft','48');
    if($menuOther->count() == 1) {
        $menuOther->getFirstItem()
            ->setTitle('Other Watches')
            ->save();
    }
}

$installer->endSetup();