<?php
class SM_Xblock_Manage_XblockController extends Mage_Adminhtml_Controller_action
{
	public function preDispatch()
    {
        parent::preDispatch();
    }
	
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('xblock/xblock');
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xblock/xblock')->load($id);

		if ($model->getId()) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('xblock_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('xblock/xblock');

			$this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit'))
				->_addLeft($this->getLayout()->createBlock('xblock/manage_xblock_edit_tabs'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xblock')->__('Post does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xblock/xblock')->load($id);

		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register('xblock_data', $model);

		$this->loadLayout();
		$this->_setActiveMenu('xblock/xblock');

		$this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit'))
			->_addLeft($this->getLayout()->createBlock('xblock/manage_xblock_edit_tabs'));
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		$this->renderLayout();
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			$model = Mage::getModel('xblock/xblock');
			          
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($this->getRequest()->getParam('creation_time') == NULL) {
					$model->setCreationTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	

				$model->save();
				
				
				/* recount affected tags */
				if(isset($data['stores'])){
					$stores = $data['stores'];
				}else{
					$stores = array(null);
				}
				
				
				
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xblock')->__('Post was successfully saved'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xblock')->__('Unable to find post to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('xblock/xblock');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Post was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $IDList = $this->getRequest()->getParam('xblock');
        if(!is_array($blogIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select post(s)'));
        } else {
            try {
                foreach ($IDList as $ID) {
                    $model = Mage::getModel('xblock/xblock')->load($ID);
                    $model->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($IDList)
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
        $blogIds = $this->getRequest()->getParam('blog');
        if(!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select post(s)'));
        } else {
            try {
                foreach ($blogIds as $blogId) {
                    $blog = Mage::getSingleton('blog/blog')
                        ->load($blogId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($blogIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }


	
    public function categoriesAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_categories')->toHtml()
        );
    }	


    public function categoriesJsonAction()
    {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xblock/xblock')->load($id);

		if ($model->getId()) {
			Mage::register('xblock_data', $model);	
		}
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_categories')
				->getCategoryChildrenJson($this->getRequest()->getParam('category'))
		);
    }	
}
