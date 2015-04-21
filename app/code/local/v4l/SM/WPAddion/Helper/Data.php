<?php
/**
 * Created by PhpStorm.
 * User: GiangNT
 * Date: 06/01/2015
 * Time: 09:05
 */ 
class SM_WPAddion_Helper_Data extends Mage_Core_Helper_Abstract {
    public function enableRss()
    {
        if(Mage::getStoreConfig('wordpress/rss/enabled') &&
            !Mage::getStoreConfig('advanced/modules_disable_output/SM_WPAddion')) {
            return true;
        }
        return false;
    }
    public function getNumberRss()
    {
        $number = Mage::getStoreConfig('wordpress/rss/number');
        if($number && (is_int($number) || ctype_digit($number)) && $number > 0) {
            return $number;
        }
        return 10;
    }
    public function getNumberShortDescription()
    {
        return 200;
    }
    public function getShowTypeRss()
    {
        return Mage::getStoreConfig('wordpress/rss/show');
    }
    public function prefixUrlRss()
    {
        return 'blog/rss/view';
    }
}