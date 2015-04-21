<?php
require_once 'Mage'.DS.'Adminhtml'.DS.'controllers'.DS.'Promo'.DS.'CatalogController.php';

class SM_Xpermission_Promo_CatalogController extends Mage_Adminhtml_Promo_CatalogController {
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
                    $model = Mage::getModel('catalogrule/rule')->load($id);
                    $websiteID = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
                    $websiteIdList = $model->getWebsiteIds();
                    $flag = true;
                    foreach($websiteIdList as $w){
                        if($websiteID==$w){
                            $flag = false;
                            break;
                        }
                    }
                    if($flag)
                        $this->_redirect('*/*/');
                }
            }
        }
        return $this;
    }
}
