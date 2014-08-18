<?php
class Smartosc_Priceapply_Model_Price_Product
{
    public function __construct()
    {
    }
    public function applyDetail($observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();
        $product->setFinalPrice(35); // set the product final price
        return $this;
    }
    
    public function applyCart($observer)
    {
        $item = $observer->getQuoteItem();
        if ($item->getParentItem()) {
            $item = $item->getParentItem();
        }
        $item->setOriginalCustomPrice(100);
        return $this;
    }
    public function applyCatalog($observer)
    {
        $event = $observer->getEvent();
        $products = $event->getCollection();
        foreach ($products as $product) {
            $product->setFinalPrice(10);
        }
        return $this;

    }
}