<?php
class SM_Xblock_Manage_ItemController extends Mage_Adminhtml_Controller_action
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
 
	public function indexAction() {     //die;
		$this->_initAction()
			->renderLayout();                                                        
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('xblock/item')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('xblock_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('xblock/xblock');

//			$this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_edit'))
//				->_addLeft($this->getLayout()->createBlock('xblock/manage_xblock_edit_tabs'));
            $this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_edit'))
                ->_addLeft($this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_edit_tabs'));
//            $this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit_tab_item_edit_tab_form'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xblock')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() { 
//		$id     = $this->getRequest()->getParam('id');
//		$model  = Mage::getModel('xblock/item')->load($id);
//
//		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
//		if (!empty($data)) {
//			$model->setData($data);
//		}
//
//		Mage::register('xblock_data', $model);
//
//		$this->loadLayout();
//		$this->_setActiveMenu('xblock/xblock');
//
//		$this->_addContent($this->getLayout()->createBlock('xblock/manage_xblock_edit'))
//			->_addLeft($this->getLayout()->createBlock('xblock/manage_xblock_edit_tabs'));
//
//		$this->renderLayout();
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			$model = Mage::getModel('xblock/item');
 
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($this->getRequest()->getParam('creation_time') == NULL) {
					$model->setCreationTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
                // print"<pre>"; print_r($model->getBlockId()); die;
				$model->save();
				
				
				/* recount affected tags */
//				if(isset($data['stores'])){
//					$stores = $data['stores'];
//				}else{
//					$stores = array(null);
//				}

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xblock')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/manage_item/edit/', array('id' => $model->getId()));
					return;
				}
				$blockID = $this->getRequest()->getParam('block_id');
				$this->_redirect('*/manage_xblock/edit/', array('id' => $blockID));
                //$this->_redirect('*/*/');
                
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xblock')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$id = $this->getRequest()->getParam('id');
                $model = Mage::getModel('xblock/item')->load($id);
                $blockID = $model->getBlockId();
				$model->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/manage_xblock/edit/', array('id' => $blockID));
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		//$this->_redirect('*/*/');
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
}
