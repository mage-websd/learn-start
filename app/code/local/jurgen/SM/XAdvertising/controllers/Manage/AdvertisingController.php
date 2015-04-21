<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * SM_XAdvertising Manage Advertising controller (Admin controller): 
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_Manage_AdvertisingController extends Mage_Adminhtml_Controller_Action
{
   public function preDispatch()
    {
        parent::preDispatch();
    }
	
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('xadvertising/items');
		return $this;
	}   
 
	public function indexAction()
    {
		$this->_initAction()
			//->_addContent($this->getLayout()->createBlock('xadvertising/admin_main'))
			->renderLayout();
    }
    public function newAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xadvertising/xadvertising')->load($id);
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register('xadvertising_data', $model);

		$this->loadLayout();
		$this->_setActiveMenu('xadvertising/items');

		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

		$this->_addContent($this->getLayout()->createBlock('xadvertising/admin_xadvertising_edit'))
			->_addLeft($this->getLayout()->createBlock('xadvertising/admin_xadvertising_edit_tabs'));

		$this->renderLayout();
	}
	public function editAction() {
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xadvertising/xadvertising')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('xadvertising_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('xadvertising/items');

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('xadvertising/admin_xadvertising_edit'))
				->_addLeft($this->getLayout()->createBlock('xadvertising/admin_xadvertising_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xadvertising')->__('Advertising does not exist'));
			$this->_redirect('*/*/');
		}
	}
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			// var_dump($data);die;
			$data['stores'] = implode(',', $data['stores']);
			$model = Mage::getModel('xadvertising/xadvertising');	
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
			
				$model->save();
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xadvertising')->__('Xadvertising was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xadvertising')->__('Unable to find xadvertising to save'));
        $this->_redirect('*/*/');
	}
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('xadvertising/xadvertising');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Xadvertising was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $linkIds = $this->getRequest()->getParam('xadvertising');
        if(!is_array($linkIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select advertising(s)'));
        } else {
            try {
                foreach ($linkIds as $linkId) {
                    $xadvertising = Mage::getModel('xadvertising/xadvertising')->load($linkId);
                    $xadvertising->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($linkIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $linkIds = $this->getRequest()->getParam('xadvertising');
        if(!is_array($linkIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select xadvertising(s)'));
        } else {
            try {

                foreach ($linkIds as $linkId) {
                    $xadvertising = Mage::getModel('xadvertising/xadvertising')
                        ->load($linkId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setStores('')
                        ->setIsMassupdate(true)
                        ->save();
                      
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($linkIds))
                );
            } catch (Exception $e) {
            	
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
 
 
}