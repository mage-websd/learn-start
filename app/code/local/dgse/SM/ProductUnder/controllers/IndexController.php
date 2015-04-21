<?php
/**
 * Created by PhpStorm.
 * User: SCORPION
 * Date: 12/2/14
 * Time: 5:03 PM
 */
class SM_ProductUnder_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}