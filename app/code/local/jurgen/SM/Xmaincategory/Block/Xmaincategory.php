<?php
class SM_Xmaincategory_Block_Xmaincategory extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getXmaincategory()     
     { 
        if (!$this->hasData('xmaincategory')) {
            $this->setData('xmaincategory', Mage::registry('xmaincategory'));
        }
        return $this->getData('xmaincategory');
        
    }
}