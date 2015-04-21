<?php
    class SM_Press_IndexController extends Fishpig_Wordpress_Controller_Abstract
    {
        public function indexAction()
        {
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setTitle($this->__('Press'));
            // add Home breadcrumb
            $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
            if ($breadcrumbs) {
                $breadcrumbs->addCrumb('home', array(
                    'label' => $this->__('Home'),
                    'title' => $this->__('Go to Home Page'),
                    'link' => Mage::getBaseUrl()
                ))->addCrumb('press', array(
                    'label' => $this->__('Press'),
                    'title' => $this->__('Press'),
                    ));
            }
            $category = Mage::getModel('wordpress/post_category')->getCollection()->addSlugFilter(Mage::helper('sm_press')->getNameCategoryPress());
            if(count($category) > 0) {
               foreach($category as $cate) {
                   $press = $cate;
                   $this->getLayout()->getBlock('press_list')->setCategory($press);
               }
            }
            $this->renderLayout();
        }
    }