<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 12/10/14
 * Time: 2:30 PM
 */ 
class SM_Rewrite_Model_Resource_Catalog_Category extends Mage_Catalog_Model_Resource_Category {
    public function getChildrenCategories($category)
    {
        $collection = $this->_getChildrenCategoriesBase($category);
        $collection->addAttributeToFilter('is_active', 1)
            ->addIdFilter($category->getChildren())
            ->addAttributeToSelect('name')
            ->addAttributeToSort('name','ASC')
            ->load();

        return $collection;
    }
}