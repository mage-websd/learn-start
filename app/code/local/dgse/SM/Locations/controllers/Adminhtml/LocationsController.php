<?php

class SM_Locations_Adminhtml_LocationsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/sm_locations_location')
            ->_title($this->__('Catalog'))->_title($this->__('Location'))
            ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
            ->_addBreadcrumb($this->__('location'), $this->__('Location'));
        $this->renderLayout();
    }

    public function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/sm_locations_location')
            ->_title($this->__('Catalog'))->_title($this->__('Location'))
            ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
            ->_addBreadcrumb($this->__('Location'), $this->__('Location'));

        return $this;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('sm_locations/locations');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This location no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getlocationName() : $this->__('New Location'));

        $data = Mage::getSingleton('adminhtml/session')->getlocationData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('sm_locations', $model);
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Location') : $this->__('New location'), $id ? $this->__('Edit Location') : $this->__('New location'))
            ->_addContent($this->getLayout()->createBlock('sm_locations/adminhtml_location_edit')->setData('action', $this->getUrl('*/*/save')))
            ->_addLeft($this->getLayout()->createBlock('sm_locations/adminhtml_location_edit_tabs'))
            ->renderLayout();
    }

    public function deleteAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('sm_locations/locations');
        try {

            $model->setId($id)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The location has been deleted.'));
            $this->_redirect('*/*/');

            return;
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while deleting this location.'));
        }
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {

            $location_id = $postData['location_id'];
            $links = $this->getRequest()->getPost('links');
            $vasso_param = Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['plocations']);

            $model = Mage::getSingleton('sm_locations/locations');

            try {

                $model->setData($postData);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The location has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this location.'));
            }

            Mage::getSingleton('adminhtml/session')->setlocationData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction()
    {
        $data = Mage::getModel('sm_locations/locations')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }


    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/sm_locations_location');
    }

}