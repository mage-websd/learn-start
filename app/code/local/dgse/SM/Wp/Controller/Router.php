<?php

class SM_Wp_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    private static $_module = 'sm-wp';
    private static $_realModule = 'Sm_Wp';
    private static $_controller = 'index';
    private static $_tagFront = 'sm_wp';

    protected $_request;

    public function initControllerRouters($observer)
    {
        $front = $observer->getEvent()->getFront();

        $front->addRouter(self::$_tagFront, $this);
    }

    public function match(Zend_Controller_Request_Http $request)
    {
        $this->_request = $request;
        $identifier = trim($request->getPathInfo(), '/');

        //If Magento Is Not Installed Reroute To Installer
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }

        $frontNameFlag = Mage::helper('sm_wp')->getFrontNameFlag();
        //If we dont match our router then let another router take over
        if (substr($identifier, 0, strlen($frontNameFlag)) != $frontNameFlag) {
            return false;
        } //If we do match the our router then lets add some data and dispatch our controller

        else {
            $routeParams = trim(substr($identifier, strlen($frontNameFlag)), '/');//get router param
            $arrayParamUrl = explode('/',$routeParams);
            $sizeParamUrl = count($arrayParamUrl);
            if($sizeParamUrl == 0 ) {
                return false;
            }
            $lastParamUrl = $arrayParamUrl[$sizeParamUrl-1]; //param last router
            unset($arrayParamUrl[($sizeParamUrl-1)]);

            $categoryFlag = Mage::getModel('wordpress/post_category')->load($frontNameFlag,'slug');
            if(! $idFlag = $categoryFlag->getTermId()) {
                return false;
            }
            $idsSubSubFlag = Mage::helper('sm_wp')->getAllSubSubCategoryId($idFlag); //get all sub sub flag category
            $idsSubSubFlag[] = $idFlag;
            /* check param is category or post */
            $category = Mage::getResourceModel('wordpress/post_category_collection')
                ->addSlugFilter($lastParamUrl);
            if(count($category) > 0) {
                $id = $category->getFirstItem()->getId();
                if(!$this->_existsCategory($arrayParamUrl,$lastParamUrl,$idsSubSubFlag,'category')) {
                    return false;
                }
                $this->_setRequestRoute('category','view', array('typeItem'=>'category','idItem'=>$id));
                return true;
            }
            $post = Mage::getResourceModel('wordpress/post_collection')
                ->addIsPublishedFilter()
                ->addFieldToFilter('post_name',$lastParamUrl);
            if(count($post) > 0) {
                $id = $post->getFirstItem()->getID();
                if(!$this->_existsCategory($arrayParamUrl,$id,$idsSubSubFlag,'post')) {
                    return false;
                }
                $this->_setRequestRoute('post','view', array('typeItem'=>'post','idItem'=>$id));
                return true;
            }
        }
        return false;
    }

    protected function _setRequestRoute($controller, $action, $params = array())
    {
        $this->_request->setModuleName(self::$_module)
            ->setControllerName($controller)
            ->setActionName($action)
            ->setControllerModule(self::$_realModule);
        if(count($params) > 0)
        foreach($params as $key => $value) {
            $this->_request->setParam($key,$value);
        }
        return true;
    }

    protected function _existsCategory($arrayParamUrl,$item,$idsSubSubFlag,$type='post')
    {
        $sizeParam = count($arrayParamUrl);
        if($sizeParam == 0 || !$arrayParamUrl) {
            return true;
        }
        for($i = ($sizeParam - 1) ; $i >=0 ; $i-- ) {
            if(!$arrayParamUrl[$i]) {
                continue;
            }
            $category = Mage::getModel('wordpress/post_category')->load($arrayParamUrl[$i],'slug');
            if($idCategory = $category->getTermId()) {
                if(!in_array($idCategory,$idsSubSubFlag)) { /*if category not in category and sub flag */
                    return false;
                }
                if($type == 'post') {
                    $categoryFilter = Mage::getResourceModel('wordpress/post_category_collection')
                        ->addPostIdFilter($item)
                        ->addSlugFilter($arrayParamUrl[$i]);
                    if(count($categoryFilter) == 0) {
                        return false;
                    }
                    $type = 'category';
                }
                else {
                    $categoryFilter = Mage::getResourceModel('wordpress/post_category_collection')
                        ->addParentIdFilter($idCategory)
                        ->addSlugFilter($item);
                    if(count($categoryFilter) == 0) {
                        return false;
                    }
                }
                $item = $arrayParamUrl[$i];
            }
            else {
                return false;
            }
        }
        return true;
    }
}