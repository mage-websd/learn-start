<?php
class Sosc_Featuredproduct_Adminhtml_FeaturedController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('sosc/item');
        //$this->_addBreadcrumb(Mage::helper('featuredproduct')->__('Form'), Mage::helper('featuredproduct')->__('Form'));
        $this->renderLayout();
    }
    public function editAction()
    {
        $params = $this->getRequest()->getParams();
        var_dump($params);
        /*$this->loadLayout();
        $this->renderLayout();*/
    }
    public function saveAction()
    {
        $params = $this->getRequest()->getParams();
        var_dump($params);
    }

    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        try {
            if (empty($post)) {
                Mage::throwException($this->__('Invalid form data.'));
            }

            /* here's your form processing */

            $message = $this->__('Your form has been submitted successfully.');
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*');
    }
}