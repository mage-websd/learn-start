<?php
/*
 * SearchController: search controller of search press page
 * */
class SM_Press_SearchController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
        $this->loadLayout();

        $paramSearch = $this->getRequest()->getParam('s');
        if(!$paramSearch) {
            $paramSearch = '';
        }
        else {
            $paramSearch = "'{$paramSearch}'";
        }
        $this->getLayout()->getBlock('head')->setTitle($this->__('Press Search '.$paramSearch));

        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb('home', array(
                'label' => $this->__('Home'),
                'title' => $this->__('Go to Home Page'),
                'link' => Mage::getBaseUrl()
            ))->addCrumb('press', array(
                'label' => $this->__('Press'),
                'title' => $this->__('Press'),
                'link' => Mage::getBaseUrl().Mage::helper('sm_press')->getNameCategoryPress(),
            ))->addCrumb('search', array(
                'label' => $this->__('Search'),
                'title' => $this->__('Search'),
            ));
        }

        $this->renderLayout();
    }
}