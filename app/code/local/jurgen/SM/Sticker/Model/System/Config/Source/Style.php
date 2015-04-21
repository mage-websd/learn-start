<?php
class SM_Sticker_Model_System_Config_Source_Style
{
	static function instance() {
		static $_instance;
		if (NULL === $_instance) {
			$_instance = new SM_Sticker_Model_System_Config_Source_Sort();
		}
		return $_instance;
	}
	public function toOptionArray()
    {
		static $_list;
		if (NULL === $_list) {
			$_list = array(
				array('value'=>'blue', 'label'=>Mage::helper('adminhtml')->__('Sale - BLUE globe')),
				array('value'=>'cyan', 'label'=>Mage::helper('adminhtml')->__('Sale - CYAN globe')),
				array('value'=>'red', 'label'=>Mage::helper('adminhtml')->__('Sale - RED globe')),
				array('value'=>'green', 'label'=>Mage::helper('adminhtml')->__('Sale - GREEN globe')),				
				array('value'=>'yellow', 'label'=>Mage::helper('adminhtml')->__('Sale - YELLOW globe')),
			);
		}
		return $_list;
    }
}