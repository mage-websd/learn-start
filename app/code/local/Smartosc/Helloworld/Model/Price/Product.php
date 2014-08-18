<?php
class Smartosc_Helloworld_Model_Price_Product
{
    public function __construct()
    {
    }
    /**
     * Applies the special price percentage discount
     * @param   Varien_Event_Observer $observer
     * @return  Xyz_Catalog_Model_Price_Observer
     */
    public function applyDetail($observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();
        $product->setFinalPrice(10); // set the product final price
        return $this;
        /*
        // process percentage discounts only for simple products
        if ($product->getSuperProduct() && $product->getSuperProduct()->isConfigurable()) {
        }
        else {
            $percentDiscount = $product->getPercentDiscount();

            if (is_numeric($percentDiscount)) {
                $today = floor(time()/86400)*86400;
                $from = floor(strtotime($product->getSpecialFromDate())/86400)*86400;
                $to = floor(strtotime($product->getSpecialToDate())/86400)*86400;

                if ($product->getSpecialFromDate() && $today < $from) {
                }
                elseif ($product->getSpecialToDate() && $today > $to) {
                }
                else {
                    $price = $product->getPrice();
                    $finalPriceNow = $product->getData('final_price');

                    $specialPrice = $price - $price * $percentDiscount / 100;

                    // if special price is negative - negate the discount - this may be a mistake in data
                    if ($specialPrice < 0)
                        $specialPrice = $finalPriceNow;

                    if ($specialPrice < $finalPriceNow)
                        $product->setFinalPrice(10); // set the product final price
                }
            }
        }
        return $this;
        */
    }
    
    public function applyCart($observer)
    {
        $item = $observer->getQuoteItem();
        if ($item->getParentItem()) {
            $item = $item->getParentItem();
        }
        $item->setOriginalCustomPrice(45);
        return $this;
    }
}