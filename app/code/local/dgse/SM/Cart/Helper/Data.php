<?php

class SM_Cart_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_cartProductIds;

    public function __construct()
    {
        $product_ids = array();
        $products = Mage::getSingleton('checkout/session')->getQuote()->getAllVisibleItems();
        foreach ($products as $_products)
        {
            $product_ids [$_products->getProductId()] = $_products->getQty();
        }
        $this->_cartProductIds = $product_ids;
    }

    public function isInCart($productId)
    {
        $productId = (int)$productId;
        if($productId < 0){
            return false;
        }
        return array_key_exists($productId, $this->_cartProductIds);
    }

    public function getQty($productId, $qty)
    {
        $productId = (int)$productId;
        $qty = (int)$qty;
        if($productId < 0 || $qty < 0){
            return false;
        }
        return  $this->_cartProductIds [$productId] + (int)$qty;
    }
}