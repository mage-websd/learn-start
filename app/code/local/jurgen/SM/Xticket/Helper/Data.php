<?php

/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getPriorities(){
    	return  array(
						'1' => $this->__('Urgent'), 
						'2' => $this->__('ASAP'), 
						'3' => $this->__('To do'),
						'4' => $this->__('If time'),
						'5' => $this->__('Postponed')												
					);
    }

    public function isAdmin(){
  		$user=Mage::getSingleton('admin/session')->getUser();
  		$userId=$user->getUserId();
        $roleId = implode('', $user->getRoles());
        $roleName = Mage::getModel('admin/roles')->load($roleId)->getRoleName();
  		if ($roleName == 'Administrators')
  			return true;
  		return false;
    }
  
	public function getMailDBSettings(){
		$array =  array();
		$model  = Mage::getModel('xticket/mail');
		if ($model){
			foreach($model->getCollection()->load() as $_item) { 
				$key=$_item->getData('key');
				$value=$_item->getData('value');
				$array[$key]= $value;
			} 
		}
		return $array;
	}
	

	public function getAllCategories($admin=true){
		
		$model_cats  = Mage::getModel('xticket/cats');
		$cats = array();
		foreach ($model_cats->getCollection()->load() as $item){
			$hidden=$item->getData('hidden');
			if (! ($admin ==false && $hidden =='1')){
				$key=$item->getData('ID');
				$cats[$key]= $item;
			}
		}
		return $cats;
	}

	public function getAllTemplates($admin=true){
		
		$model_templates  = Mage::getModel('xticket/templates');
		$templates = array();
		foreach ($model_templates->getCollection()->load() as $item){
			$hidden=$item->getData('hidden');
			if (! ($admin ==false && $hidden =='1')){
				$key=$item->getData('id');
				$templates[$key]= $item;
			}
		}
		return $templates;
	}
		
	public function getCategory($catID){
		$cats=$this->getAllCategories();
		if ($catID >0 && $cats[$catID])
			return $cats[$catID]->getName();
	}
	
	public function getMessage($id){
		$model  = Mage::getModel('xticket/messages');
		if ($id >0 && $model)
			return $model->load($id);
	}
	
	public function getAllMessage($id){

	}
	
	public function getTicket($id){
    	if ($id>0){
    		$softicketModel = Mage::getModel('xticket/xticket')->load($id);
			return $softicketModel;
    	}
	}
	
	public function getAllRepresantatives(){
		$model_reps  = Mage::getModel('xticket/reps');
		$reps = array();
		foreach ($model_reps->getCollection()->load() as $item){
			$key=$item->getData('ID');
			$reps[$key]= $item;
		}
		return $reps; 
	}
	
	
    public function getTicketID() {
	    do {
	        mt_srand((double)microtime() *1000000);
	        $min = 100000;
	        $max = 999999;
	        $id = mt_rand($min, $max);
	    }while ($this->validID($id));
		return $id;
	}
	function validID($id) {
		$model= Mage::getModel('xticket/xticket');
		return $model->load($id)->getData('ID');
	}
}