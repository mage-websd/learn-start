<?php

class SM_WPAddion_Block_Rss_List extends Mage_Rss_Block_List
{
    public function getRssBlogList()
    {
        if (!Mage::helper('sm_wpaddion')->enableRss()) {
            return false;
        }
        $this->resetRssFeed();
        $this->blogRssFeed();
        return $this->getRssFeeds();
    }

    public function blogRssFeed()
    {
        $showType = Mage::helper('sm_wpaddion')->getShowTypeRss();
        $category = Mage::getModel('wordpress/term')
            ->getCollection()
            ->addFieldToSelect('term_id')
            ->addFieldToSelect('name')
            ->addTaxonomyFilter('category')
            ->setOrder('name','asc');
        if($showType=='category_level_1') {
            $category->addParentIdFilter(0);
        }

        foreach ($category as $cate) {
            $this->addRssFeed(Mage::helper('sm_wpaddion')->prefixUrlRss(), $cate->getName(), array('cid' => $cate->getId(), 'type' => 'blog'));
        }
    }
}