<?php
class SM_Autocomplete_Helper_Data extends Mage_Core_Helper_Data {
    public function getPostCollection($keyword) {
        $postCollection = Mage::getResourceModel('wordpress/post_collection')
        ->addPostTypeFilter(array('post', 'page'))
        ->addSearchStringFilter($this->_getParsedSearchString($keyword), array('post_title'),'AND')
        ->setPageSize(10)
        ->setCurPage(1);

        if (Mage::getSingleton('customer/session')->isLoggedIn() && Mage::helper('wordpress')->isAddonInstalled('CS')) {
            $postCollection->addStatusFilter(array('publish', 'private'));
        }
        else {
            $postCollection->addStatusFilter('publish');
        }

        return $postCollection;
    }
    protected function _getParsedSearchString($keyword)
    {
        $words = explode(' ', $this->getSearchTerm($keyword));
        if (count($words) > 15) {
            $words = array_slice($words, 0, $maxWords);
        }

        foreach($words as $it => $word) {
            if (strlen($word) < 3) {
                unset($words[$it]);
            }
        }
        return $words;
    }
    public function getSearchTerm($keyword)
    {
        return urldecode(Mage::helper('core')->escapeHtml($keyword));
    }
}