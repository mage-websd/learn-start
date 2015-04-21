<?php
/**
 * Created by PhpStorm.
 * User: Hà
 * Date: 25/12/2014
 * Time: 4:26 PM
 */
class SM_ScrollingBrands_Block_Brands extends Mage_Core_Block_Template
{
    // return all brands
    public function getAllBrands()
    {
        //get current brands category
        $currentBrandsCategoryId = $this->getCurrentBrandsCategoryId();
        if(!$currentBrandsCategoryId)
        {
            return 'Brands category not found';
        }
        $currentBrandsCategory = Mage::getModel('catalog/category')
            ->load($currentBrandsCategoryId);

        $this->getAllSubCategory($currentBrandsCategory);
    }

    // get current Brands Category Id: by current Root Category and 'active' status
    public function getCurrentBrandsCategoryId()
    {
        $currentRootCategoryId = Mage::app()->getStore()->getRootCategoryId();
        if(!$currentRootCategoryId)
        {
            return null;
        }

        $subCurrentRootCategory = Mage::getModel('catalog/category')
            ->load($currentRootCategoryId)->getChildren();

        $brandsCategory = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToFilter('is_active', array('eq'=>'1'))
            ->addAttributeToFilter('url_key', array('eq'=>'animal-farming-equipment-brands'));
        if(!$brandsCategory)
        {
            return null;
        }

        foreach($brandsCategory as $item)
        {
            if($item->getIsActive())
            {
                $brandsCategoryId = (string)$item->getId();
                if(strpos($subCurrentRootCategory, $brandsCategoryId) !== false)
                {
                    return $brandsCategoryId;
                }
            }
        }
    }

    // scan all brands form current Brands Category: use recursive method to fetch all children of current Brands Category
    public function getAllSubCategory($currentBrandsCategory)
    {
        if($subCategoryIds = $currentBrandsCategory->getChildren())
        {
            $arraySubCategoryIds = explode(',', $subCategoryIds);
            foreach($arraySubCategoryIds as $subId)
            {
                $currentSub = Mage::getModel('catalog/category')->load($subId);
                $this->getAllSubCategory($currentSub);
            }
        }
        else
        {
            echo "<li><a href='".Mage::getBaseUrl().$currentBrandsCategory->getUrlPath()."'>"."<img src='".$currentBrandsCategory->getImageUrl()."' alt='".$currentBrandsCategory->getName()."' height='58'/>"."</a></li>";
        }
    }
}
