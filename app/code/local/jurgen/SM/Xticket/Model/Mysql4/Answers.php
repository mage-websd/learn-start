<?php

class SM_Xticket_Model_Mysql4_Answers extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the id refers to the key field in your database table.
        $this->_init('xticket/answers', 'id');
    }
    
	public function getThreadContent() {
        $ticketId = Mage::app()->getRequest()->getParam('id', false);				
		$select = $this->_getReadAdapter()
			->select()
			->from($this->getTable('xticket/answers'))
			->joinLeft(array('att' => $this->getTable('attachments')), $this->getMainTable().'.ticket = `att`.ticket')
			->where($this->getMainTable().'.ticket = ?', $ticketId)
			;
		//echo $select._($select); exit;
		return $this->_getReadAdapter()->fetchAll($select);
	}
}