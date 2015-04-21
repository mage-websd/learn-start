<?php
/**
 * Adminhtml newsletter queue controller
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
require_once 'Mage'.DS.'Adminhtml'.DS.'controllers'.DS.'Newsletter'.DS.'QueueController.php';
class SM_Xpermission_Newsletter_QueueController extends Mage_Adminhtml_Newsletter_QueueController {
    public function preDispatch() {
        parent::preDispatch();
        $_user = Mage::getSingleton('admin/session');
        if ($_user->isLoggedIn() and !$_user->getUser()->isRoot()) {
            $actionName = $this->getRequest()->getActionName();
            if($actionName == "edit" || $actionName == "save" || $actionName == "delete" ) {
                $id = $this->getRequest()->getParam('template_id');
                if($actionName == "save") {
                    $id = $this->getRequest()->getPost('template_id');
                }
                if(!empty ($id) && !is_null($id)) {
                    $model = Mage::getModel('newsletter/queue')->load($id);
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
