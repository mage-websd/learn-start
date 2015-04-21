<?php
class SM_Sticker_Model_System_Config_Source_Stickerstyle
{
	public function toOptionArray()
    {
		static $_list;
		if (NULL === $_list) {
			$_list = array(
				array('value'=>'blue', 'label'=>Mage::helper('adminhtml')->__('New - BLUE globe')),
				array('value'=>'cyan', 'label'=>Mage::helper('adminhtml')->__('New - CYAN globe')),
				array('value'=>'red', 'label'=>Mage::helper('adminhtml')->__('New - RED globe')),
				array('value'=>'green', 'label'=>Mage::helper('adminhtml')->__('New - GREEN globe')),				
				array('value'=>'yellow', 'label'=>Mage::helper('adminhtml')->__('New - YELLOW globe')),
				
			);
		}
		return $_list;
    }
}