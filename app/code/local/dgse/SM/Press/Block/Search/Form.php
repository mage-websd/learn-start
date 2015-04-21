<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class SM_Press_Block_Search_Form extends Fishpig_Wordpress_Block_Sidebar_Widget_Search
{
    /**
     * Retrieve the action URL for the search form
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return Mage::getBaseUrl().Mage::helper('sm_press')->getUrlSearch();
    }
}
