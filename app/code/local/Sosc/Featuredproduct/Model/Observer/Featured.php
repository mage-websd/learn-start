<?php
class Sosc_Featuredproduct_Model_Observer_Featured
{
    public function catalog_product_prepare_save($observer)
    {
        $product = $observer->getEvent()['product'];

        $params = $observer->getEvent()['request']->getPost()['product'];
        if(isset($params['featured'])) {
            $product->setFeatured(1);
        }
        else {
            $product->setFeatured(0);
        }
    }
}