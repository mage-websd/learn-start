<?php

class SM_Xticket_Model_Status extends Varien_Object
{
    const STATUS_NEW	= '1';
	const STATUS_CLOSED	= '2';
    const STATUS_AWAITING	= '3';  
    
    
    static public function getOptionArray()
    {
        return array(
            self::STATUS_NEW    => Mage::helper('xticket')->__('Open'),
			self::STATUS_CLOSED   	=> Mage::helper('xticket')->__('Closed'),
            self::STATUS_AWAITING   	=> Mage::helper('xticket')->__('Waiting for customer'),            
        );
    }
}