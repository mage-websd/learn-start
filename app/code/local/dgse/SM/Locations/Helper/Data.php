<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 11/06/2014
 * Time: 09:42
 * To change this template use File | Settings | File Templates.
 */ 
class SM_Locations_Helper_Data extends Mage_Core_Helper_Abstract {

    public function registerLocationsUrl()
    {
        return Mage::getUrl('locations/index/register/');
    }

    public function listLocationsUrl()
    {
        return Mage::getUrl('locations/index/index');
    }


}