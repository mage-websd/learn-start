<?php
class SM_Featured_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Featured'));
        $data = $this->getRequest()->getParam('id');
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb(
            'home',
            array(
                'label'=>$this->__('Home'),
                'title'=>$this->__('Home'),
                'link'=>Mage::getBaseUrl()
            )
        );
        $breadcrumbs->addCrumb(
            'brands',
            array(
                'label'=>$this->__('Featured'),
                'title'=>$this->__('Featured')
            )
        );
        $this->getLayout()->getBlock("featured_product")->assign("data",$data);
        $this->renderLayout();
    }
}