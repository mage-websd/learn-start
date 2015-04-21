<?php

/**
 * Class SM_Rewrite_Model_Sitemap
 *  rewrite general sitemap
 *      + learning page + check before foreach
 */
class SM_Rewrite_Model_Sitemap extends Mage_Sitemap_Model_Sitemap
{
    public function generateXml()
    {
        $io = new Varien_Io_File();
        $io->setAllowCreateFolders(true);
        $io->open(array('path' => $this->getPath()));

        if ($io->fileExists($this->getSitemapFilename()) && !$io->isWriteable($this->getSitemapFilename())) {
            Mage::throwException(Mage::helper('sitemap')->__('File "%s" cannot be saved. Please, make sure the directory "%s" is writeable by web server.', $this->getSitemapFilename(), $this->getPath()));
        }

        $io->streamOpen($this->getSitemapFilename());

        $io->streamWrite('<?xml version="1.0" encoding="UTF-8"?>' . "\n");
        $io->streamWrite('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

        $storeId = $this->getStoreId();
        $date    = Mage::getSingleton('core/date')->gmtDate('Y-m-d');
        $baseUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);

        /**
         * Generate categories sitemap
         */
        $changefreq = (string)Mage::getStoreConfig('sitemap/category/changefreq', $storeId);
        $priority   = (string)Mage::getStoreConfig('sitemap/category/priority', $storeId);
        $collection = Mage::getResourceModel('sitemap/catalog_category')->getCollection($storeId);
        $categories = new Varien_Object();
        $categories->setItems($collection);
        Mage::dispatchEvent('sitemap_categories_generating_before', array(
            'collection' => $categories
        ));
        if(count($categories->getItems()) > 0) {
            foreach ($categories->getItems() as $item) {
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($baseUrl . $item->getUrl()),
                    $date,
                    $changefreq,
                    $priority
                );
                $io->streamWrite($xml);
            }
        }
        unset($collection);

        /**
         * Generate products sitemap
         */
        $changefreq = (string)Mage::getStoreConfig('sitemap/product/changefreq', $storeId);
        $priority   = (string)Mage::getStoreConfig('sitemap/product/priority', $storeId);
        $collection = Mage::getResourceModel('sitemap/catalog_product')->getCollection($storeId);
        $products = new Varien_Object();
        $products->setItems($collection);
        Mage::dispatchEvent('sitemap_products_generating_before', array(
            'collection' => $products
        ));
        if(count($products->getItems()) > 0) {
            foreach ($products->getItems() as $item) {
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($baseUrl . $item->getUrl()),
                    $date,
                    $changefreq,
                    $priority
                );
                $io->streamWrite($xml);
            }
        }
        unset($collection);

        /**
         * Generate cms pages sitemap
         */
        $changefreq = (string)Mage::getStoreConfig('sitemap/page/changefreq', $storeId);
        $priority   = (string)Mage::getStoreConfig('sitemap/page/priority', $storeId);
        $collection = Mage::getResourceModel('sitemap/cms_page')->getCollection($storeId);
        if(count($collection) > 0) {
            foreach ($collection as $item) {
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($baseUrl . $item->getUrl()),
                    $date,
                    $changefreq,
                    $priority
                );
                $io->streamWrite($xml);
            }
        }
        unset($collection);

        /*
         * General learning page - more than core
         * */

        /* Add the blog homepage */
        $xml = sprintf(
            '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
            htmlspecialchars(Mage::helper('wordpress')->getUrl()),
            $date,
            'daily',
            '1.0'
        );
        $io->streamWrite($xml);

        /* add category page */
        $categoriesBlog = Mage::getResourceModel('wordpress/post_category_collection')
            ->addHasObjectsFilter();
        if(count($categoriesBlog) > 0) {
            foreach($categoriesBlog as $category) {
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($category->getUrl()),
                    $date,
                    'monthly',
                    '0.5'
                );
                $io->streamWrite($xml);
                $children = $category->getChildrenCategories();
                if(count($children) > 0) {
                    foreach($children as $child) {
                        $xml = sprintf(
                            '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                            htmlspecialchars($child->getUrl()),
                            $date,
                            'monthly',
                            '0.5'
                        );
                        $io->streamWrite($xml);
                    }
                }
            }
        }

        /* add post page*/
        $posts = Mage::getResourceModel('wordpress/post_collection')
            ->setFlag('include_all_post_types', true)
            ->addIsViewableFilter()
            ->setOrderByPostDate()
            ->load();
        if(count($posts) > 0) {
            foreach($posts as $post) {
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($post->getUrl()),
                    $post->getPostModifiedDate('Y-m-d'),
                    'monthly',
                    '0.5'
                );
                $io->streamWrite($xml);
            }
        }

        /* add page */
        $pages = Mage::getResourceModel('wordpress/page_collection')
            ->addIsViewableFilter()
            ->setOrderByPostDate()
            ->load();
        if(count($pages) > 0) {
            foreach($pages as $page) {
                $xml .= sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                    htmlspecialchars($page->getUrl()),
                    $page->getPostModifiedDate('Y-m-d'),
                    'monthly',
                    '0.8'
                );
                $io->streamWrite($xml);
            }
        }
        /* end general learning page*/

        /* general another */
        $xml .= sprintf(
            '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
            htmlspecialchars($baseUrl.'extras'),
            $date,
            'daily',
            '1.0'
        );
        $io->streamWrite($xml);
        /* end general another */

        $io->streamWrite('</urlset>');
        $io->streamClose();

        $this->setSitemapTime(Mage::getSingleton('core/date')->gmtDate('Y-m-d H:i:s'));
        $this->save();

        return $this;
    }
}