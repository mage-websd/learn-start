<?php

class SM_Xticket_Model_XTicket extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xticket/xticket');
    }
	public function getListTicket() {
		$resource = Mage::getSingleton('core/resource');
		$read= $resource->getConnection('core_read');
		$xticketTable = $resource->getTableName('sm_ticket_tickets');	
		$select = $read->select()
			->from( array('xticket' =>$xticketTable),array('ID','code','email','subject','status','timestamp', 'cat', 'priority', 'is_lock', 'order_incremental_id', 'quick_template','note' ))
			->join(array('ea' => 'sm_ticket_categories'), 'ea.ID = `xt`.cat')
			;
		return $read->fetchAll($select);
	}
    public function getAllTickets($customerId){

    	$customer = Mage::getModel('customer/customer');
    	if ($customerId) {
    		$customer->load($customerId);
    		$email = $customer->getEmail();
    		
    		// Get xtickets for this customer with the email...
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$xticketTable = $resource->getTableName('sm_ticket_tickets');
			
			$select = $read->select()
			   ->from($xticketTable,array('ID','code','email','subject','status','timestamp', 'cat', 'priority', 'is_lock', 'order_incremental_id', 'quick_template','note' ))
			   ->where('email='."'".$email."'")
			   ->order('timestamp DESC') ;
			return $read->fetchAll($select);
    	}
    	return array();
    }

    
     //save and load methods
	public function save() {

		$resource = Mage::getSingleton('core/resource');
		$connection= $resource->getConnection('xticket_write');
		$connection->beginTransaction();

		try {
			$this->_beforeSave();
			if ($this->getID()==0)
				$this->setID(Mage::helper('xticket')->getTicketID());
				
			$query= 'insert into sm_ticket_tickets (ID, code, name, subject, cat, status, timestamp, created_time, priority, email, is_lock, order_incremental_id, quick_template, note) VALUES('
				."'".$this->getID()."',"
				."'".$this->getCode()."',"
				."'".$this->getName()."',"
				."'".$this->getSubject()."',"
				."'".$this->getCat()."',"
				."'".$this->getStatus()."',"
				//."'".$this->getPhone()."',"
				."'".$this->getTimestamp()."',"
				."'".$this->getCreatedTime()."',"
				."'".$this->getPriority()."',"
				."'".$this->getEmail()."',"
				."'".$this->getIsLock()."',"
				."'".$this->getOrderIncrementalId()."',"
				."'".$this->getQuickTemplate()."',"
				."'".$this->getNote()."')";
				//echo $this->getStatus().'<br>';
				//echo $query; die('model here');
				$connection->query($query);

				$connection->commit();
				$this->_afterSave();
		}
		catch (Exception $e) {
			Mage::log('Exception:'.$e);
			$connection->rollBack();
			throw $e;
		}
		return $this;
	}
	
	public function update() {
		parent::save();
	}

}