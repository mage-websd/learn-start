<?php
require Mage::getModuleDir('controllers','Fishpig_Wordpress').'/PostController.php';
class SM_Wp_IndexController extends Fishpig_Wordpress_PostController
{
    public function indexAction()
    {
        $this->_forward('noRoute');
    }
}