<?php
class SM_WPAddion_Block_Rss_Detail extends Mage_Rss_Block_Abstract
{
    protected function _construct()
    {
        /*
        * setting cache to save the rss for 10 minutes
        */
        $this->setCacheKey(Mage::helper('sm_wpaddion')->prefixUrlRss().'_'
            . $this->getRequest()->getParam('cid') . '_'
            . $this->getRequest()->getParam('store_id') . '_'
            . Mage::getModel('customer/session')->getId()
        );
        $this->setCacheLifetime(600);
    }

    protected function _toHtml()
    {

        if (!Mage::helper('sm_wpaddion')->enableRss()) {
            return false;
        }
        $categoryId = $this->getRequest()->getParam('cid');
        $rssObj = Mage::getModel('rss/rss');

        if ($categoryId) {
            $category = Mage::getModel('wordpress/term')->load($categoryId);
            if ($category && $category->getId()) {
                $urlCategory = $category->getUrl();
                $titleCategory = $category->getName();
                $data = array(
                    'title' => $titleCategory,
                    'description' => $titleCategory,
                    'link'        => $urlCategory,
                    'charset'     => 'UTF-8',
                );

                $rssObj->_addHeader($data);

                $blog = Mage::getModel('wordpress/post')
                    ->getCollection()
                    ->addCategoryIdFilter($categoryId)
                    ->setOrderByPostDate()
                    ->setCurPage(1)
                    ->setPageSize(Mage::helper('sm_wpaddion')->getNumberRss());

                if ($blog->getSize()>0) {
                    $args = array('rssObj' => $rssObj);
                    foreach ($blog as $article) {
                        $args['article'] = $article;
                        $this->addInformation($args);
                    }
                }
            }
        } else {
            $data = array(
                'title' => 'Blog RSS Feeds',
                'description' => 'Blog RSS Feeds',
                'link'        => '',
                'charset'     => 'UTF-8',
            );
            $rssObj->_addHeader($data);

            $articles = Mage::getModel('wordpress/post')
                ->getCollection()
                ->setOrderByPostDate()
                ->setPageSize(100)
                ->setCurPage(1);

            if ($articles->getSize() > 0) {
                $args = array('rssObj' => $rssObj);
                foreach ($articles as $article) {
                    $args['article'] = $article;
                    $this->addInformation($args);
                }
            }
        }

        return $rssObj->createRssXml();
    }

    /**
     * Preparing data and adding to rss object
     *
     * @param array $args
     */
    public function addInformation($args)
    {
        $article = $args['article'];
        $article->setAllowedInRss(true);

        if (!$article->getAllowedInRss()) {
            return;
        }

        $description =
            '<table><tr>'
            . '<td><a href="'.$article->getUrl().'">';
        if($featuredImage = $article->getFeaturedImage()) {
            $description .=  '<img src="'.$featuredImage->getAvailableImage().'" border="0" align="left" height="75" width="75" />';
        }
        $shortDescription = $article->getData('post_content');
        $shortDescription = substr($shortDescription,0,Mage::helper('sm_wpaddion')->getNumberShortDescription());
        $shortDescription .= '...';
        $description .= '</a></td>'
            . '<td  style="text-decoration:none;">' . $shortDescription .'</td></tr></table>';
        $rssObj = $args['rssObj'];
        $data = array(
            'title'         => $article->getData('post_title'),
            'link'          => $article->getUrl(),
            'description'   => $description,
        );
        $rssObj->_addEntry($data);
    }
}
