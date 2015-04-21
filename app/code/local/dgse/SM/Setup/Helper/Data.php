<?php

/**
 * Created by PhpStorm.
 * User: SnguyenPC
 * Date: 21/11/2014
 * Time: 17:01
 */
class SM_Setup_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function changeWishList($string, $stringChange = 'Wishlist')
    {
        $data = strpos($string, $stringChange) ? 'My Wish List' : $string;

        return $data;
    }

    /**
     * get list product in site - seo
     *
     * @return string
     */
    public function getAllProductSeo()
    {
        $html = '';
        $products = Mage::getResourceModel('catalog/product_collection');
        $products->addAttributeToSelect('name');
        $products->addAttributeToSelect('url_key');
        $products->addStoreFilter();
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $helper = Mage::helper('catalog/product');
        foreach ($products as $product) {
            $html .= $this->printListSeo($helper->getProductUrl($product), $product->name);
        }
        return $html;
    }

    /**
     * get all cms page in site - seo
     *
     * @param null $store
     * @return string
     * @throws Mage_Core_Exception
     */
    public function getAllCMSSeo($store=null)
    {
        $html = '';
        if(!$store) {
            $store = Mage::app()->getStore();
        }
        $baseUrl = $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $collections = Mage::getResourceModel('cms/page_collection')
            ->addStoreFilter($store)
            ->addFieldToSelect('title')
            ->addFieldToSelect('identifier');
        foreach($collections as $cms) {
            $html .= $this->printListSeo($baseUrl.$cms->getIdentifier(),$cms->getTitle());
        }
        return $html;
    }

    /**
     * get all link blog - education - seo
     *
     * @return string
     * @throws Mage_Core_Exception
     */
    public function getAllBlogSeo()
    {
        $html = '';
        /*home page*/
        $html .= $this->printListSeo(Mage::helper('wordpress')->getUrl(),Mage::helper('wordpress')->getTopLinkLabel());

        /*category page*/
        $categoriesBlog = Mage::getResourceModel('wordpress/post_category_collection')
            ->addHasObjectsFilter();
        if(count($categoriesBlog) > 0) {
            foreach($categoriesBlog as $category) {
                $html .= $this->printListSeo($category->getUrl(),$category->getData('name'));
                $children = $category->getChildrenCategories();
                if(count($children) > 0) {
                    foreach($children as $child) {
                        $html .= $this->printListSeo($child->getUrl(),$child->getData('name'));
                    }
                }
            }
        }

        /* add post page*/
        $posts = Mage::getResourceModel('wordpress/post_collection')
            ->addFieldToSelect('post_title')
            ->setFlag('include_all_post_types', true)
            ->addIsViewableFilter()
            ->setOrderByPostDate()
            ->load();
        if(count($posts) > 0) {
            foreach($posts as $post) {
                $html .= $this->printListSeo($post->getUrl(),$post->getData('post_title'));
            }
        }

        /* add page */
        $pages = Mage::getResourceModel('wordpress/page_collection')
            ->addIsViewableFilter()
            ->setOrderByPostDate()
            ->load();
        if(count($pages) > 0) {
            foreach($pages as $page) {
                $html .= $this->printListSeo($page->getUrl(),$page->getData('post_title'));
            }
        }

        /* add Education page*/
        $baseUrl = Mage::app()->getStore()->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $categoryEducationFlag = Mage::helper('sm_wp')->getFrontNameFlag();
        $categoryEducation = Mage::getResourceModel('wordpress/post_category_collection')
            ->addFieldToFilter('slug',$categoryEducationFlag)
            ->addFieldToSelect('term_id')
            ->addFieldToSelect('name')
            ->addFieldToSelect('slug');
        if(count($categoryEducation) > 0) {
            $categoryEducation = $categoryEducation->getFirstItem();
            $allChildEducation = Mage::helper('sm_wp')->getAllSubSubCategoryId($categoryEducation->getTermId());
            if(count($allChildEducation) > 0) {
                foreach ($allChildEducation as $childId) {
                    $child = Mage::getModel('wordpress/post_category')->load($childId);
                    $url = $categoryEducationFlag.'/'.$child->getSlug();
                    $html .= $this->printListSeo($baseUrl.$url,$child->getData('name'));
                    /*get all post of category*/
                    $posts = Mage::getResourceModel('wordpress/post_collection')
                        ->addCategoryIdFilter($childId)
                        ->addFieldToSelect('post_title')
                        ->setFlag('include_all_post_types', true)
                        ->addIsViewableFilter()
                        ->setOrderByPostDate()
                        ->load();
                    if(count($posts) > 0) {
                        foreach($posts as $post) {
                            $html .= $this->printListSeo($baseUrl.$url.'/'.$post->getData('permalink'),$post->getData('post_title'));
                        }
                    }
                }
            }
        }
        return $html;
    }

    /**
     * get all other link - module - seo
     *
     * @param $store
     * @return string
     * @throws Mage_Core_Exception
     */
    public function getAllOtherSeo($store)
    {
        $html = '';
        if(!$store) {
            $store = Mage::app()->getStore();
        }
        $baseUrl = $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $list = array('extras'=> 'Extras', 'press'=>'Press','contactus'=>'Contact Us');
        foreach($list as $key => $value) {
            $html .= $this->printListSeo($baseUrl.$key, $value);
        }
        return $html;
    }

    /**
     * format html seo
     *
     * @param $url
     * @param $name
     * @return string
     */
    protected function printListSeo($url, $name)
    {
        return '<li><a href="' . $url . '">' . $name . '</a></li>';
    }
} 