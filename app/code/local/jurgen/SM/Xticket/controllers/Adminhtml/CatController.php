<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Adminhtml_CatController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('xticket/cat')
                ->_addBreadcrumb(Mage::helper('xticket')->__('Departments'), Mage::helper('xticket')->__('Departments'));
		 return $this;
    }
    
    public function indexAction() {
		$this->_initAction();
        $this->renderLayout();
    }


    public function editAction() {
	
        $this->loadLayout();
        $this->_setActiveMenu('xticket/cat');
        $this->_addBreadcrumb(Mage::helper('xticket')->__('Tickets'), Mage::helper('xticket')->__('Departments'));
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);


        $id = $this->getRequest()->getParam('id');
		// Edit Ticket
        if ($id > 0) {

            $model  = Mage::getModel('xticket/cats')->load($id);
            // set data for the front.
            Mage::register('cat_data', $model);
        }
        $this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_cat_edit'))
                ->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_cat_edit_tabs'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        $id=$this->getRequest()->getParam('id');
        $data = $this->getRequest()->getPost();

        $is_new=false;
        if ($id == 0)
            $is_new=true;
        try {
            // *********************************************
            // New Cat
            if ($is_new) {
                $cat= Mage::getModel('xticket/cats');
                $cat->setData($data);
                $cat->save();
            }
            // Existing Cat
            else {
                $cat=Mage::getModel('xticket/cats')->load($id);
                $cat->setData($data);
                $cat->setData('ID',$id);
                $cat->save();
            }

            // *********************************************

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Department was successfully saved'));

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
                $model = Mage::getModel('xticket/cats');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Department was successfully deleted'));
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
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select department(s)'));
        } else {
            try {
                foreach ($softicketIds as $softicketId) {
                    $softicket = Mage::getModel('xticket/cats')->load($softicketId);
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



    public function exportCsvAction() {
        $fileName   = 'xticket.csv';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName   = 'xticket.xml';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream') {
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