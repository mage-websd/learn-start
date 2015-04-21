<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 9/18/14
 * Time: 3:38 PM
 */
require_once 'Mage/Checkout/controllers/OnepageController.php';


class SM_Rewrite_OnepageController extends Mage_Checkout_OnepageController {
    public function successAction()
    {
        $lastOrderId = "";
        $this->loadLayout();
        $this->_initLayoutMessages('checkout/session');
        Mage::dispatchEvent('checkout_onepage_controller_success_action', array('order_ids' => array($lastOrderId)));
        $this->renderLayout();
    }
}