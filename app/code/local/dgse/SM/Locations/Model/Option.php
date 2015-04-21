<?php

class SM_Locations_Model_Option extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {

        if (is_null($this->_options)) {
            $result = array();
            $result[] = array(
                'label' => '-- Please Select --',
                'value' => ''
            );
            $colection = Mage::getModel('sm_locations/locations')->getCollection();
            if($colection){
                foreach($colection as $location){
                    $result[] = array(
                        'label' => $location->getLocationTitle(),
                        'value' => $location->getId()
                    );
                }
            }
            $this->_options = $result;

        }
        return $this->_options;
    }
}