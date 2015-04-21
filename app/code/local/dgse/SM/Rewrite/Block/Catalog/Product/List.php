<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DucThang
 * Date: 12/12/14
 * Time: 2:31 PM
 */

class SM_Rewrite_Block_Catalog_Product_List extends SM_RequireImage_Block_Catalog_Product_List
{
    /**
    * Number get number inventory
    *
    */
    protected $_numberInventory = 30;

    /**
    * Funtion get newest 30 items
    *
    */
    protected function _getProductNews(){
        $_productNews = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributetoSelect('*')
            ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
            ->addAttributeToFilter('visibility', array('neq' => 1))
            ->addAttributeToFilter('status', 1)
            ->addAttributeToSort('entity_id', 'desc')
            ->addAttributeToFilter('qty', array("gt" => 0))
            ->setPageSize($this->_numberInventory)
            ->addAttributeToFilter(array(
                array(
                    'attribute' => 'image',
                    'neq'       => 'no_selection',
                ),
                array(
                    'attribute' => 'require_img',
                    'eq'       => '1',
                ),
            ))
            ->addAttributeToFilter('price',array('gt' => 0));
        $data = array();
        if(count($_productNews) > 0){
            foreach($_productNews as $_productNew){
                $data[] = $_productNew->getEntityId();
            }
        }
        return $data;
    }

    /**
     *  update category for newest 30 items
     *
     */
    protected function _setProductCategory()
    {
        $categoryId = (int) Mage::app()->getRequest()->getParam('id');
        $entityNews = $this->_getProductNews();
        $productNews = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributetoSelect('*')
            ->addAttributeToFilter('visibility', array('neq' => 1))
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('entity_id',array('in' => $entityNews))
            ->addAttributeToFilter(array(
                array(
                    'attribute' => 'image',
                    'neq'       => 'no_selection',
                ),
                array(
                    'attribute' => 'require_img',
                    'eq'       => '1',
                ),
            ))
            ->addAttributeToFilter('price',array('gt' => 0));

        // get old items in category 30 newest items
        $productOlds = Mage::getModel('catalog/category')->load($categoryId)->getProductCollection();

        /*
         *  if this category has no item, the following code will update 30 newest items for this category.
         *  else get all old items in this category, unset them from this category, then update 30 newest items for this category.
         */
        if( count($productOlds) == 0 ) {
            foreach($productNews as $products) {
                $categoryIdNews = $products->getCategoryIds();
                $categoryIdNews[] = $categoryId;
                $products->setCategoryIds(array($categoryIdNews));
                $products->save();
                unset($categoryIdNews);
            }
        } else {
            $entityOlds = array();
            foreach($productOlds as $entities) {
                $entityOlds[] = $entities->getId();
            }
            if( count(array_diff($entityNews, $entityOlds)) != 0 ) {
                // unset old items from category new30.
                foreach($productOlds as $products) {
                    $categoryIdOlds = $products->getCategoryIds();
                    if (($key = array_search($categoryId, $categoryIdOlds)) !== false) {
                        unset($categoryIdOlds[$key]);
                    }
                    $products->setCategoryIds(array($categoryIdOlds));
                    $products->save();
                    unset($categoryIdOlds);
                }
                // set new items for category new30.
                foreach($productNews as $news) {
                    $categoryIdNews = $news->getCategoryIds();
                    $categoryIdNews[] = $categoryId;
                    $news->setCategoryIds(array($categoryIdNews));
                    $news->save();
                    unset($categoryIdNews);
                }
            }
        }
    }

    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            // Set items for newest 30 items category
            $categoryPath = Mage::registry('current_category');
            if($categoryPath){
                $url = $categoryPath->getUrlKey();
                if($url == 'New30') {
                    $this->_setProductCategory();
                }
            }
            $layer = $this->getLayer();
            /* @var $layer Mage_Catalog_Model_Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId(Mage::app()->getStore()->getRootCategoryId());
            }

            // if this is a product view page
            if (Mage::registry('product')) {
                // get collection of categories this product is associated with
                $categories = Mage::registry('product')->getCategoryCollection()
                    ->setPage(1, 1)
                    ->load();
                // if the product is associated with any category
                if ($categories->count()) {
                    // show products from this category
                    $this->setCategoryId(current($categories->getIterator()));
                }
            }

            $origCategory = null;
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                    $this->addModelTags($category);
                }
            }
            $this->_productCollection = $layer->getProductCollection();
            $this->_productCollection->joinField('rating_summary', 'review_entity_summary', 'rating_summary', 'entity_pk_value=entity_id', array('entity_type'=>1, 'store_id'=> Mage::app()->getStore()->getId()), 'left');

            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            }
        }

        return $this->_productCollection;
    }
}