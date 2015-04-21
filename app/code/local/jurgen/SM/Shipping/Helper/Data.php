<?php

class SM_Shipping_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Define valible name save price
     */
    protected $_price = 0;

    /**
     * Function check Customer and Product satisfaction conditions
     *
     * @return price
     */

    public function setConfig()
    {
        $config = Mage::getStoreConfig('carriers/sm_shipping/active');
        if(!isset($config)) {
            $config = 0;
        }
        return $config;
    }

    /**
     * Function check Customer and Product satisfaction conditions
     *
     * @return price
     */

    public function getPriceCart()
    {
        if($this->getCustomerWholesale()) {
            $total = $this->getTotalCart();

            if($total <= 50) {
                $this->_price = 15;
            }
            if($total < 100 && $total > 50){
                $this->_price = 11;
            }
            if($total >= 100) {
                $this->_price = 6;
            }
            if($total >= 300) {
                $this->_price = 0;
            }
        }
        return $this->_price;
    }

    /**
     * Funtion getTotalCart in buy cart
     *
     * @return: total
     */

    public function getTotalCart()
    {
        $quote = Mage::getModel('checkout/session')->getQuote();
        $quoteData = $quote->getData();
        $total = $quoteData['grand_total'];

        return $total;
    }

    /**
     * Funtion getTotalCart in buy cart
     *
     * @return: total
     */
    public function getCustomerWholesale()
    {
        $customer_data = Mage::getSingleton('customer/session')->getCustomer()->getData();
        if(!empty($customer_data) && $customer_data['group_id'] == 2 ) {
            return true;
        }else {
            return false;
        }
    }
}