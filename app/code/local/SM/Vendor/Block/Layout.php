<?php

/**
 * Class SM_Vendor_Block_Layout
 */
class SM_Vendor_Block_Layout extends Mage_Core_Block_Template
{

    protected function _construct()
    {
        parent::_construct();
    }
    /**
     * getlinkSkin: get link to skin
     * @return string
     */
    public function getLinkSkin()
    {
        return Mage::getBaseUrl('skin').'frontend/default/default/sm/vendor/';
    }
}