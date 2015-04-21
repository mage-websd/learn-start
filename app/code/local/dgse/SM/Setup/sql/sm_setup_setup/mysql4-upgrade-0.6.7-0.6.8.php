<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

Mage::register('isSecureArea', 1);
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
    if(count($categoryRolex) == 0){
        $categoryRolex = Mage::getModel('catalog/category')
            ->setData(array(
                'path' => $categoryWatches->getPath(),
                'name' => 'Pre Owned Rolex',
                'url_key' => 'pre-owned-rolex',
                'is_active' => '1',
                'store_id' => Mage_Core_Model_App::ADMIN_STORE_ID,
            ))
            ->save();
    }
    else {
        $categoryRolex = $categoryRolex->getFirstItem();
    }

    $categoryOther = Mage::getModel('catalog/category')->getCollection()
        ->addAttributeTofilter('name','Other')
        ->addAttributeTofilter('parent_id',$categoryWatches->getId());
    if(count($categoryOther) == 0){
        $categoryOther = Mage::getModel('catalog/category')
            ->setData(array(
                'path' => $categoryWatches->getPath(),
                'name' => 'Other',
                'url_key' => 'watch-other',
                'is_active' => '1',
                'store_id' => Mage_Core_Model_App::ADMIN_STORE_ID,
            ))
            ->save();
    }
    else {
        $categoryOther = $categoryOther->getFirstItem();
    }
    $categoryIdsSubWatch = $categoryWatches->getAllChildren(true);
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


    Mage::getModel('megamenu/menuitems')
        ->load(507)->setStatus(1)->save();
    Mage::getModel('megamenu/menuitems')
        ->load(508)->setStatus(1)->save();
    Mage::getModel('megamenu/menuitems')
        ->load(509)->setStatus(2)->save();
    Mage::getModel('megamenu/menuitems')
        ->load(510)->setStatus(2)->save();
    Mage::getModel('megamenu/menuitems')
        ->load(511)->setStatus(2)->save();
    Mage::getModel('megamenu/menuitems')
        ->load(512)->setStatus(2)->save();
    $menuRolex = Mage::getModel('megamenu/menuitems')->getCollection()
        ->addFieldToFilter('title','Pre Owned Rolex')
        ->addFieldToFilter('depth','3')
        ->addFieldToFilter('rgt','49')
        ->addFieldToFilter('lft','48');
    if(count($menuRolex) == 0) {
        $menu = Mage::getModel('megamenu/menuitems')
            ->setData(array(
                'title' => 'Pre Owned Rolex',
                'show_title' => 1,
                'status' => 1,
                'align' => 1,
                'show_as_group' => 1,
                'parent_id' => '507',
                'depth' => 3,
                'group_id'=> 6,
                'cols_nb' => 12,
                'target' => 3,
                'type' => 4,
                'data_type' => 'category/'.$categoryRolex->getId(),
                'rgt' => '49',
                'lft' => '48',
            ))
            ->save();
    }

    $menuOther = Mage::getModel('megamenu/menuitems')->getCollection()
        ->addFieldToFilter('title','Other')
        ->addFieldToFilter('depth','3')
        ->addFieldToFilter('rgt','49')
        ->addFieldToFilter('lft','48');
    if(count($menuOther) == 0) {
        $menuOther = Mage::getModel('megamenu/menuitems')
            ->setData(array(
                'title' => 'Other',
                'show_title' => 1,
                'status' => 1,
                'align' => 1,
                'show_as_group' => 1,
                'parent_id' => '507',
                'depth' => 3,
                'group_id'=> 6,
                'cols_nb' => 12,
                'target' => 3,
                'type' => 4,
                'data_type' => 'category/'.$categoryOther->getId(),
                'rgt' => '49',
                'lft' => '48',
            ))
            ->save();
    }
}

$installer->endSetup();