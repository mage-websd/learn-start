<?php
require Mage::getModuleDir('controllers','Sns_Quickview').'/IndexController.php';
class SM_Rewrite_Quickview_IndexController extends Sns_Quickview_IndexController
{
    public function _initProduct()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            $path  = trim((string) $this->getRequest()->getParam('path'),'/');
            $this->_redirect($path);
            return;
        }
        return parent::_initProduct();
    }
}