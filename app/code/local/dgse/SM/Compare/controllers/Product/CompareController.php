<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DucThang
 * Date: 12/10/14
 * Time: 6:16 PM
 */
class SM_Compare_Product_CompareController extends Mage_Core_Controller_Front_Action
{
    /**
     * Add item to compare list
     */
    public function addAction()
    {
        if (!$this->_validateFormKey()) {
            $this->_redirectReferer();
            return;
        }
        
        $session = Mage::getSingleton('catalog/session');
        if ( 5 <= Mage::helper('catalog/product_compare')->getItemCount()) {
            $session->setSmError(true);
            $session->getMessages()->clear();
            $session->addNotice($this->__('You have reached the limit of products to compare. Remove one and try again.'));
        } else {
            $productId = (int)$this->getRequest()->getParam('product');
            if ($productId
                && (Mage::getSingleton('log/visitor')->getId() || Mage::getSingleton('customer/session')->isLoggedIn())
            ) {
                $product = Mage::getModel('catalog/product')
                    ->setStoreId(Mage::app()->getStore()->getId())
                    ->load($productId);

                if ($product->getId() /* && !$product->isSuper()*/) {
                    Mage::getSingleton('catalog/product_compare_list')->addProduct($product);
                    $session->setSmError(false);
                    $session->setSmCompare(5 - Mage::helper('catalog/product_compare')->getItemCount());
                    $session->addSuccess(
                        $this->__('The product %s has been added to comparison list.', Mage::helper('core')->escapeHtml($product->getName()))
                    );
                    Mage::dispatchEvent('catalog_product_compare_add_product', array('product' => $product));
                }

                Mage::helper('catalog/product_compare')->calculate();
            }
        }


        $this->_redirectReferer();
    }
}