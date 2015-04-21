<?php

class SM_Youtube_Adminhtml_YoutubeController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Param name module
     */
    protected $_module = 'sm_youtube';

    /**
     * Load layout and enable active module youtube
     *
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sm_youtube/manage');
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
             ->renderLayout();

    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     *
     * With action insert or update show info for form youtube
     *
     */
    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('sm_youtube/youtube')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('sm_youtube_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('sm_youtube/manage');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_youtube/adminhtml_youtube_edit'))
                 ->_addLeft($this->getLayout()->createBlock('sm_youtube/adminhtml_youtube_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sm_youtube')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }


    /**
     *
     * Action save information youtube post database
     *
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('image');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(false);

                    // Set the file upload mode 
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders 
                    // (file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS ;
                    $uploader->save($path, $_FILES['image']['name'] );

                } catch (Exception $e) {
                }
                //this way the name is saved in DB
                $data['image'] = $_FILES['image']['name'];
            }else {
                $data['image'] = $data['image']['value'];
            }

            $model = Mage::getModel('sm_youtube/youtube');
            $model->setData($data)
                  ->setId($this->getRequest()->getParam('id'));
            try {

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sm_youtube')->__('Item was successfully saved'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sm_youtube')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    /**
     *
     * Call action delete youtube in module
     *
     */
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('entity_id') > 0 ) {
            try {
                $model = Mage::getModel('sm_youtube/youtube');
                $model->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     *
     * Change status or delete youtube in module
     *
     */
    public function massDeleteAction()
    {
        $webIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getModel('sm_youtube/youtube')->load($webId);
                    $web->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($webIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }


    /**
     *
     * Change status or delete youtube in module
     *
     */

    public function massStatusAction()
    {
        $webIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                        Mage::getModel('sm_youtube/youtube')
                        ->load($webId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($webIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Hàm thực hiện việc load ajax hay $this->setUseAjax(true); return block grid
     *
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock($this->_module.'/adminhtml_youtube_grid')->toHtml());
    }



    /**
     * Hàm thực hiện export file .csv cho module
     *
     */
    public function exportCsvAction()
    {
        $fileName   = $this->_module.'.csv';
        $content    = $this->getLayout()->createBlock($this->_module.'/adminhtml_youtube_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Hàm thực hiện export file .xml cho module
     *
     */
    public function exportXmlAction()
    {
        $fileName   = $this->_module.'.xml';
        $content    = $this->getLayout()->createBlock($this->_module.'/adminhtml_youtube_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * Hàm thực hiện export file .excel cho module
     *
     */
    public function exportExcelAction()
    {
        $fileName   = $this->_module.'.xls';
        $content    = $this->getLayout()->createBlock($this->_module.'/adminhtml_youtube_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }


}