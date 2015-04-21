<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * SM_XAdvertising Index block:
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_Block_Index extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
		if (Mage::getStoreConfig('xadvertising/xadvertising/enabled') != 1) {
		     $this->setTemplate('xadvertising/empty.phtml');
		}
		else
		{
		   $this->setTemplate('xadvertising/index.phtml');
		}
    }
	public function getListItems()
	{
	   $limited = Mage::getStoreConfig('xadvertising/frontend/limited');
	   $orderby = Mage::getStoreConfig('xadvertising/frontend/orderby');
	   $sorttype = Mage::getStoreConfig('xadvertising/frontend/ordertype');
	   $xadvertising = Mage::getModel("xadvertising/xadvertising");
	   $orderbystr = "";
	   if($orderby == 1)
	   {
	     $orderbystr = "unique_id";
	   }
	   elseif($orderby == 2)
	   {
	     $orderbystr = "rand()";
	   }
	   elseif($orderby == 5)
	   {
	     $orderbystr = "orders";
	   }
	   $current_store = Mage::app()->getStore()->getId();
	   //$current_store  = array('' => Mage::app()->getStore()->getId() );
	   $collections = array();
	   $xadvertisingCollection =  $xadvertising->getCollection()->addFieldToFilter("status", 1)
	   														//->addFieldToFilter("stores")
															->setOrder($orderbystr,$sorttype)
															->setPageSize($limited)
															->load();
															foreach($xadvertisingCollection as $s){
																$data = explode(',',$s->getStores());
																foreach($data as $d){
																	if($d == $current_store){
																		$collections[] =  $s;
																	}
																}

															//	die('ff');
															}
														//var_dump(count($xadvertisingCollection));die('dd');
		return $collections;
	}
}
