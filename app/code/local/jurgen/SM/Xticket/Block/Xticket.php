<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Xticket extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSofTicket()     
     { 
        if (!$this->hasData('xticket')) {
            $this->setData('xticket', Mage::registry('xticket'));
        }
        return $this->getData('xticket');
        
    }
}