<?php
/**
 * Created by PhpStorm.
 * User: Hà
 * Date: 24/12/2014
 * Time: 10:48 PM
 */
 class SM_CustomProductQuestion2_AddController extends Mage_Core_Controller_Front_Action
 {
     public function indexAction()
     {
         $this->loadLayout();
         $productId = $this->getRequest()->getParam('product_id');
         if($productId)
         {
             $product = Mage::getModel('catalog/product')->load($productId);
             if($product->getId())
             {
                 Mage::register('current_product',$product);
                 $this->getLayout()->createBlock('catalog/breadcrumbs');
                 $breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs');
                 $breadcrumbsBlock->addCrumb('product', array(
                     'label'    => $product->getName(),
                     'link'     => $product->getProductUrl()
                 ));
                 $breadcrumbsBlock->addCrumb('questions', array(
                     'label' => $this->__('Product Questions'),
                 ));
             }
             else
             {
                 Mage::getSingleton('core/session')->addError('Product not found');
             }
         }
         else
         {
             Mage::getSingleton('core/session')->addError('Product not found');
         }
         $this->renderLayout();
     }
 }