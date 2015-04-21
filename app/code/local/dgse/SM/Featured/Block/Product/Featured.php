<?php

class SM_Featured_Block_Product_Featured extends Mage_Catalog_Block_Product_List
{
    public function getSubCategory($category_id)
    {
        $idList = "";
        $categories = '';
        $layer = Mage::getSingleton('catalog/layer');
        $category = Mage::getModel('catalog/category')->load($category_id);
        $categories = $category->getChildren();
        if ($categories) {
            $idList = $categories;
            $list = explode(",", $categories);
            foreach ($list as $ccid) {
                $cat = Mage::getModel('catalog/category')->load($ccid);
                if ($cat->getChildren()) $idList .= "," . $cat->getChildren();
            }
            $idList .= "," . $category_id;
        } else {
            $idList = $category_id;
        }
        return $idList;
    }

    public function getFeaturedProduct()
    {
        $storeId = Mage::app()->getStore()->getId();
        $ccontroller = Mage::app()->getFrontController()->getRequest()->getControllerName();
        $categoryId = $this->getRequest()->getParam('id', false);
        if ($ccontroller == "product") {
            $productId = $this->getRequest()->getParam('id', false);
            $cproduct = Mage::getModel('catalog/product')->load($productId);
            $categoryArr = $cproduct->getCategoryIds();
            $current_product = Mage::registry('current_product');
            if ($current_product) {
                $category_product = $current_product->getCategoryIds();
                $categoryId = $category_product[0];

            } else {
                $categoryId = "";
            }

            /*Setting the bundle flag here*/
            if ($cproduct->getTypeId() == 'bundle') {
                $bundleFlag = 1;
                $bundleCategoryId = $categoryArr[0];
            }
        }
        $resource = Mage::getSingleton('core/resource');
        $product = Mage::getModel('catalog/product');
        $currentCategory = Mage::getModel('catalog/category')->load($categoryId);
        $isTopCat = 0;
        $categoryLevel = $currentCategory->getLevel();
        if ($categoryLevel == 2) $isTopCat = 1;
//        $csubcats = $currentCategory->getChildren();
//        if (!empty($csubcats)) {
        $subcats = 0;
        if ($categoryLevel >= 2) {
            $pathArr = explode("/", $currentCategory->getPath());
            $subcats = $categoryId; //$this->getSubCategory($categoryId);
        }
        $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('catalog_read');
        $categoryProductTable = $resource->getTableName('catalog/category_product');
        $productEntityIntTable = (string)Mage::getConfig()->getTablePrefix() . 'catalog_product_entity_int';
        $eavAttributeTable = $resource->getTableName('eav/attribute');
        if (empty($subcats)) $subcats = '0';
        //checking for Bundle Product flag here
        if ($bundleFlag == 1) {
            $subcats = $bundleCategoryId;
        }
        $select = $read->select()
            ->from(array('cp' => $categoryProductTable))
            ->join(array('pei' => $productEntityIntTable), 'pei.entity_id=cp.product_id', array())
            ->joinNatural(array('ea' => $eavAttributeTable))
            ->where('cp.category_id IN (' . $subcats . ')')
            ->where('pei.value=1')
            ->where('ea.attribute_code="is_featured"')
            ->limit(5);
        $featuredProductData = $read->fetchAll($select);
        $i = 0;
        $product = array();
        $productid = array();
        foreach ($featuredProductData as $row) {
            $productid[$i] = $row['product_id'];
            $i++;
        }
        $productid = array_unique($productid);
        $i = 0;
        $prodObj = '';
        foreach ($productid as $id) {
            if ($id != '') {
                $prodObj = Mage::getModel('catalog/product')->load($id);
                if ($prodObj->getVisibility() == 4 && $prodObj->isSaleable() == 1) {
                    $product[$i] = $prodObj;
                    $i++;
                }
            }
        }
//        } else {
//            $product = '';
//        }
        return $product;
    }

    function getListFeatured($categoryId)
    {
        $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('catalog_read');
        $categoryProductTable = $resource->getTableName('catalog/category_product');
        $productEntityIntTable = (string)Mage::getConfig()->getTablePrefix() . 'catalog_product_entity_int';
        $eavAttributeTable = $resource->getTableName('eav/attribute');
        if ($categoryId) {
            $select = $read->select()
                ->from(array('cp' => $categoryProductTable))
                ->join(array('pei' => $productEntityIntTable), 'pei.entity_id=cp.product_id', array())
                ->joinNatural(array('ea' => $eavAttributeTable))
                ->where('cp.category_id IN (' . $categoryId . ')')
                ->where('pei.value=1')
                ->where('ea.attribute_code="is_featured"');
        } else {
            $select = $read->select()
                ->from(array('cp' => $categoryProductTable))
                ->join(array('pei' => $productEntityIntTable), 'pei.entity_id=cp.product_id', array())
                ->joinNatural(array('ea' => $eavAttributeTable))
                ->where('pei.value=1')
                ->where('ea.attribute_code="is_featured"');
        }

        $featuredProductData = $read->fetchAll($select);
        $i = 0;
        $product = array();
        $productid = array();
        foreach ($featuredProductData as $row) {
            $productid[$i] = $row['product_id'];
            $i++;
        }
        $productid = array_unique($productid);
        $i = 0;
        $prodObj = '';
        foreach ($productid as $id) {
            if ($id != '') {
                $prodObj = Mage::getModel('catalog/product')->load($id);
                if ($prodObj->getVisibility() == 4 && $prodObj->isSaleable() == 1) {
                    $product[$i] = $prodObj;
                    $i++;
                }
            }
        }
        return $product;
    }

    /**
     *
     *  get product featured
     *
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $categoryId = Mage::app()->getRequest()->getParam('id');
            $attributes = Mage::getSingleton('catalog/config')
                ->getProductAttributes();
            $collection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect($attributes)
                ->addAttributeToFilter('is_featured', 1)
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('visibility', array('neq' => 1))
                ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                ->joinField('rating_summary', 'review_entity_summary', 'rating_summary', 'entity_pk_value=entity_id', array('entity_type'=>1, 'store_id'=> Mage::app()->getStore()->getId()), 'left')
                ->addAttributeToFilter('qty', array("gt" => 0))
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
                ->addAttributeToFilter('price',array('gt' => 0))
                ->addStoreFilter();
            if ($categoryId != null) {
                $category = Mage::getModel('catalog/category')->load($categoryId);
                $categoryIds = $this->getChildrenCategoryIdsWithInactive($category);
                $categoryIds[] = $categoryId;
                $collection->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id', null, 'left')->addAttributeToFilter('category_id', array('in' => $categoryIds));
            }
            $collection->getSelect()->group('e.entity_id');
            $this->_productCollection = $collection;
        }
        return $this->_productCollection;
    }

    protected function getChildrenCategoryIdsWithInactive($category)
    {
        $result = array();
        $inactiveChildren = $category->getChildrenCategoriesWithInactive()->addFieldToFilter(array(
            array('attribute' => 'is_active', 'eq' => '0')
        ));
        foreach($inactiveChildren as $inactiveChild) {
            $result[] = $inactiveChild->getId();
        }

        $childrenIds = $category->getResource()->getChildren($category, true);
        foreach($childrenIds as $childId) {
            $result[] = $childId;
            $inactiveChildren = Mage::getModel('catalog/category')
                    ->load($childId)
                    ->getChildrenCategoriesWithInactive()->addFieldToFilter(array(
                    array('attribute' => 'is_active', 'eq' => '0')
                ))
                    ;
            foreach($inactiveChildren as $inactiveChild) {
                $result[] = $inactiveChild->getId();
            }
        }
        return $result;
    }
}