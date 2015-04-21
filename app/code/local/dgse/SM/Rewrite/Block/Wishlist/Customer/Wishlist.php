<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 12/9/14
 * Time: 11:38 AM
 */ 
class SM_Rewrite_Block_Wishlist_Customer_Wishlist extends Mage_Wishlist_Block_Customer_Wishlist {
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle($this->__('My Wish List'));
        }
    }
}