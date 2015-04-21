<?php

class SM_ImportData_ImportController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $originalStoreCode = 'pro10_view';
        $destinationStoreCode = 'proteinedieet';
        $originalStoreId = Mage::app()->getStore($originalStoreCode)->getStoreId();
        $destinationStoreId = Mage::app()->getStore($destinationStoreCode)->getStoreId();

        //Get basic information
        $originalRoot = Mage::app()->getStore($originalStoreId)->getRootCategoryId();
        $destinationRoot = Mage::app()->getStore($destinationStoreId)->getRootCategoryId();

        //Get imported categories from last time
        $flag = Mage::getModel('sm_importdata/flag');
        $importedCategories = $flag->setType(1)->getImported();

        //Get categories to import
        $originalCategories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('entity_id', array('nin' => $importedCategories))
            ->addAttributeToFilter('path', array(array("like"=>"%/$originalRoot/%"), array("like"=>"1/$originalRoot")))
            ->addAttributeToSort('level')
            ->addAttributeToSort('position');

        //Get list of imported categories which has relative between Original categories and Destination categories
        $comparisonList = $flag->getComparisonList();
        if (empty($comparisonList)) {
            $comparisonList = array($originalRoot => $destinationRoot);
        }

        $numberImportedCategories = 0;
        $numberImportedProducts = 0;
        foreach($originalCategories as $originalCategory){
            $originalCategoryId = $originalCategory->getId();
            $originalCategory = Mage::getSingleton('catalog/category')->setStoreId($originalStoreId)->load($originalCategoryId);

            //place flag to remember it is being imported
            $flag->setOriginal($originalCategoryId)->setType(1)->saveFlag();

            if($originalCategoryId == $originalRoot) {
                //if the current category is root, then it is assumed imported
                //update flag to remember it is imported
                $flag->loadFlag($originalCategoryId, 1, 'original_id')->setDestination($destinationRoot)->saveFlag();
            } else {
                //if the current category is not root, create new category with original category's information
                //but new parent and path
                $newCategory = clone $originalCategory;
                $path = $newCategory->getPath();
                $mainParent = $newCategory->getParentCategory();
                $parents = explode('/', $path);
                array_pop($parents);
                foreach ($parents as $key => $parent) {
                    if (array_key_exists($parent, $comparisonList)) {
                        $parents[$key] = $comparisonList[$parent];
                        if ($parent = $mainParent) {
                            $newCategory->setParentCategory($comparisonList[$parent]);
                        }
                    }
                }
                $newPath = implode('/', $parents);
                $newCategory->setId(null)
                    ->setPath($newPath)
                    ->save();
                $newCategoryId = Mage::getResourceModel('catalog/category_collection')->addAttributeToSort('entity_id', 'DESC')->setPage(1,1)->getFirstItem()->getId();
                $comparisonList += array($originalCategoryId => $newCategoryId);

                //update flag to remember it is imported
                $flag->loadFlag($originalCategoryId, 1, 'original_id')->setDestination($newCategoryId)->saveFlag();
                $numberImportedCategories++;
                }
        }

        $flag->setComparisonList($comparisonList);
        $importedProducts = $flag->setType(2)->getImported();
        $products = Mage::getSingleton('catalog/product')
            ->getCollection()->addFieldToFilter('entity_id', array('nin' => $importedProducts));

        foreach ($products as $product) {
            $productId = $product->getId();
            $product = Mage::getModel('catalog/product')->setStoreId($originalStoreId)->load($productId);
            $flag->setOriginal($productId)->setType(2)->saveFlag();

            //get current product websites and categories
            $productCategories = $product->getCategoryIds();
            $productWebsites = $product->getWebsiteIds();

            foreach ($productCategories as $originalProductCategory) {
                $productCategory = $flag->setOriginal($originalProductCategory)->getDestinationCategory();
                //add newly imported category to category list of current product
                if(!in_array($productCategory, $productCategories) && $productCategory) {
                    $productCategories[] = $productCategory;
                }
            }

            //add destination store to website list of current product
            if(!in_array($destinationStoreId, $productWebsites) && in_array($originalStoreId, $productWebsites)) {
                $productWebsites[] = $destinationStoreId;
            }

            if($productCategories != $product->getCategoryIds() || $productWebsites != $product->getWebsiteIds()) {
                $product->setWebsiteIDs($productWebsites)
                    ->setCategoryIDs($productCategories)
                    ->setStoreId($destinationStoreId)
                    ->save();
            }
            //update flag to remember it is imported
            $flag->loadFlag($productId, 2, 'original_id')->setDestination($productId)->saveFlag();
            $numberImportedProducts++;
        }

        $flag->clearAll();
        echo "Process is done!<br/>
              - Imported categories: $numberImportedCategories<br/>
              - Imported products: $numberImportedProducts<br/>";
    }
}