<?php
require_once(Mage::getModuleDir('controllers','FME_Manufacturers').DS.'ViewController.php');
class SM_Manufacturers_ViewController extends FME_Manufacturers_ViewController
{
    public function indexAction()
    {

        $this->loadLayout();

        // create canonical link
        if (strpos($_SERVER['REQUEST_URI'], '?')) {
            $temp = explode('?', $_SERVER['REQUEST_URI']);
            $href = 'http://' . $_SERVER['HTTP_HOST'] . $temp[0];
        } else {
            $href = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $canonicalLink = '<link rel="canonical" href="'. $href .'" />';

        // append to head block
        $this->getLayout()->getBlock('head')->append(
            $this->getLayout()
                ->createBlock('core/text', 'canonica-link')
                ->setText($canonicalLink)
        );

        $this->renderLayout();
    }
}