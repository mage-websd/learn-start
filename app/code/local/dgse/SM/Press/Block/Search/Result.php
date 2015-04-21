<?php
class SM_Press_Block_Search_Result extends Fishpig_Wordpress_Block_Search_Result
{
    protected function _getPostCollection()
    {
        if (is_null($this->_postCollection)) {
            $this->_postCollection = parent::_getPostCollection()
                ->addSearchStringFilter($this->_getParsedSearchString(), array('post_title', 'post_content'));

            if ($postTypes = $this->getRequest()->getParam('post_type')) {
                $this->_postCollection->addPostTypeFilter($postTypes);
            }
            else {
                $this->_postCollection->addPostTypeFilter(array('post', 'page'));
            }

            $this->_postCollection->addCategorySlugFilter(Mage::helper('sm_press')->getNameCategoryPress());
        }

        return $this->_postCollection;
    }
}