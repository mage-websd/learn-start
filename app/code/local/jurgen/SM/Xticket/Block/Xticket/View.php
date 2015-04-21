<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


class SM_Xticket_Block_Xticket_View extends Mage_Core_Block_Template
{
 	protected function _prepareLayout(){
        $this->getLayout()->getBlock('head')->setTitle(Mage::helper('xticket')->__('Ticket'));
        return parent::_prepareLayout();
    }
	
    public function getTickets(){
    	return Mage::registry('xticket_all');
    }
    
 	public function getDepartments(){
    	return Mage::helper('xticket')->getAllCategories(false);
    }
    
    public function getDepartment($id){
    	return Mage::helper('xticket')->getCategory($id);
    }
    
    public function getPriority($priority){
    	$priorites= Mage::helper('xticket')->getPriorities();
    	return $priorites[$priority];
    }
    
    public function getStatus($status){
    	$statuses = Mage::getSingleton('xticket/status')->getOptionArray();
    	return $statuses[$status];
    }
    
    
}