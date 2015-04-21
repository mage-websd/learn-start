<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 23/01/2015
 * Time: 09:12
 */ 
class SM_WP_Helper_Data extends Fishpig_Wordpress_Helper_Data {
    public function getReadMoreText()
    {
        return Mage::getStoreConfig('wordpress/integration/readmore');
    }
    public function getReadMoreButton($link)
    {
        if(!$this->getReadMoreText()) {
            return '';
        }
        return "<a href=\"$link\">".$this->getReadMoreText()."</a>";
    }
}