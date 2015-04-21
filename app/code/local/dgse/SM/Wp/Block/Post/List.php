<?php
class SM_Wp_Block_Post_List extends Fishpig_Wordpress_Block_Post_List
{
    protected function _getPostCollection()
    {
        $collection = parent::_getPostCollection();
        $categoryAll = array();
        $categoryFilter = array('educational-guides','press');
        foreach($categoryFilter as $cate) {
            $category = Mage::getModel('wordpress/post_category')
                ->load($cate,'slug');
            if($category->getTermId()) {
                $categorySub = Mage::helper('sm_wp')->getSubCategoryIds($category->getTermId());
                $categorySub[] = $category->getTermId();
                $categoryAll[$cate] = $categorySub;
            }
        }
        if(count($categoryAll) > 0) {
            $collection = $this->_postCollection;
            $collection = $collection->joinTermTables('category');
            foreach($categoryAll as $idsCategoryFilter) {
                $collection = $collection
                    ->addFieldToFilter('terms_category.term_id', array('nin' => $idsCategoryFilter));
            }
        }
        $this->_postCollection = $collection;
        return $collection;
    }
}