<?php

/**
 * Class SM_Vendor_Block_Urls
 *
 * rewrite block Mage_Customer_Block_Form_Register
 */
class SM_Vendor_Block_Urls extends Mage_Customer_Block_Form_Register
{
    /**
     * return url action form registrer
     * rewrite url post create customer
     * @return string
     */
    public function getPostActionUrl()
    {
        return Mage::getBaseUrl().'vendor/customer/createpost';
    }
}