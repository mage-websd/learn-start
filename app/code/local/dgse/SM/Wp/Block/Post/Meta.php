<?php
class SM_Wp_Block_Post_Meta extends Fishpig_Wordpress_Block_Post_Meta
{
    public function getCategoryString(Fishpig_Wordpress_Model_Post_Abstract $object, array $params = array())
    {
        $html = array();
        if (count($categories = $object->getParentCategories()) > 0) {
            if(Mage::registry('wordpress_category_educational')) {
                foreach($categories as $category) {
                    $url = Mage::helper('sm_wp')->getUrlCategoryFlag($category);
                    $html[] = $this->_generateAnchor($url, $category->getName(), $params);
                }
            }
            else {
                foreach($categories as $category) {
                    $html[] = $this->_generateAnchor($category->getUrl(), $category->getName(), $params);
                }
            }
        }

        return implode(', ', $html);
    }
}