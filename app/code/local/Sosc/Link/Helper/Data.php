<?php
class Sosc_Link_Helper_Data extends Mage_Core_Helper_Abstract {
    public function skinAdmin()
    {
        return Mage::getBaseUrl('skin').'adminhtml/default/default/sosc/';
    }
}