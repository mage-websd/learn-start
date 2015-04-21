<?php
class SM_Rsscontent_Block_List extends Mage_Rss_Block_List {

    protected $_type;
    protected $_storeId;
    protected $_cid;
    protected $_misc;

    public function __construct() {
        $cid = $this->getRequest()->getParam('cid');
        $type = $this->getRequest()->getParam('type');
        $storeId = $this->getRequest()->getParam('store_id');
        $misc = $this->getRequest()->getParam('misc');
        if ($cid) $this->_cid = $cid;
        if ($type) $this->_type = $type;
        if ($storeId) $this->_storeId = $storeId;
        if ($misc) $this->_misc = $misc;
    }

    public function getRootInfo() {
        $category = Mage::getModel('catalog/category')->load($this->_cid);

        if ($this->_type == 'misc') {
            if ($this->_misc == 'new') {
                $this->NewProductRssFeed();
            } else if ($this->_misc == 'special') {
                $this->SpecialProductRssFeed();
            } else if ($this->_misc == 'coupons') {
                $this->SalesRuleProductRssFeed();
            }
        } else if ($this->_type == 'product') {
            $this->addRssFeed('rss/catalog/category', $category->getName(),array('cid'=>$category->getId(), 'type' => 'product'), false, '');
        } else if ($this->_type == 'blog') {
            $category = Mage::getModel('wordpress/term')->load($this->_cid);
            $this->addRssFeed(Mage::helper('sm_wpaddion')->prefixUrlRss(), $category->getName(), array('cid' => $category->getId(), 'type' => 'blog'));
        } else if ($this->_type == 'shop_feeds') {
            $this->addRssFeed('rss/catalog/category', 'Shop RSS Feeds');
        } else if ($this->_type == 'blog_feeds') {
            $this->addRssFeed(Mage::helper('sm_wpaddion')->prefixUrlRss(), 'Blog RSS Feeds');
        }

        if (!empty($this->_rssFeeds)) {
            foreach ($this->_rssFeeds as $_feed) {
                $info['label'] = $_feed->getLabel();
                $info['pathXml'] = $_feed->getUrl();

                // get description about category
                $info['description'] = '';
                $des = $category->getData('description');
                $des = Mage::helper('core/string')->truncate($des, 250);

                if ($des) {
                    $info['description'] = $des;
                }
            }
        }

        return $info;
    }

    public function getFeedContent() {
        if ($this->_type == 'misc') $rssContent = $this->getMiscRss();
        if ($this->_type == 'product') $rssContent = $this->getProductRss($this->_cid, $this->_storeId);
        if ($this->_type == 'blog') $rssContent = $this->getBlogRss($this->_cid, $this->_storeId);
        if ($this->_type == 'shop_feeds') $rssContent = $this->getAllProductRss($this->_storeId);
        if ($this->_type == 'blog_feeds') $rssContent = $this->getAllBlogRss();
        return $rssContent;
    }

    public function getAllProductRss($storeId) {
        $data = array();
        $_productCollection = Mage::getModel('catalog/product')
            ->setStoreId($storeId)
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(
                'status',
                array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            )
            ->setPageSize(100)
            ->setCurPage(1);

        if ($_productCollection->getSize() > 0) {
            $iCount = 0;
            foreach ($_productCollection as $_product) {
                $iCount++;
                $data[$iCount]['name'] = $_product->getName();
                $data[$iCount]['image'] = $_product->getImageUrl();
                $data[$iCount]['short_desc'] = $_product->getData('short_description');
                $data[$iCount]['url'] = $_product->getProductUrl();
            }
        }
        return $data;
    }

    public function getAllBlogRss() {
        $data = array();
        $articles = Mage::getModel('wordpress/post')
            ->getCollection()
            ->setOrderByPostDate()
            ->setPageSize(100)
            ->setCurPage(1);

        if ($articles->getSize() > 0) {
            $iCount = 0;
            foreach ($articles as $article) {
                $featuredImage = $article->getFeaturedImage();
                $shortDesc = $article->getShortContent();
                $data[$iCount]['name'] = $article->getData('post_title');
                $data[$iCount]['url'] = $article->getPermalink();
                if ($featuredImage) $data[$iCount]['image'] = $featuredImage->getThumbnailImage();
                $data[$iCount]['short_desc'] = substr(strip_tags($article->getPostExcerpt()), 0, 130)." ...";;
                $iCount++;
            }
        }
        return $data;
    }

    public function getMiscRss() {
        if ($this->_misc == 'new') {
            return $this->getNewProductRss();
        } else if ($this->_misc == 'special') {
            return $this->getSpecialProductRss();
        } else if ($this->_misc == 'coupons') {
            return $this->getCouponsRss();
        }
    }

    public function getNewProductRss() {
        $data = array();
        $product = Mage::getModel('catalog/product');

        $todayStartOfDayDate  = Mage::app()->getLocale()->date()
            ->setTime('00:00:00')
            ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $todayEndOfDayDate  = Mage::app()->getLocale()->date()
            ->setTime('23:59:59')
            ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $products = $product->getCollection()
            ->setStoreId($this->_storeId)
            ->addStoreFilter()
            ->addAttributeToFilter('news_from_date', array('or' => array(
                0 => array('date' => true, 'to' => $todayEndOfDayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToFilter('news_to_date', array('or' => array(
                0 => array('date' => true, 'from' => $todayStartOfDayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToFilter(
                array(
                    array('attribute' => 'news_from_date', 'is' => new Zend_Db_Expr('not null')),
                    array('attribute' => 'news_to_date', 'is' => new Zend_Db_Expr('not null'))
                )
            )
            ->addAttributeToSort('news_from_date','desc')
            ->addAttributeToSelect(array('name', 'short_description', 'description', 'thumbnail'), 'inner')
            ->addAttributeToSelect(
                array(
                    'price', 'special_price', 'special_from_date', 'special_to_date',
                    'msrp_enabled', 'msrp_display_actual_price_type', 'msrp'
                ),
                'left'
            )
            ->applyFrontendPriceLimitations()
        ;

        $products->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
        if ($products->getSize() > 0) {
            $iCount = 0;
            foreach ($products as $_product) {
                $data[$iCount]['name'] = $_product->getData('name');
                $data[$iCount]['image'] = $_product->getImageUrl();
                $data[$iCount]['short_desc'] = $_product->getData('short_description');
                $data[$iCount]['url'] = $_product->getProductUrl();
                $iCount++;
            }
        }
        return $data;
    }

    public function getSpecialProductRss() {
        $data = array();
        $websiteId = Mage::app()->getStore($this->_storeId)->getWebsiteId();
        if($this->_cid == null) {
            $this->_cid = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $product = Mage::getModel('catalog/product');

        $fields = array(
            'final_price',
            'price'
        );
        $specials = $product->setStoreId($this->_storeId)->getResourceCollection()
            ->addPriceDataFieldFilter('%s < %s', $fields)
            ->addPriceData($this->_cid, $websiteId)
            ->addAttributeToSelect(
                array(
                    'name', 'short_description', 'description', 'price', 'thumbnail',
                    'special_price', 'special_to_date',
                    'msrp_enabled', 'msrp_display_actual_price_type', 'msrp'
                ),
                'left'
            )
            ->addAttributeToSort('name', 'asc')
        ;

        if ($specials->getSize() > 0) {
            $iCount = 0;
            foreach ($specials as $_product) {
                $iCount++;
                $data[$iCount]['name'] = $_product->getData('name');
                $data[$iCount]['image'] = $_product->getImageUrl();
                $data[$iCount]['short_desc'] = $_product->getData('short_description');
                $data[$iCount]['url'] = $_product->getProductUrl();
            }
        }
        return $data;
    }

    public function getCouponsRss() {
        $now = date('Y-m-d');
        $websiteId = Mage::app()->getStore($this->_storeId)->getWebsiteId();
        if($this->_cid == null) {
            $this->_cid = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $collection = Mage::getModel('salesrule/rule')->getResourceCollection();
        $collection->addWebsiteGroupDateFilter($websiteId, $this->_cid, $now)
            ->addFieldToFilter('is_rss', 1)
            ->setOrder('from_date','desc')
        ;
        $collection->load();

        if ($collection->getSize() > 0) {
            $iCount = 0;
            foreach ($collection as $_product) {
                $iCount++;
                $description = '<table><tr>'.
                    '<td style="text-decoration:none;">'.$_product->getDescription().
                    '<br/>Discount Start Date: '.$this->formatDate($_product->getFromDate(), 'medium').
                    ( $_product->getToDate() ? ('<br/>Discount End Date: '.$this->formatDate($_product->getToDate(), 'medium')):'').
                    ($_product->getCouponCode() ? '<br/> Coupon Code: '.$_product->getCouponCode().'' : '').
                    '</td>'.
                    '</tr></table>'
                ;

                $data[$iCount]['name'] = $_product->getName();
                $data[$iCount]['image'] = '';
                $data[$iCount]['short_desc'] = $description;
                $data[$iCount]['url'] = Mage::getUrl('');
            }
        }
        return $data;
    }

    public function getProductRss($cid, $storeId) {
        if ($cid > 0) {
            $category = Mage::getModel('catalog/category')->load($cid);
            if ($category && $category->getId()) {
                $layer = Mage::getSingleton('catalog/layer')->setStore($storeId);
                $_collection = $category->getCollection();
                $_collection->addAttributeToSelect('url_key')
                    ->addAttributeToSelect('name')
                    ->addAttributeToSelect('is_anchor')
                    ->addAttributeToFilter('is_active', 1)
                    ->addIdFilter($category->getChilren());

                $productCollection = Mage::getModel('catalog/product')->getCollection();
                $currentCategory = $layer->setCurrentCategory($category);
                $layer->prepareProductCollection($productCollection);
                $productCollection->addCountToCategories($_collection);
                $category->getProductCollection()->setStoreId($storeId);

                // only get 50 products latest
                $_productCollection = $currentCategory
                    ->getProductCollection()
                    ->addAttributeToSort('updated_at', 'desc')
                    ->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds())
                    ->setCurPage(1)
                    ->setPageSize(50)
                ;

                if ($_productCollection->getSize() > 0) {
                    $iCount = 0;
                    foreach ($_productCollection as $_product) {
                        $iCount++;
                        $data[$iCount]['name'] = $_product->getData('name');
                        $data[$iCount]['image'] = $_product->getImageUrl();
                        $data[$iCount]['short_desc'] = $_product->getData('short_description');
                        $data[$iCount]['url'] = $_product->getProductUrl();
                    }
                }
            }
        }
        return $data;
    }

    public function getBlogRss($cid, $storeId) {
        if ($cid > 0) {
            $articles = Mage::getModel('wordpress/post')
                ->getCollection()
                ->addCategoryIdFilter($cid)
                ->setOrderByPostDate()
                ->setCurPage(1)
                ->setPageSize(Mage::helper('sm_wpaddion/data')->getNumberRss())
                ;

            if ($articles->getSize() > 0) {
                $iCount = 0;
                foreach ($articles as $article) {
                    $featuredImage = $article->getFeaturedImage();
                    $shortDesc = $article->getShortContent();
                    $data[$iCount]['name'] = $article->getData('post_title');
                    $data[$iCount]['url'] = $article->getPermalink();
                    if ($featuredImage) $data[$iCount]['image'] = $featuredImage->getThumbnailImage();
                    $data[$iCount]['short_desc'] = substr(strip_tags($article->getPostExcerpt()), 0, 130)." ...";
                    $iCount++;
                }
            }
        }
        return $data;
    }

}