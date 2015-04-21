<?php
class SM_WPAddion_RssController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        if (!Mage::helper('sm_wpaddion')->enableRss()) {
            $this->norouteAction();
            return false;
        }
        $categoryId = $this->getRequest()->getParam('cid');
//        if(!$categoryId) {
//            $this->norouteAction();
//            return false;
//        }
        $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
        $this->loadLayout(false);
        $this->renderLayout();
    }
}