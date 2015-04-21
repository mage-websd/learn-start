<?php
class SM_Xmaincategory_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/xmaincategory?id=15 
    	 *  or
    	 * http://site.com/xmaincategory/id/15 	
    	 */
    	/* 
		$xmaincategory_id = $this->getRequest()->getParam('id');

  		if($xmaincategory_id != null && $xmaincategory_id != '')	{
			$xmaincategory = Mage::getModel('xmaincategory/xmaincategory')->load($xmaincategory_id)->getData();
		} else {
			$xmaincategory = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($xmaincategory == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$xmaincategoryTable = $resource->getTableName('xmaincategory');
			
			$select = $read->select()
			   ->from($xmaincategoryTable,array('xmaincategory_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$xmaincategory = $read->fetchRow($select);
		}
		Mage::register('xmaincategory', $xmaincategory);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}