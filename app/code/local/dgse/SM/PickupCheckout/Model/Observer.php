<?php
class SM_PickupCheckout_Model_Observer{
    public function saveOrderLocation($observer){
        $pickupLocation = Mage::getSingleton('core/session')->getPickupLocation();
        Mage::getSingleton('core/session')->unsPickupLocation();
        if($pickupLocation) {
            $resource = new Mage_Core_Model_Resource();
            $write = $resource->getConnection('core_write');

            $orderId = $observer['order']->getId();
            $insertData = array(
                'order_id' => $orderId,
                'location_id' => $pickupLocation
            );
            $write->insert('sm_pickupcheckout_orderlocation', $insertData);
        }
    }
}
