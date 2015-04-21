<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * SM_XAdvertising Model status: 
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_Model_Status extends Varien_Object{
    
	const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;
	const STATUS_HIDDEN		= 3;

	public function addEnabledFilterToCollection($collection)
    {
        $collection->addEnableFilter(array('in'=>$this->getEnabledStatusIds()));
        return $this;
    }
	
	public function addCatFilterToCollection($collection, $cat)
    {
        $collection->addCatFilter($cat);
        return $this;
    }
	
	public function getEnabledStatusIds()
    {
        return array(self::STATUS_ENABLED);
    }
	
	public function getDisabledStatusIds()
    {
        return array(self::STATUS_DISABLED);
    }
	
	public function getHiddenStatusIds()
    {
        return array(self::STATUS_HIDDEN);
    }

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('xadvertising')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('xadvertising')->__('Disabled'),
			self::STATUS_HIDDEN		=> Mage::helper('xadvertising')->__('Hidden')
        );
    }
}
