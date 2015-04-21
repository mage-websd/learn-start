<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Mail_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('xticket_mail', array('legend'=>Mage::helper('xticket')->__('New Ticket Reply').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('xticket')->__('Message sent when a new ticket is opened')));
	  $data =Mage::registry('xticket_maildata');
        
      $fieldset->addField('ticket_response', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Enable'),
          'title' 	  => Mage::helper('xticket')->__('Enable'),
          'name'      => 'ticket_response',
      	  'id'        => 'ticket_response',
          'value'     => 1,
      	  'checked'   => $data->getData('ticket_response')
      ));
      
      $fieldset->addField('ticket_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'ticket_subj',
      ));

      $fieldset->addField('ticket_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'ticket_msg',
	  ));
		


	  $fieldset = $form->addFieldset('xticket_newmessagereply', array('legend'=>Mage::helper('xticket')->__('New Message Reply').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('xticket')->__('Message sent everytime a reply is made to a ticket.')));
      
      $fieldset->addField('message_response', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Enable'),
          'required'  => false,
          'name'      => 'message_response',
          'value'     => 1,
          'checked'   => $data->getData('message_response')
      ));
      
      $fieldset->addField('message_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'message_subj',
      ));

      $fieldset->addField('message_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'message_msg',
	  ));

	  
	  /*
	  $fieldset = $form->addFieldset('softicket_ticketlimitreply', array('legend'=>Mage::helper('softicket')->__('Ticket Limit Reply').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('softicket')->__('Message sent when a user has reached the max allowed opened tickets defined in preferences.')));
      
      $fieldset->addField('limit_response', 'checkbox', array(
          'label'     => Mage::helper('softicket')->__('Enable'),
          'required'  => false,
          'name'      => 'limit_response',
          'value'     => 1,
          'checked'   => $data->getData('limit_response')
      ));
      
      $fieldset->addField('limit_subj', 'text', array(
          'label'     => Mage::helper('softicket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'limit_subj',
      ));

      $fieldset->addField('limit_msg', 'textarea', array(
          'label'     => Mage::helper('softicket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'limit_msg',
	  ));
		
	  */
	  
	  $fieldset = $form->addFieldset('xticket_categorytransfernotification', array('legend'=>Mage::helper('xticket')->__('Department Transfer Notification').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('xticket')->__('Message sent when a message has been transfered to a different department.')));
      
      $fieldset->addField('trans_response', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Enable'),
          'required'  => false,
          'name'      => 'trans_response',
          'value'     => 1,
          'checked'   => $data->getData('trans_response')
      ));
      
      $fieldset->addField('trans_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'trans_subj',
      ));

      $fieldset->addField('trans_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'trans_msg',
	  ));
		
	  
	  
	   /*
	  $fieldset = $form->addFieldset('softicket_emailalert', array('legend'=>Mage::helper('softicket')->__('Email Alert').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('softicket')->__('Message sent when the system has received a new message.')));
      $fieldset->addField('alert_new', 'checkbox', array(
          'label'     => Mage::helper('softicket')->__('Enable'),
          'required'  => false,
          'name'      => 'alert_new',
          'value'   => 1,
          'checked'   => $data->getData('alert_new')
      ));

      $fieldset->addField('alert_user', 'text', array(
          'label'     => Mage::helper('softicket')->__('User'),
          'required'  => false,
          'name'      => 'alert_user',
      ));
      
      $fieldset->addField('alert_email', 'text', array(
          'label'     => Mage::helper('softicket')->__('Addresses to Email'),
          'required'  => false,
          'name'      => 'alert_email',
      ));
      
      $fieldset->addField('alert_subj', 'text', array(
          'label'     => Mage::helper('softicket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'alert_subj',
      ));

      $fieldset->addField('alert_msg', 'textarea', array(
          'label'     => Mage::helper('softicket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'alert_msg',
	  ));
	  */
	  

	  
	  $fieldset = $form->addFieldset('xticket_answermessage', array('legend'=>Mage::helper('xticket')->__('Answer Message').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('xticket')->__('Message sent when answering a ticket, changing it is not recommended.')));
      
      $fieldset->addField('answer_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'answer_subj',
      ));

      $fieldset->addField('answer_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'answer_msg',
	  ));
	  
	  
	  $fieldset = $form->addFieldset('xticket_transresponse', array('legend'=>Mage::helper('xticket')->__('Representative Transfer Notification').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('xticket')->__('Message sent when a ticket has been transfered to a different representative.')));
      $fieldset->addField('rep_trans_response', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Enable'),
          'required'  => false,
          'name'      => 'rep_trans_response',
          'value'   => 1,
          'checked'   => $data->getData('rep_trans_response')
      ));
      
      $fieldset->addField('rep_trans_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'rep_trans_subj',
      ));

      $fieldset->addField('rep_trans_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'rep_trans_msg',
	  ));
	  
	  
	  	  
	  /*$fieldset = $form->addFieldset('softicket_antispam', array('legend'=>Mage::helper('softicket')->__('AntiSpam').'&nbsp;&nbsp;&nbsp;: '.Mage::helper('softicket')->__('Antispam (perl pipe automail only, using the banlist)  
	  If a user is detected as spam by the banlist, they can over-ride the banlist by replying with the MAGIC WORD in the email body.(Do not take out {MAGICWORD} from the message, it gets replaced with the real word automatically) 
	(It is recommended you use a non-existing email address at your domain for the email address) ')));

      $fieldset->addField('antispam_magicword', 'text', array(
          'label'     => Mage::helper('softicket')->__('AntiSpam Magicword'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'antispam_magicword',
      ));
      
      $fieldset->addField('antispam_subj', 'text', array(
          'label'     => Mage::helper('softicket')->__('Subject'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'antispam_subj',
      ));

      $fieldset->addField('antispam_msg', 'textarea', array(
          'label'     => Mage::helper('softicket')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'antispam_msg',
	  ));
	  
	  $fieldset->addField('antispam_email', 'text', array(
          'label'     => Mage::helper('softicket')->__('From Email'),
          'required'  => false,
          'name'      => 'antispam_email',
	  ));*/
	  
	  

	  
      if ( Mage::getSingleton('adminhtml/session')->getSofTicketMailData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSofTicketMailData());
          Mage::getSingleton('adminhtml/session')->setSofTicketMailData(null);
      } elseif ( Mage::registry('xticket_maildata') ) {
          $form->setValues(Mage::registry('xticket_maildata')->getData());
      }
      return parent::_prepareForm();
  }
}