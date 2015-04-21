<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 11/3/2014
 * Time: 5:24 AM
 */

class SM_Youtube_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Extras'));
        $this->renderLayout();
    }
} 