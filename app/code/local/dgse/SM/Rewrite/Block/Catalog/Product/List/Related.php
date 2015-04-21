<?php

/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 11/12/14
 * Time: 5:36 PM
 */
class SM_Rewrite_Block_Catalog_Product_List_Related extends Mage_Catalog_Block_Product_List_Related
{
    protected function _prepareData()
    {
        $product = Mage::registry('product');
        $productId = $product->getId();

        $excludeCatids = array();
        $excludeCatids[] = Mage::getModel('catalog/category')->loadByAttribute('url_path', 'under500')->getId();
        $excludeCatids[] = Mage::getModel('catalog/category')->loadByAttribute('url_path', 'New30')->getId();

        // get category of product
        $categoryIds = $product->getCategoryIds();
        $categoryIds = array_diff($categoryIds,$excludeCatids);
        
        $this->_itemCollection = Mage::getModel('catalog/product')->getCollection()
            ->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id', null, 'left')
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(array(
                array(
                    'attribute' => 'image',
                    'neq' => 'no_selection',
                ),
                array(
                    'attribute' => 'require_img',
                    'eq' => '1',
                ),
            ))
            ->addAttributeToFilter('category_id', array('in' => $categoryIds))
            ->addAttributeToFilter(array(
                array(
                    'attribute' => 'price',
                    'gt' => 0,
                ),
            ))
            ->addStoreFilter();

        $this->_itemCollection->getSelect()->where("e.entity_id != '{$productId}'")->group('e.entity_id')->limit(12)->orderRand();

        if (Mage::helper('catalog')->isModuleEnabled('Mage_Checkout')) {
            Mage::getResourceSingleton('checkout/cart')->addExcludeProductFilter($this->_itemCollection,
                Mage::getSingleton('checkout/session')->getQuoteId()
            );
            $this->_addProductAttributesAndPrices($this->_itemCollection);
        }

        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($this->_itemCollection);

        $this->_itemCollection->load();
        foreach ($this->_itemCollection as $product) {
            $product->setDoNotUseCategoryId(true);
        }

        return $this;
    }
}
