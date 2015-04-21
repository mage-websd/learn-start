<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Adminhtml_TemplateController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('xticket/template')
			->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('Template'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction();
		$this->renderLayout();		
			
	}
	

	public function editAction() {
		$this->loadLayout();
		$this->_setActiveMenu('xticket/template');
		$this->_addBreadcrumb(Mage::helper('xticket')->__('Tickets'), Mage::helper('xticket')->__('Template'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		

		$id = $this->getRequest()->getParam('id');
		// Edit Ticket
		if ($id > 0) {
			
			$model  = Mage::getModel('xticket/templates')->load($id);
			//print"<pre>"; print_r($model);
			// set data for the front.
			Mage::register('template_data', $model);
		}
		$this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_template_edit'))
			 ->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_template_edit_tabs'));
		$this->renderLayout();
	}
 

	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		$id=$this->getRequest()->getParam('id');
		$data = $this->getRequest()->getPost();
		//print"<pre>"; print_r($data); exit();
		$is_new=false;
		if ($id == 0)
			$is_new=true;
		try {
			// *********************************************
			// New template
			if ($is_new){
				$template= Mage::getModel('xticket/templates');
				$template->setData($data);
				$template->save();
			}
			// Existing template
			else {
				$template=Mage::getModel('xticket/templates')->load($id);
				$template->setData($data);
				$template->setData('id',$id);
				$template->save();
			}
			
			// *********************************************
					
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Template was successfully saved'));

        	if ($is_new)
				$this->_redirect('*/*/', array('id' => $id));
			else
				$this->_redirect('*/*/edit', array('id' => $id));
	
		} catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/', array('id' => $id));
        }	
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('xticket/templates');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Template was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $softicketIds = $this->getRequest()->getParam('xticket');
        if(!is_array($softicketIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select template(s)'));
        } else {
            try {
                foreach ($softicketIds as $softicketId) {
                    $softicket = Mage::getModel('xticket/templates')->load($softicketId);
                    $softicket->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('xticket')->__(
                        'Total of %d record(s) were successfully deleted', count($softicketIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
	

	
}