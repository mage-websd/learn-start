<?php

class SM_Locations_Model_Resource_Locations_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_locations/locations');
    }
}