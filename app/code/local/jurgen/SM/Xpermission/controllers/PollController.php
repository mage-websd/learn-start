<?php
/**
 * Adminhtml poll manager controller
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
require_once 'Mage'.DS.'Adminhtml'.DS.'controllers'.DS.'PollController.php';
class SM_Xpermission_PollController extends Mage_Adminhtml_PollController {

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
                    $model = Mage::getModel('poll/poll')->load($id);
                    $websiteID = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
                    $storeID = Mage::getModel('core/website')->load($websiteID)->getStoreIds();
                    if(!array_key_exists($id, $storeID)) {
                        $this->_redirect('*/*/');
                    }
                }
            }
        }
        return $this;
    }

}