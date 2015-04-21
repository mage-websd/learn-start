<?php
/**
 * Created by PhpStorm.
 * User: QuyNH
 * Date: 12/24/14
 * Time: 2:50 PM
 */ 
class SM_Rewrite_Model_Category extends Mage_Catalog_Model_Category {
    public function formatUrlKey($str){
        $str = Mage::helper('core')->removeAccents($str);
        $urlKey = preg_replace('#[^0-9a-z]+#i', '-', $str);
        if( $str != 'New30' ) {
            $urlKey = strtolower($urlKey);
        }
        $urlKey = trim($urlKey, '-');
        return $urlKey;
    }
}