<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Cat_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('cat_form_detail', array('legend'=>Mage::helper('xticket')->__('Department details')));

	  $fieldset->addField('is_active', 'select', array(
          'name'  	=> 'is_active',
          'label' 	=> Mage::helper('xticket')->__('Active'),
          'title' 	=> Mage::helper('xticket')->__('Active'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),							
      ));
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('xticket')->__('Store View'),
                'title'     => Mage::helper('xticket')->__('Store View'),
                'required'  => true,
                'style'     => 'width:250px',
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
	  $fieldset->addField('protocol', 'select', array(
          'name'  	=> 'protocol',
          'label' 	=> Mage::helper('xticket')->__('Gateway Options'),
          'title' 	=> Mage::helper('xticket')->__('Gateway Options'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'POP3' => Mage::helper('xticket')->__('POP3'), 
		  						'IMAP' => Mage::helper('xticket')->__('IMAP')),							
      ));
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('xticket')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
		  'after_element_html' => '<span class="hint">Title will be used at customer area</span>',
      ));
      
	  /*
	  * Email setting general
	  */
	  $fieldset = $form->addFieldset('cat_form_email', array(
			'legend' => Mage::helper('xticket')->__('Email settings general'),
			'class'  => 'fieldset-wide',
	  ));	  
	  $fieldset->addField('notify', 'select', array(
          'name'  	=> 'notify',
          'label' 	=> Mage::helper('xticket')->__('Use email notifications'),
          'title' 	=> Mage::helper('xticket')->__('Use email notifications'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),							
      ));
      $fieldset->addField('email', 'text', array(
          'label'     => Mage::helper('xticket')->__('Email'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'email',
		  'after_element_html' => '<span class="hint">Emails to department will be sent to this address</span>',	
      ));	  
	  
      $fieldset->addField('popuser', 'text', array(
          'label'     => Mage::helper('xticket')->__('User'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'popuser',
      ));
      
      $fieldset->addField('poppass', 'password', array(
          'label'     => Mage::helper('xticket')->__('Password'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'poppass',
      ));
     	  
	  
//	  $fieldset->addField('sender', 'select', array(
//          'name'  	=> 'sender',
//          'label' 	=> Mage::helper('xticket')->__('Sender'),
//          'title' 	=> Mage::helper('xticket')->__('Sender'),
//          'class' 	=> 'input-select',
//          'style'		=> 'width: 250px',
//          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
//		  						'1' => Mage::helper('xticket')->__('Yes')),							
//      ));
	  /*
	  * Email Incomming
	  */
	  $fieldset = $form->addFieldset('cat_form_email_incomming', array(
			'legend' => Mage::helper('xticket')->__('Email incomming settings'),
			'class'  => 'fieldset-wide',
	  ));	
     $fieldset->addField('pophost', 'text', array(
          'label'     => Mage::helper('xticket')->__('Host'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'pophost',
      ));
     $fieldset->addField('popport', 'text', array(
          'label'     => Mage::helper('xticket')->__('Port'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'popport',
      ));
	  $fieldset->addField('ssl', 'select', array(
          'name'  	=> 'ssl',
          'label' 	=> Mage::helper('xticket')->__('Use SSL/TLS'),
          'title' 	=> Mage::helper('xticket')->__('Use SSL/TLS'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'' => Mage::helper('xticket')->__('None'), 
		  						'SSL' => Mage::helper('xticket')->__('SSL'),
								'TSL' => Mage::helper('xticket')->__('TSL')),							
      ));	        	  
	  /*
	  * Email Outgoing
	  */
	  $fieldset = $form->addFieldset('cat_form_email_outgoing', array(
			'legend' => Mage::helper('xticket')->__('Email outgoing settings'),
			'class'  => 'fieldset-wide',
	  ));	
     $fieldset->addField('out_pophost', 'text', array(
          'label'     => Mage::helper('xticket')->__('Host'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'out_pophost',
      ));
     $fieldset->addField('out_popport', 'text', array(
          'label'     => Mage::helper('xticket')->__('Port'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'out_popport',
      ));
	  $fieldset->addField('out_ssl', 'select', array(
          'name'  	=> 'out_ssl',
          'label' 	=> Mage::helper('xticket')->__('Use SSL/TLS'),
          'title' 	=> Mage::helper('xticket')->__('Use SSL/TLS'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'' => Mage::helper('xticket')->__('None'), 
		  						'SSL' => Mage::helper('xticket')->__('SSL'),
								'TSL' => Mage::helper('xticket')->__('TSL')),							
      ));	
	  $fieldset->addField('is_smtp', 'select', array(
          'name'  	=> 'is_smtp',
          'label' 	=> Mage::helper('xticket')->__('Use SMTP'),
          'title' 	=> Mage::helper('xticket')->__('Use SMTP'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),							
      ));	    	  
	  /*
	  * Email setting template
	  */
	  $fieldset = $form->addFieldset('cat_form_email_template', array(
			'legend' => Mage::helper('xticket')->__('Email templates'),
			'class'  => 'fieldset-wide',
	  ));	  
	  $fieldset->addField('to_admin_new_email', 'select', array(
          'name'  	=> 'to_admin_new_email',
          'label' 	=> Mage::helper('xticket')->__('New Ticket Admin Template'),
          'title' 	=> Mage::helper('xticket')->__('New Ticket Admin Template'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about new ticket to department</span>',												
      ));
	  $fieldset->addField('to_admin_reply_email', 'select', array(
          'name'  	=> 'to_admin_reply_email',
          'label' 	=> Mage::helper('xticket')->__('Ticket Reply Admin Template'),
          'title' 	=> Mage::helper('xticket')->__('Ticket Reply Admin Template'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about reply in ticket to department</span>',												
      ));
	  $fieldset->addField('to_customer_new_email', 'select', array(
          'name'  	=> 'to_customer_new_email',
          'label' 	=> Mage::helper('xticket')->__('New Ticket Customer Template'),
          'title' 	=> Mage::helper('xticket')->__('New Ticket Customer Template'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about new ticket to customer</span>',												
      ));
	  $fieldset->addField('new_from_admin_to_customer', 'select', array(
          'name'  	=> 'new_from_admin_to_customer',
          'label' 	=> Mage::helper('xticket')->__('New Ticket Customer Template(initiated by admin)'),
          'title' 	=> Mage::helper('xticket')->__('New Ticket Customer Template(initiated by admin)'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about new ticket to customer when admin creates ticket</span>',												
      ));
	  $fieldset->addField('to_customer_reply_email', 'select', array(
          'name'  	=> 'to_customer_reply_email',
          'label' 	=> Mage::helper('xticket')->__('Ticket Reply Customer Template'),
          'title' 	=> Mage::helper('xticket')->__('Ticket Reply Customer Template'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about reply in ticket to customer</span>',												
      ));
	  $fieldset->addField('to_admin_reassign_email', 'select', array(
          'name'  	=> 'to_admin_reassign_email',
          'label' 	=> Mage::helper('xticket')->__('Ticket Reassign Template'),
          'title' 	=> Mage::helper('xticket')->__('Ticket Reassign Template'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array(	'0' => Mage::helper('xticket')->__('No'), 
		  						'1' => Mage::helper('xticket')->__('Yes')),	
		  'after_element_html' => '<span class="hint">This email template will be used to sent notification about ticket reassignation</span>',												
      ));
 

/*      $fieldset->addField('signature', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Signature'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'signature',
      	 'style'		=> 'width: 600px',
      ));
		
      $fieldset->addField('hidden', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Hidden'),
          'name'      => 'hidden',
      ));
	  
	  $fieldset->addField('reply_method', 'select', array(
          'name'  	=> 'reply_method',
          'label' 	=> Mage::helper('xticket')->__('Reply Method'),
          'title' 	=> Mage::helper('xticket')->__('Reply Method'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array('url' => Mage::helper('softicket')->__('Send URL to load ticket'), 'message' => Mage::helper('softicket')->__('Show message in email')),
      ));*/

	  
      if ( Mage::getSingleton('adminhtml/session')->getCatData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCatData());
          Mage::getSingleton('adminhtml/session')->setCatData(null);
      } elseif ( Mage::registry('cat_data') ) {
          $form->setValues(Mage::registry('cat_data')->getData());
      }
      return parent::_prepareForm();
  }
}