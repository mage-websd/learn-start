<?php

/**
 * Class SM_Vendor_Model_Resource_Vendor_Attribute_Unit
 *
 * option select for attribute customer_type
 */
class SM_Vendor_Model_Resource_Vendor_Attribute_Unit extends
    Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => '',
                    'label' => '--choose customer type--',
                ),
                array(
                    'value' => 'normal',
                    'label' => 'Nomar',
                ),
                array(
                    'value' => 'vendor',
                    'label' => 'Vendor',
                ),
            );
        }
        return $this->_options;
    }
}