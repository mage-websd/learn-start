<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 2/2/15
 * Time: 4:34 PM
 */
class SM_Rewrite_Block_Catalog_Layer_View extends Mage_Catalog_Block_Layer_View {

    /*
     * _sortAttributeLabel(): sort attribute follow label of array
     *
     * @param
     *  $arrayOrg: array sort follow
     *  $arrayData: array data to sort
     *  $categoryPosition: position category filter
     *  $categoryFilter: block category filter
     * @return: array code
     *
     * */
    protected function _sortAttributeLabel($arrayOrg, $arrayData, $categoryPosition=null,$categoryFilter=null)
    {
        $result = array();
        $position = 1;
        $checkCategory = false;
        foreach($arrayOrg as $label) {
            if(array_key_exists($label,$arrayData)) {
                $result[] = $this->getChild($arrayData[$label].'_filter');
                $position++;
                unset($arrayData[$label]);
                if($position === $categoryPosition && $categoryFilter) {
                    $result[] = $categoryFilter;
                    $checkCategory = true;
                }
            }
        }
        foreach($arrayData as $code) {
            $result[] = $this->getChild($code.'_filter');
            $position++;
            if($position === $categoryPosition && $categoryFilter) {
                $result[] = $categoryFilter;
                $checkCategory = true;
            }
        }
        if(!$categoryPosition && $categoryFilter && !$checkCategory) {
            $result[] = $categoryFilter;
        }
        return $result;
    }

    /*
     * getFilters(): get filters of list product
     *      function core
     * */
    public function getFilters()
    {
        $categoryCurrent = Mage::registry('current_category');
        $categoryFilter = $this->_getCategoryFilter();
        $filterableAttributes = $this->_getFilterableAttributes();
        $attributesCode = array();
        foreach ($filterableAttributes as $attribute) {
            $attributesCode[$attribute->getFrontendLabel()] = $attribute->getAttributeCode();
        }
        unset($attributesCode['Condition']);

        if ($categoryCurrent) {
            $arrayOrg = array();
            //region [DGSE-582] Finalize "REFINE SEARCH BY" Block
            //region Define categories
            $limitedRefineCats = array('Jewelry', 'Gifts Under $500', 'Newest 30 Items');
            $jewelryChildren = Mage::getModel('catalog/category')->getCollection()
                ->addAttributeToFilter('name', 'Jewelry')
                ->addAttributeToFilter('level', '2')
                ->getFirstItem()
                ->getChildren();
            $jewelryChildren = (explode(',', $jewelryChildren));

            $diamondCategory = Mage::getModel('catalog/category')->getCollection()
                ->addAttributeToFilter('name', 'Diamonds')
                ->addAttributeToFilter('level', '3')
                ->getFirstItem();
            $diamondChildren = $diamondCategory->getAllChildren();
            $diamondCategories = (explode(',', $diamondChildren));
            $diamondCategories[] = $diamondCategory->getId();

            $watchCategory = Mage::getModel('catalog/category')->getCollection()
                ->addAttributeToFilter('name', 'Watches')
                ->addAttributeToFilter('level', '3')
                ->getFirstItem();
            $watchChildren = $watchCategory->getAllChildren();
            $watchCategories = (explode(',', $watchChildren));
            $watchCategories[] = $watchCategory->getId();

            $rarecoinCategory = Mage::getModel('catalog/category')->getCollection()
                ->addAttributeToFilter('name', 'Rare coins')
                ->addAttributeToFilter('level', '2')
                ->getFirstItem();
            $rarecoinChildren = $rarecoinCategory->getAllChildren();
            $rarecoinCategories = (explode(',', $rarecoinChildren));
            $rarecoinCategories[] = $rarecoinCategory->getId();
            //endregion

            // 1. Jewelry, Under 500, New 30 have limited refinement options
            //and sort by 'Designer', 'Metal Type', 'Metal Purity', 'Gender'
            if(in_array($categoryCurrent->getName(), $limitedRefineCats) && $categoryCurrent->getLevel() == 2) {
                $arrayOrg = array('Gender', 'Designer', 'Metal Type', 'Metal Purity');
                $arrayLimit = array('Price', 'Designer', 'Metal Type', 'Metal Purity', 'Gender');
                foreach($attributesCode as $key => $attributeCode) {
                    if (!in_array($key, $arrayLimit)) {
                        unset($attributesCode[$key]);
                    }
                }
            }

            // 2. Jewelry subcategories have above refinement order, but not limit their own options
            elseif(in_array($categoryCurrent->getId(), $jewelryChildren)
                && !in_array($categoryCurrent->getId(), $diamondCategories)
                && !in_array($categoryCurrent->getId(), $watchCategories)){
                $arrayOrg = array('Category','Gender', 'Designer', 'Metal Type', 'Metal Purity');
            }

            // 5. Jewelry subcategories have above refinement order, but not limit their own options
            elseif(in_array($categoryCurrent->getId(), $watchCategories)) {
                $arrayOrg = array('Brand', 'Gender', 'Designer', 'Metal Type', 'Metal Purity');
            }

            elseif(in_array($categoryCurrent->getId(), $rarecoinCategories)) {
                $arrayOrg = array('Metal Type', 'Metal Purity');
		unset($attributesCode['Category']);
            }

            // 3. The top two refinement options on all categories need to always be: Price and Category.
            array_unshift($arrayOrg, 'Price');
            $resultFilters = $this->_sortAttributeLabel($arrayOrg, $attributesCode, 2, $categoryFilter);

            // 4. The last refinement option on all categories (except for Diamonds or Rare Coins) needs to be: Condition.
            if(!in_array($categoryCurrent->getId(), $diamondCategories)
            && !in_array($categoryCurrent->getId(), $rarecoinCategories)) {
                if($this->getChild('condition_filter')) {
                    $resultFilters[] = $this->getChild('condition_filter');
                }
            }


            return $resultFilters;
            //endregion
        }

    }
}
