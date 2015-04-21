<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 3/17/15
 * Time: 2:09 PM
 */ 
class SM_Rewrite_Block_CatalogSearch_Layer extends Mage_CatalogSearch_Block_Layer {
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
        $categoryFilter = $this->_getCategoryFilter();
        $filterableAttributes = $this->_getFilterableAttributes();
        $attributesCode = array();
        foreach ($filterableAttributes as $attribute) {
            $attributesCode[$attribute->getFrontendLabel()] = $attribute->getAttributeCode();
        }

            $arrayOrg = array('Price', 'Gender', 'Designer', 'Metal Type', 'Metal Purity', 'Condition',);
            foreach($attributesCode as $key => $attributeCode) {
                if(!in_array($key, $arrayOrg)){
                    unset($attributesCode[$key]);
                }
            }
            return $this->_sortAttributeLabel($arrayOrg, $attributesCode, 2, $categoryFilter);
    }
}