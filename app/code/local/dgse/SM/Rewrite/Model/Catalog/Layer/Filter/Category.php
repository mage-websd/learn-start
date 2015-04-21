<?php

/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 12/10/14
 * Time: 1:54 PM
 */
class SM_Rewrite_Model_Catalog_Layer_Filter_Category extends Mage_Catalog_Model_Layer_Filter_Category
{
    protected function _getItemsData()
    {
        $key = $this->getLayer()->getStateKey() . '_SUBCATEGORIES';
        $data = $this->getLayer()->getAggregator()->getCacheData($key);
        $imageFilter = array(
            array(
                'attribute' => 'image',
                'neq'       => 'no_selection',
            ),
            array(
                'attribute' => 'require_img',
                'eq'       => '1',
            ),
        );

        $flagSortPosition = false;
        if ($data === null) {
            $categoty = $this->getCategory();
            /** @var $categoty Mage_Catalog_Model_Categeory */
            $categories = $categoty->getChildrenCategories();

            $this->getLayer()->getProductCollection()->addAttributeToFilter($imageFilter)
                ->addCountToCategories($categories);

            $data = array();
            $cat_fine_jewelry = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToFilter('name', 'Fine Jewelry')
                ->getFirstItem();
            foreach ($categories as $category) {
                if ($category->getId() == $cat_fine_jewelry->getId()) {
                    $categories_child = Mage::getModel('catalog/category')->load($category->getId())->getChildrenCategories();
                    $categories_child = $categories_child->addAttributeToSelect('name')
                        ->addAttributeToSort('name','ASC');
                    foreach ($categories_child as $child) {
                        if ($child->getIsActive() && $child->getProductCount()) {
                            $data[] = array(
                                'label' => Mage::helper('core')->escapeHtml($child->getName()),
                                'value' => $child->getId(),
                                'count' => $child->getProductCount(),
                            );
                        }
                    }
                    $flagSortPosition = false;
                } else {
                    if ($category->getIsActive() && $category->getProductCount()) {
                        if ($category->getName() == "Wedding Jewelry") {
                            $data[] = array(
                                'label' => "Wedding Jewelry",
                                'value' => $category->getId(),
                                'count' => $category->getProductCount(),
                            );
                            $flagSortPosition = false;
                        } else {
                            $data[] = array(
                                'label' => Mage::helper('core')->escapeHtml($category->getName()),
                                'value' => $category->getId(),
                                'count' => $category->getProductCount(),
                                'position' => $category->getPosition(),
                            );
                            $flagSortPosition = true;
                        }
                    }
                }

            }
            if($flagSortPosition) {
                $data = $this->_sortCategoryDataPosition($data);
            }
            $tags = $this->getLayer()->getStateTags();
            $this->getLayer()->getAggregator()->saveCacheData($data, $key, $tags);
        }
        return $data;
    }

    /**
     * Sort array by position
     *
     * @param $data
     * @return array|null
     */
    protected function _sortCategoryDataPosition($data)
    {
        if(!is_array($data) || !$data || !count($data)) {
            return $data;
        }
        $result = array();
        foreach($data as $category) {
            $position = $category['position'];
            $result[$position] = $category;
        }
        ksort($result);
        return $result;
    }
}