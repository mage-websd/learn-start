<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


class SM_Xticket_Block_Xticket_Edit extends Mage_Core_Block_Template
{
	
 	protected function _prepareLayout()
    {
        return parent::_prepareLayout();  
    }

 	public function getName(){
 		$session = Mage::getSingleton('customer/session'); 
 		if ($session){
	 		$customerId= $session->getCustomerId();
	 		if ($customerId>0){
	 			$customer = Mage::getModel('customer/customer')->load($customerId);
		    	return $customer->getName();
	 		}
 		}
 		return '';
    }
    
 	public function getEmail(){
 		$session = Mage::getSingleton('customer/session'); 
 		if ($session){
	 		$customerId= $session->getCustomerId();
	 		if ($customerId>0){
	 			$customer = Mage::getModel('customer/customer')->load($customerId);
		    	return $customer->getEmail();
	 		}
 		}
 		return '';
    }
    
 	public function getTicket($id){
 		if ($id>0)
    		return Mage::helper('xticket')->getTicket($id);
    }
    
 	public function getDepartments(){
    	return Mage::helper('xticket')->getAllCategories(false);
    }
    
    
 	public function getDepartment($id){
    	return Mage::helper('xticket')->getCategory($id);
    }
    
 	public function getMessage($ticketId){
 		
 			$reps=Mage::helper('xticket')->getAllRepresantatives(true);
 			$answers='';
			$model_ans  = Mage::getModel('xticket/answers');
			foreach ($model_ans->getCollection()->addFieldToFilter('ticket',$ticketId)->load() as $item){
				$message=$item->getData('message');
				$rep=$item->getData('rep');
				$timestamp=$item->getData('timestamp');
				$represantative='';
				if (array_key_exists($rep,$reps))
					$represantative = $reps[$rep]->getData('name');
				$answers .='('.$represantative.' '.$timestamp.') '.$message."<br>";
			}
			$model_msg  = Mage::getModel('xticket/messages')->load($ticketId, 'ticket');
			$message = $model_msg->getMessage();
			$timestamp= $model_msg->getTimestamp();
			$rep=$model_msg->getRep();
			$represantative='';
			$represantative='';
			if (array_key_exists($rep,$reps))
				$represantative = $reps[$rep]->getData('name');
			$message ='('.$represantative.' '.$timestamp.') '.$message."<br>";
			
			if ($answers)
				$message = $message."<br>".$answers;
			// **********************************************
			
    	
    	if ($message)
    		return $message;
    	return '';
    }
    
 	public function getPriorities(){
    	return Mage::helper('xticket')->getPriorities();
    }
    
    public function getPriority($priority){
    	$priorites= Mage::helper('xticket')->getPriorities();
    	return $priorites[$priority];
    }
    
    public function getTitle($id)
    {
        if ($title = $this->getData('title')) {
            return $title;
        }
        if ($id)
        	return Mage::helper('xticket')->__('Edit Ticket');
        return Mage::helper('xticket')->__('Add Ticket');
    }

    public function getBackUrl()
    {
        if ($this->getData('back_url')) {
            return $this->getData('back_url');
        }
        return $this->getUrl('xticket/');
    }

    public function getSaveUrl($id)
    {
    	if($id>0)
        	return Mage::getUrl('xticket/index/editPost', array('_secure'=>true, 'id'=>$id));
        return Mage::getUrl('xticket/index/addPost', array('_secure'=>true));
    }

}