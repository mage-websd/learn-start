<?php
class SM_WPAddion_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{
    public function match(Zend_Controller_Request_Http $request)
    {
        $path = trim($request->getPathInfo(), '/');
        $rssPathBlog = Mage::helper('sm_wpaddion')->prefixUrlRss();
        if(strrpos($path,$rssPathBlog)===0) {
            $request->setModuleName('wp-addion')
                ->setControllerName('rss')
                ->setActionName('view');
            return true;
        }
        return false;
    }
}