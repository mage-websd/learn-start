<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

require 'SM/Xticket/Helper/Ticket.php';

class SM_Xticket_IndexController extends Mage_Core_Controller_Front_Action
{
	
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (! $this->_getSession()->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

    public function indexAction()
    {
    	$xticketModel = Mage::getModel('xticket/xticket');
		$customerId= $this->_getSession()->getCustomerId();
		$xticket= $xticketModel->getAllTickets($customerId);
		Mage::register('xticket_all', $xticket, true);
		
    	if ((is_null($xticket) == false) && (empty($xticket) == false) ) {
	        $this->loadLayout();
	        $this->_initLayoutMessages('customer/session');
	        $this->renderLayout();
    	}
        else {
            $this->getResponse()->setRedirect(Mage::getUrl('*/*/add'));
        }
    }

    public function addAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
    	if ($navigationBlock = $this->getLayout()->getBlock('customer_account_navigation')) {
	            $navigationBlock->setActive('xticket');
	    }
        $this->renderLayout();
    }
    
    public function editAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
    	if ($navigationBlock = $this->getLayout()->getBlock('customer_account_navigation')) {
	            $navigationBlock->setActive('xticket');
	    }

        $this->renderLayout();
    }

    public function editPostAction()
    {
    	$data= $this->getRequest()->getPost();

    	if ($data && $data['ID'] && $data['ID'] >0 ) {
            try {
            	$repid=$data['rep'];
            	$id=$data['ID'];
            	$answer=$data['answer'];
            	$rep_name='';
		    	if ($repid>0){
		    		$reps  = Mage::getModel('xticket/reps')->load($repid);
			        $rep_name = $reps->getData('name');
		    	}

				$ticket = new Ticket();
		    	$ticket->postAnswer($answer, $repid, $rep_name, $id, 'custreplied');
		    	
		        $this->_getSession()->addSuccess($this->__('Ticket was successfully updated')); 
			    $this->_redirectSuccess(Mage::getUrl('*/*/', array('_secure'=>true, 'id'=>$id)));
			    return;
            }
            catch (Mage_Core_Exception $e) {
                $this->_getSession()->setxticketFormData($this->getRequest()->getPost())
                    ->addException($e, $e->getMessage());
            }
            catch (Exception $e) {
                $this->_getSession()->setxticketFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Ticket cannot be saved'));
            }
        }
        $this->_getSession()->addError($this->__('Ticket cannot be saved'));
		$this->_redirectError(Mage::getUrl('*/*/'));
    }

   
    public function addPostAction()
    {
    	$data= $this->getRequest()->getPost();
    	if ($data) {
            try {
		    	$ticket = new Ticket();
	    		$id=Mage::helper('xticket')->getTicketID();
				$ticket->id=$id;
				$ticket->code = $ticket->randStr();
				$ticket->message=$data['message'];
				$ticket->timestamp=now();
                $ticket->subject=$data['subject'];
				$ticket->name=$data['name'];
				$ticket->email=$data['email'];
				$ticket->priority=$data['priority'];
				$ticket->category=$data['cat'];
				$ticket->ip=$_SERVER['REMOTE_ADDR']; 	 	 	
				$ticket->phone=$data['phone'];
				$ticket->is_lock=$data['is_lock'];
				$ticket->order_incremental_id=$data['order_incremental_id'];
				$ticket->quick_template=$data['quick_template'];
				$ticket->note=$data['note'];
				//print"<pre>"; print_r($ticket->note); 
		    	if(!$ticket->create(false)){
					$this->_getSession()->addError($this->__('Ticket cannot be saved'));
					$this->_redirectError(Mage::getUrl('*/*/'));
					return;
				}else{
		        	$ticket->postMessage($id, $ticket->message, '', true, 'new');
					$model_department = Mage::getModel('xticket/cats')->load($data['cat']);
					$dataDepartment = $model_department->getData();	
					//print"<pre>"; print_r($dataDepartment); die;					
					$this->sendemailAction($dataDepartment['name'], $dataDepartment['email'], "#".$ticket->code.' - '.$data['name'], $data['email'], '', $data['message'], $dataDepartment['out_pophost'], $dataDepartment['out_ssl'], $dataDepartment['out_popport'], $dataDepartment['popuser'], $dataDepartment['poppass'], $dataDepartment['is_smtp']);		        	
					$this->_getSession()->addSuccess($this->__('Ticket was successfully saved')); 
		        	$this->_redirectSuccess(Mage::getUrl('*/*/', array('_secure'=>true)));
		        	return;
				} //die('3');
            }
            catch (Mage_Core_Exception $e) {
                $this->_getSession()->setxticketFormData($this->getRequest()->getPost())
                    ->addException($e, $e->getMessage());
            }
            catch (Exception $e) {
                $this->_getSession()->setxticketFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Ticket cannot be saved'));
            }
        }
        $this->_redirectError(Mage::getUrl('*/*/edit', array('id'=>$id)));
    }
    
     public function sendemailAction($name, $email, $mailsubj, $emailto, $nameto, $mailmsg, $mailserver, $ssl, $port, $username, $password, $is_smtp)
	 {
		$config = array('username' => $username,
						'password' => $password,
						'auth' => 'login',
						'ssl' => $ssl /*'SSL'*/,
						'port' => $port /*465*/); // Optional port number supplied		
		$transport = new Zend_Mail_Transport_Smtp($mailserver, $config);

 		$params = array();
		$params['email'] = $email; //'duytrinhit@gmail.com';
		$params['name'] = $name; //'doan duy trinh';
		$params['comment'] = $mailmsg; //'test send mail';
		$params['emailto'] = $emailto;
		$params['nameto'] = $nameto;
		$params['mailsubj'] = $mailsubj;
        $mail = new Zend_Mail('utf8');
        $mail->setBodyText($params['comment']);
        $mail->setFrom($params['email'], $params['name']);
        $mail->addTo($params['emailto'], $params['nameto']);
        $mail->setSubject($params['mailsubj']);
        try {
			if($is_smtp == 0) {
				$mail->send();			
			} else {
				$mail->send($transport);			
			}
        }        
        catch(Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email.');
 
        }
    }
	
}