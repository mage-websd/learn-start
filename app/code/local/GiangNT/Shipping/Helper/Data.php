<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 12/02/2015
 * Time: 10:26
 */ 
class GiangNT_Shipping_Helper_Data extends Mage_Core_Helper_Abstract {

    const XML_EXPRESS_MAX_WEIGHT = 'carriers/giangnt_shipping/express_max_weight';
    /**
     * Get max weight of single item for express shipping
     *
     * @return mixed
     */
    public function getExpressMaxWeight()
    {
        return Mage::getStoreConfig(self::XML_EXPRESS_MAX_WEIGHT);
    }
}