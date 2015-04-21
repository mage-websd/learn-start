<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Adminhtml_SettingController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('xticket/setting')
			->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('Settings'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		return $this;
	}   
 
	public function indexAction() {
		$this->_forward('edit');
			
	}

	public function editAction() {
		$this->loadLayout();
		$this->_setActiveMenu('xticket/setting');
		$this->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('Settings'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		
		$model  = Mage::getModel('xticket/settings');

		if ($model){
			$array =  array();
			foreach($model->getCollection()->load() as $_item) { 
				$key=$_item->getData('key');
				$value=$_item->getData('value');
				$array[$key]= $value;
			} 
			$model->setData($array);
			Mage::register('xticket_settingdata', $model);

			$this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_xticket_setting'))
				->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_xticket_setting_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	
	
	
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {

		if ($data = $this->getRequest()->getPost()) {

			$model = Mage::getModel('xticket/settings');

			try {
				foreach($model->getCollection()->load() as $_item) { 
					$id=$_item->getData('ID');
					$key=$_item->getData('key');
					$array= null;
					if(array_key_exists($key,$data)){
						$value=1;
						if (! (strstr($key,'smtp_auth') || strstr($key,'alert_new')))
							$value=$data[$key];
						$array = array('ID'=> $id, 'key'=> $key, 'value'=> $value);
					}
					else if (strstr($key,'smtp_auth') ||strstr($key,'alert_new')) {
						$array = array('ID'=> $id, 'key'=> $key, 'value'=>0);
					}
					if($array){
						$model->setData($array);
						$model->save();
					}
				} 
					
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Settings were successfully updated'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit');
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit');
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 

}