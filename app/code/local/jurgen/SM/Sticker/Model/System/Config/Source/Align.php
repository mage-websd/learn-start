<?php
class SM_Sticker_Model_System_Config_Source_Align
{
	public function toOptionArray()
    {
		static $_list;
		if (NULL === $_list) {
			$_list = array(
				array('value'=>1, 'label'=>Mage::helper('adminhtml')->__('Top')),
				array('value'=>2, 'label'=>Mage::helper('adminhtml')->__('Right')),
				array('value'=>2, 'label'=>Mage::helper('adminhtml')->__('Bottom')),
				array('value'=>2, 'label'=>Mage::helper('adminhtml')->__('Left')),
			);
		}
		return $_list;
    }

}