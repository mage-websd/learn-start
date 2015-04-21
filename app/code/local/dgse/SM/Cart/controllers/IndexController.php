<?php


class SM_Cart_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $productId = $this->getRequest()->getParam('productItem');
        $quantity = $this->getRequest()->getParam('item');

        if(Mage::helper('sm_cart')->isInCart($productId)){
            $item = Mage::helper('sm_cart')->getQty($productId, $quantity);
            echo $item;
        }
    }
    public function miniAction()
    {
        $respon = array();
        if ($this->getRequest()->isXmlHttpRequest()) {
            $update = $this->getLayout()->getUpdate();
            $update->addHandle('default');
            $this->addActionLayoutHandles();
            $this->loadLayoutUpdates();
            $this->generateLayoutXml()->generateLayoutBlocks(); //Generate new blocks
            $blockMiniCartContent = $this->getLayout()->createBlock('ajaxcart/cart_ajaxcart')->setTemplate('checkout/cart/mini_cart_ajax.phtml');
            //$minicart = $this->getLayout()->getBlock('mini-cart')->toHtml(); // Generate New Layered Navigation Menu
            $respon['status'] = '1';
            $respon['qtycart'] = $blockMiniCartContent->getSummaryCount();
            $respon['content'] = $blockMiniCartContent->toHtml();
            $respon['tag'] = '#mini-cart-block .mini-cart .block-content .block-inner';
            echo Mage::helper('core')->jsonEncode($respon);
            return;
        }
        $respon['status'] = '0';
        echo Mage::helper('core')->jsonEncode($respon);
    }
}