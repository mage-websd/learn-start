<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 1/21/15
 * Time: 11:10 AM
 */ 
class SM_Rewrite_Block_Wishlist_Customer_Sharing extends Mage_Wishlist_Block_Customer_Sharing {
    protected function _prepareLayout()
    {
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle($this->__('Wish List Sharing'));
        }
    }
}