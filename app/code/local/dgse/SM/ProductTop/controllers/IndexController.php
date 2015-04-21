<?php

class SM_ProductTop_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        // change page title
        $this->getLayout()->getBlock('head')->setTitle($this->__('Newest 30 Items'));
        // add Home breadcrumb
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb('home', array(
                'label' => $this->__('Home'),
                'title' => $this->__('Go to Home Page'),
                'link' => Mage::getBaseUrl()
            ))->addCrumb('new30', array(
                    'label' => 'Newest 30 Items',
                    'title' => 'Newest 30 Items'
                ));
        }
        $this->renderLayout();
    }
}