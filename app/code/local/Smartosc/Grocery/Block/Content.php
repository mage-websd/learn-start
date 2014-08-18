<?php
class Smartosc_Grocery_Block_Content extends Mage_Core_Block_Template
{
	public function getSkinDes()
    {
        return Mage::getBaseUrl('skin') . 'frontend/grocery/default/';
    }
}