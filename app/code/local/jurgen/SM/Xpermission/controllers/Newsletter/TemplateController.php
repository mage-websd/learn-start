<?php
require_once 'Mage'.DS.'Adminhtml'.DS.'controllers'.DS.'Newsletter'.DS.'TemplateController.php';

class SM_Xpermission_Newsletter_TemplateController extends Mage_Adminhtml_Newsletter_TemplateController {
    public function preDispatch() {
        parent::preDispatch();

        $_user = Mage::getSingleton('admin/session');
        if ($_user->isLoggedIn() and !$_user->getUser()->isRoot()) {
            $actionName = $this->getRequest()->getActionName();
            if($actionName == "edit" || $actionName == "save" || $actionName == "delete" ) {
                $id = $this->getRequest()->getParam('id');
                if($actionName == "save") {
                    $id = $this->getRequest()->getPost('id');
                }
                if(!empty ($id) && !is_null($id)) {
                    $model = Mage::getModel('newsletter/template')->load($id);
                    $websiteID = $model->getWebsiteId();
                    if($websiteID != Mage::getSingleton('admin/session')->getUser()->getWebsiteId()) {
                        $this->_redirect('*/*/');
                    }
                }
            }
        }
        return $this;
    }
}
