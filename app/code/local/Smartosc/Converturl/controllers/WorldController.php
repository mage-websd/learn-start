<?php
/**
 * `WorldController` extends class `Mage_Catalog_ProductController`
 */

//load file `app/code/core/Mage/Catalog/controllers/ProductController.php`
require_once Mage::getModuleDir('controllers', 'Mage_Catalog').DS.'ProductController.php';

class Smartosc_Converturl_WorldController extends Mage_Catalog_ProductController
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function viewAction()
    {
        /**
         * `viewAction`: display product detail
         */
        parent::viewAction();
    }
}