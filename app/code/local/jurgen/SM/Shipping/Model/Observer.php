<?php

class SM_Shipping_Model_Observer
{
    /**
     * Define data have info of store event
     *
     */
    protected $_data = array(
                                'pro10_view'
                            );
    /**
     *
     * Define data have name carrier
     */
    protected $_dataCarrier = array(
                                'sm_shipping' => 'sm_shipping',
                                'free_shipping' => 'freeshipping'
                            );
    /**
     *
     * Action show carier check conditions
     *
     * @return mixed
     */

    public function hideShippingMethods( Varien_Event_Observer $observer )
    {
        if (Mage::getDesign()->getArea() === Mage_Core_Model_App_Area::AREA_FRONTEND)
        {
            $quote  = $observer->getEvent()->getQuote();
            $store  = Mage::app()->getStore($quote->getStoreId());
            $storeCode = $store->getCode();

            if(in_array($storeCode, $this->_data) || $store->getStoreId() == 2)
            {
                $checkWholesale = Mage::helper('sm_shipping/data')->getCustomerWholesale();
                if($checkWholesale == true) {
                    $carriers = Mage::getStoreConfig('carriers', $store);
                    if (!empty($carriers)) {
                        foreach ($carriers as $carrierCode => $carrierConfig) {
                            if ($carrierCode == $this->_dataCarrier['sm_shipping'] || $carrierCode == $this->_dataCarrier['free_shipping']) {
                                $store->setConfig("carriers/{$carrierCode}/active", '1');
                            } else {
                                $store->setConfig("carriers/{$carrierCode}/active", '0');
                            }
                        }
                    }
                }
                else
                {
                    $store->setConfig("carriers/{$this->_dataCarrier['sm_shipping']}/active", '0');
                }
            }
            else
            {
                $store->setConfig("carriers/{$this->_dataCarrier['sm_shipping']}/active", '0');
            }
        }
    }
}