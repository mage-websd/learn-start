<?php
class SM_XFeaturedProduct_Block_FeaturedProduct extends Mage_Catalog_Block_Product_List
{
    protected function _getProductCollection()
    {
    	
        if (is_null($this->_productCollection)) {
            $collection = Mage::getResourceModel('catalog/product_collection');
            Mage::getModel('catalog/layer')->prepareProductCollection($collection);
// your custom filter
            $collection->addAttributeToFilter('featured', 1)
                ->addStoreFilter();

            $this->_productCollection = $collection;
        }
        return $this->_productCollection;
    }
	
    
}
