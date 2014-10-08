<?php
class Threemauto_News_Adminhtml_Custom_NewsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->_title($this->__('Menu Custom'))->_title($this->__('Manage News'));
        $this->loadLayout();
        $this->_setActiveMenu('giangnt');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news_edit'))
            ->_addLeft($this->getLayout()->createBlock('news/adminhtml_news_edit_tabs'));
        $this->renderLayout();
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('news/news');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('news/news');
            $id = $this->getRequest()->getParam('id');
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = implode(',', $this->getRequest()->getParam($key));
                }
            }

            if ($id) {
                $model->load($id);
            }
            $model->setData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $model->setId($id);
                }

                $model->save();

                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('news')->__('Error saving news details'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('news')->__('Details was successfully saved.'));

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                // The following line decides if it is a "save" or "save and continue"
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }

            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('No data found to save'));
        $this->_redirect('*/*/');
    }


    public function editAction()
    {

        $id = $this->getRequest()->getParam('id', null);

        $model = Mage::getModel('news/news');
        if ($id) {
            $model->load((int)$id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('news does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('news_data', $model);

        $this->_title($this->__('News'))->_title($this->__('Edit news'));
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news_edit'))
            ->_addLeft($this->getLayout()->createBlock('news/adminhtml_news_edit_tabs'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('news/adminhtml_news_grid')->toHtml()
        );
    }
}