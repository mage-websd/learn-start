<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Adminhtml_RepController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('xticket/rep')
			->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('Representative'));
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction();
		$this->renderLayout();
	}
	

	public function editAction() {
		$this->loadLayout();
		$this->_setActiveMenu('xticket/rep');
		$this->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('Representative'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		

		$id = $this->getRequest()->getParam('id');
		// Edit
		if ($id > 0) {
			$admin_model  = Mage::getModel('admin/user')->load($id);
			$email=$admin_model->getEmail();
			$name=$admin_model->getFirstname().' '.$admin_model->getLastname();
			if ($email){
				$admin_model->setName($name)
					->setLblName($name)
					->setLblEmail($admin_model->getEmail())
					->setLblUsername($admin_model->getUsername())
					->setLblPassword($admin_model->getPassword());
					
				$reps= Mage::getModel('xticket/reps')->getCollection()->addFieldToFilter('username',$admin_model->getUsername());
				if ($reps->getItems()){
					foreach ($reps as $rep){
						$admin_model->setSignature($rep->getSignature());
					}
				}else{
//					Mage::log('editAction:');
					$reps = Mage::getModel('xticket/reps');
					$reps->setData('name',$name);
					$reps->setData('email',$admin_model->getData('email'));
					$reps->setData('username',$admin_model->getData('username'));
					$reps->setData('password',$admin_model->getData('password'));
					$reps->save();
				}
			}

			// set data for the front.
			Mage::register('rep_data', $admin_model);
		}

		$this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_rep_edit'))
			 ->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_rep_edit_tabs'));
		$this->renderLayout();
	}
 

	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {

		$id=$this->getRequest()->getParam('id');
		$data = $this->getRequest()->getPost();
//		Mage::log($data);
		try{
			$admin_model  = Mage::getModel('admin/user')->load($id);
			if ($admin_model && $admin_model->getUsername()){
				$reps= Mage::getModel('xticket/reps')->getCollection()->addFieldToFilter('username',$admin_model->getUsername())->load();
				if ($reps->getItems()){
					foreach ($reps as $rep){
						if ($data['signature'])
							$rep->setData('signature',$data['signature']);
						$rep->save();
					}
				}
			}
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Representative was successfully updated'));
			$this->_redirect('*/*/', array('id' => $id));
	
		} catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/', array('id' => $id));
        }	
       
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('xticket/reps');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Representative was successfully deleted'));
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
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select representative(s)'));
        } else {
            try {
                foreach ($softicketIds as $softicketId) {
                    $softicket = Mage::getModel('xticket/reps')->load($softicketId);
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
	
    
  
    public function exportCsvAction()
    {
        $fileName   = 'xticket.csv';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'softicket.xml';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}