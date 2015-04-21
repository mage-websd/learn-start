<?php

class SM_Wp_Block_Education_Menu extends Fishpig_Wordpress_Block_Sidebar_Widget_Categories
{
    /**
     * _construct()
     *
     * redirect if category educational load
     */
    public function _construct()
    {
        $categoryCurrent = Mage::registry('wordpress_category');
        if($categoryCurrent) {
            $categoryId = Mage::getModel('wordpress/post_category')
                ->load('educational-guides', 'slug')->getTermId();
            if($categoryId && $categoryId == $categoryCurrent->getId()) {
                $url = Mage::getBaseUrl().'educational-guides';
                Mage::app()->getResponse()->setRedirect($url)->sendResponse();
            }
        }
    }
    /**
     * getCategories(): get all category menu
     *
     * @return mixed
     */
    public function getCategories()
    {
        if(Mage::registry('wordpress_category_educational')) {
            $this->setTemplate('wp/education/left_bar.phtml');
            return $this->getCategoriesEducation();
        }
        $categoryCurrent = Mage::registry('wordpress_category');
        $post = Mage::registry('wordpress_post');
        $categoryFilter = array('educational-guides', 'press');
        $categoryAll = array();
        $collection = Mage::getResourceModel('wordpress/post_category_collection');
        foreach ($categoryFilter as $cate) {
            $category = Mage::getModel('wordpress/post_category')
                ->load($cate, 'slug');
            if ($category->getTermId()) {
                $categorySub = Mage::helper('sm_wp')->getAllSubCategoryId($category->getTermId());
                $categoryAll[$category->getTermId()] = $categorySub;
            }
        }

        if ($categoryCurrent) {
            $categoryCurrentId = $categoryCurrent->getId();
            if (count($categoryAll) > 0) {
                foreach ($categoryAll as $idCategoryParent => $idsCategory) {
                    if (in_array($categoryCurrentId, $idsCategory) || $categoryCurrentId == $idCategoryParent) {
                        if ($idsCategory) {
                            $collection->addFieldToFilter('main_table.term_id', array('in' => $idsCategory));
                        }
                    } else {
                        $collection
                            ->addFieldToFilter('main_table.term_id', array('neq' => $idCategoryParent));
                        if ($idsCategory) {
                            $collection->addFieldToFilter('main_table.term_id', array('nin' => $idsCategory));
                        }
                    }
                }
            }
        } else if (in_array('wordpress_homepage', Mage::app()->getLayout()->getUpdate()->getHandles())) {
            if (count($categoryAll) > 0) {
                foreach ($categoryAll as $idCategoryParent => $idsCategory) {
                    $collection->addFieldToFilter('main_table.term_id', array('neq' => $idCategoryParent));
                    if ($idsCategory) {
                        $collection = $collection->addFieldToFilter('main_table.term_id', array('nin' => $idsCategory));
                    }
                }
            }
        }
        else if($post) {
            $categoryPost = $post->getCategoryIds();
            if(count($categoryPost) > 0) {
                if (count($categoryAll) > 0) {
                    foreach ($categoryAll as $idCategoryParent => $idsCategory) {
                        if (in_array($idCategoryParent, $categoryPost) || (count(array_intersect($categoryPost,$idsCategory))>0) ) {
                            if ($idsCategory) {
                                $collection->addFieldToFilter('main_table.term_id', array('in' => $idsCategory));
                            }
                        } else {
                            $collection
                                ->addFieldToFilter('main_table.term_id', array('neq' => $idCategoryParent));
                            if ($idsCategory) {
                                $collection->addFieldToFilter('main_table.term_id', array('nin' => $idsCategory));
                            }
                        }
                    }
                }
            }
        }

        $collection->addHasObjectsFilter();
        $this->setCategories($collection);
        return $this->_getData('categories');
    }

    /**
     * get all category sub of educational
     *
     * @return mixed|null
     */
    public function getCategoriesEducation()
    {
        $collection = Mage::getResourceModel('wordpress/post_category_collection');
        $category = Mage::getModel('wordpress/post_category')
            ->load(Mage::helper('sm_wp')->getFrontNameFlag(), 'slug');
        if ($category->getTermId()) {
            $categorySub = Mage::helper('sm_wp')->getSubCategoryIds($category->getTermId());
            if (count($categorySub) > 0) {
                $collection->addFieldToFilter('main_table.term_id', array('in' => $categorySub));
            }
            else {
                return null;
            }
        }
        else {
            return null;
        }
        $collection->addHasObjectsFilter();
        $this->setCategories($collection);
        return $this->_getData('categories');
    }

    protected function _beforeToHtml()
    {
        if(Mage::registry('wordpress_category_educational')) {
            $this->setTemplate('wp/education/left_bar.phtml');
        }
        return parent::_beforeToHtml();
    }
}
