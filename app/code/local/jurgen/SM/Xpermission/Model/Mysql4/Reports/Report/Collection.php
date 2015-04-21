<?php
class SM_Xpermission_Model_Mysql4_Reports_Report_Collection extends Mage_Reports_Model_Mysql4_Report_Collection {
    public function initReport($modelClass)
    {
       if (Mage::app()->getRequest()->getParam('website')) {
            $_storeList = Mage::app()->getWebsite(Mage::app()->getRequest()->getParam('website'))->getStoreIds();
        } else if (Mage::app()->getRequest()->getParam('group')) {
            $_storeList = Mage::app()->getGroup(Mage::app()->getRequest()->getParam('group'))->getStoreIds();
        } else if (Mage::app()->getRequest()->getParam('store')) {
            $_storeList = array((int)Mage::app()->getRequest()->getParam('store'));
        } else {
			$websiteID = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
			$_storeList = Mage::getModel('core/website')->load($websiteID)->getStoreIds();        
		}
		$this->_model = Mage::getModel('reports/report')
			->setPageSize($this->getPageSize())
			->setStoreIds($_storeList)
			->initCollection($modelClass);
    }	
}
