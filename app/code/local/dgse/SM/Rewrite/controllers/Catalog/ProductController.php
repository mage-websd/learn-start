<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 12/16/14
 * Time: 11:52 AM
 */
require_once 'Mage/Catalog/controllers/ProductController.php';


class SM_Rewrite_Catalog_ProductController extends Mage_Catalog_ProductController {
    public function viewAction()
    {
        // Get initial data from request
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId  = (int) $this->getRequest()->getParam('id');
        $specifyOptions = $this->getRequest()->getParam('options');

        // Prepare helper and params
        $viewHelper = Mage::helper('catalog/product_view');

        $params = new Varien_Object();
        $params->setCategoryId($categoryId);
        $params->setSpecifyOptions($specifyOptions);
        $product = Mage::getModel("catalog/product")->load($productId);
        $stockItem = $product->getStockItem();
        if($stockItem->getIsInStock())
        {
         //Render page
        try {
            $viewHelper->prepareAndRender($productId, $this, $params);
        } catch (Exception $e) {
            if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
                if (isset($_GET['store'])  && !$this->getResponse()->isRedirect()) {
                    $this->_redirect('');
                } elseif (!$this->getResponse()->isRedirect()) {
                    $this->_forward('noRoute');
                }
            } else {
                Mage::logException($e);
                $this->_forward('noRoute');
            }
        }
        } else {
            $this->_forward('noRoute');
        }


    }
}