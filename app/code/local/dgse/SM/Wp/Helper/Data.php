<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 15/03/2015
 * Time: 11:49
 */ 
class SM_Wp_Helper_Data extends Mage_Core_Helper_Abstract {
    protected $_allSubId = array();

    /**
     * get all sub category of category $id
     *
     * @param $id
     * @return array
     */
    public function getAllSubCategoryId($id)
    {
        $arrayChild = array();
        if($id) {
            $categorySub = Mage::getModel('wordpress/post_category')
                ->getCollection()
                ->addFieldtoFilter('parent',$id);
            if(count($categorySub) > 0) {
                $arrayChild = $categorySub->getColumnValues('term_id');
            }
        }
        return $arrayChild;
    }

    /**
     * get all sub sub category by id
     *
     * @param $id
     * @return array
     */
    public function getAllSubSubCategoryId($id)
    {
        $this->_allSubId = array();
        $this->_getAllSubSubCategoryId($id);
        return $this->_allSubId;
    }
    /**
     * get all sub sub category of id $id
     *
     * @param $id
     * @return null
     */
    protected function _getAllSubSubCategoryId($id)
    {
        if($id) {
            $subIds = $this->getSubCategoryIds($id);
            if($subIds) {
                $this->_allSubId = array_merge($this->_allSubId, $subIds);
                foreach($subIds as $subId) {
                    $this->_getAllSubSubCategoryId($subId);
                }
            }
            else {
                return null;
            }
        }
    }
    public function getSubCategoryIds($id)
    {
        $categorySub = Mage::getResourceModel('wordpress/post_category_collection')
            ->addParentIdFilter($id);
        if(count($categorySub) > 0) {
            return $categorySub->getColumnValues('term_id');
        }
        return null;
    }

    public function getUrlCategoryFlag($category)
    {
        $url = $category->getSlug();
        $parentId = $category->getParentId();
        while($parentId > 0) {
            $categoryParent = Mage::getModel('wordpress/post_category')->load($parentId);
            $url = $categoryParent->getSlug() . '/'.$url;
            $parentId = $categoryParent->getParentId();
        }
        return Mage::app()->getStore(Mage::app()->getStore()->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).$url;
    }

    public function getUrlCategoryConvertFlag($url)
    {
        $arrayUrl = explode('/',$url);
        $urlLast = $arrayUrl[count($arrayUrl)-2];
        $category = Mage::getModel('wordpress/post_category')->load($urlLast,'slug');
        if($category->getTermId()) {
            return $this->getUrlCategoryFlag($category);
        }
        return null;
    }

    public function getUrlPostFlag($post)
    {
        $url = trim($post->getData('permalink'),'/');
        if($categoryCurrent = Mage::registry('wordpress_category')) {
            return $this->getUrlCategoryFlag($categoryCurrent) . '/' .$url;
        }
        return Mage::app()->getStore(Mage::app()->getStore()->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).$url;
    }

    public function getFrontNameFlag()
    {
        return 'educational-guides';
    }
}