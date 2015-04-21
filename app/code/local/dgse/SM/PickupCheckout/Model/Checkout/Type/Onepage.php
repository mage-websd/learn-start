<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 12/2/14
 * Time: 10:03 AM
 */
class SM_PickupCheckout_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage {
    public function saveBilling($data, $customerAddressId)
    {
        Mage::getSingleton('core/session')->unsPickupLocation();
        Mage::getSingleton('core/session')->setBillingAddress($data);
        parent::saveBilling($data, $customerAddressId);
    }
    public function saveShipping($data, $customerAddressId, $pickupChosen=0)
    {
        if($pickupChosen){
            if (empty($data)) {
                return array('error' => -1, 'message' => Mage::helper('checkout')->__('Please select a location'));
            }
            Mage::getSingleton('core/session')->setPickupLocation($data);
            $data = Mage::getSingleton('core/session')->getBillingAddress();
        }
        parent::saveShipping($data, $customerAddressId);
    }

    public function saveShippingMethod($shippingMethod)
    {
        if (empty($shippingMethod)) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        if(!Mage::getSingleton('core/session')->getPickupLocation()) {
            $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
            if (!$rate) {
                return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
            }
        }
        $this->getQuote()->getShippingAddress()
            ->setShippingMethod($shippingMethod);

        $this->getCheckout()
            ->setStepData('shipping_method', 'complete', true)
            ->setStepData('payment', 'allow', true);

        return array();
    }
}