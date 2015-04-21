<?php
class SM_Sticker_Model_System_Config_Source_Content
{
	public function toOptionArray()
    {
		static $_list;
		if (NULL === $_list) {
			$_list = array(
				array('value'=>1, 'label'=>Mage::helper('adminhtml')->__('SALE $00.00')),
				array('value'=>2, 'label'=>Mage::helper('adminhtml')->__('OFF  %00.00')),
			);
		}
		return $_list;
    }
}