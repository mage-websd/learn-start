<?php

class SM_ImportData_DeleteController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $storeCode = 'proteinedieet';
        $storeId = Mage::app()->getStore($storeCode)->getStoreId();

        $storeRoot = Mage::app()->getStore($storeId)->getRootCategoryId();
        $categories = Mage::getModel('catalog/category')
            ->getCollection()//->addFieldToFilter('entity_id', array('eq' => 633));
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('path', array(array("like"=>"%/$storeRoot/%"), array("like"=>"1/$storeRoot")));

        $productModel = Mage::getModel('catalog/product');

        $deletedCategories = 0;
        foreach($categories as $category){
            $products = $productModel->getCollection()->addCategoryFilter($category);

            $deletedProducts = 0;
            $removedProducts = 0;
            foreach ($products as $product) {
                $productCategories = $product->getCategoryIds();
                $productWebsites = $product->getWebsiteIds();

                if(count($productWebsites) <= 1 || count($productCategories) <= 1) {
                    $product->delete();
                    $deletedProducts++;
                } else {
                    $catKey = array_search($category->getId(), $productCategories);
                    if($catKey !== FALSE) {
                        unset($productCategories[$catKey]);
                    }

                    $webKey = array_search($storeId, $productWebsites);
                    if($webKey !== FALSE) {
                        unset($productWebsites[$webKey]);
                    }

                    $product->setWebsiteIDs($productWebsites);
                    $product->setCategoryIDs($productCategories);
                    $product->save();
                    $removedProducts++;
                }
            }

            if ($category->getId() != $storeRoot){
                $category->delete();
                $deletedCategories++;
            }

        }

        Mage::getModel('sm_importdata/flag')->clearAll();
        echo "Process is done!<br/>
              - Deleted categories: $deletedCategories<br/>
              - Deleted products: $deletedProducts<br/>
              - Product removed from destination store: $removedProducts";
    }

    public function testAction() {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $storeCode = 'proteinedieet';
        $storeId = Mage::app()->getStore($storeCode)->getStoreId();

        $products = Mage::getModel('catalog/product')->getCollection();
        foreach ($products as $product) {
            $productWebsites = $product->getWebsiteIds();

            $webKey = array_search($storeId, $productWebsites);
            if($webKey !== FALSE) {
                unset($productWebsites[$webKey]);
            }

            $product->setWebsiteIds($productWebsites);
            $product->save();


        }
    }
}