<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Setting_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('xticket_setting', array('legend'=>Mage::helper('xticket')->__('Settings')));
	  $data =Mage::registry('xticket_settingdata');

      $fieldset->addField('answer_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Answer Subject'),
          'required'  => false,
          'name'      => 'answer_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('answer_msg', 'text', array(
          'label'     => Mage::helper('xticket')->__('Answer Message'),
          'required'  => false,
          'name'      => 'answer_msg',
          'style'		=> 'width: 600px',
      ));

      $fieldset->addField('rep_trans_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Representative Transfer Subject'),
          'required'  => false,
          'name'      => 'rep_trans_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('rep_trans_msg', 'text', array(
          'label'     => Mage::helper('xticket')->__('Representative Transfer Message'),
          'required'  => false,
          'name'      => 'rep_trans_msg',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('remove_tag', 'text', array(
          'label'     => Mage::helper('xticket')->__('Remove Tag'),
          'required'  => false,
          'name'      => 'remove_tag',
          'style'		=> 'width: 600px',
      ));
	  
      $fieldset->addField('ticket_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Ticket Subject'),
          'required'  => false,
          'name'      => 'ticket_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('ticket_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Ticket Message'),
          'required'  => false,
          'name'      => 'ticket_msg',
          'style'		=> 'width: 600px',
      ));
      
      /*
      $fieldset->addField('limit_subj', 'text', array(
          'label'     => Mage::helper('softicket')->__('Limit Subject'),
          'required'  => false,
          'name'      => 'limit_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('limit_msg', 'textarea', array(
          'label'     => Mage::helper('softicket')->__('Limit Message'),
          'required'  => false,
          'name'      => 'limit_msg',
          'style'		=> 'width: 600px',
      ));
	  */
      
      $fieldset->addField('alert_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Alert Subject'),
          'required'  => false,
          'name'      => 'alert_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('alert_msg', 'text', array(
          'label'     => Mage::helper('xticket')->__('Alert Message'),
          'required'  => false,
          'name'      => 'alert_msg',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('alert_email', 'text', array(
          'label'     => Mage::helper('xticket')->__('Alert Emails of Admins'),
          'required'  => false,
          'name'      => 'alert_email',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('alert_user', 'text', array(
          'label'     => Mage::helper('xticket')->__('Alert Emails of Users'),
          'required'  => false,
          'name'      => 'alert_user',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('alert_new', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Alert New'),
          'required'  => false,
          'name'      => 'alert_new',
          'style'		=> 'text-align:left;width: 20px',
          'checked'   => $data->getData('alert_new'),
          'value'   => 1,
      ));
      
      $fieldset->addField('message_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Message Subject'),
          'required'  => false,
          'name'      => 'message_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('message_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message Message'),
          'required'  => false,
          'name'      => 'message_msg',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('trans_subj', 'text', array(
          'label'     => Mage::helper('xticket')->__('Transfer Subject'),
          'required'  => false,
          'name'      => 'trans_subj',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('trans_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Transfer Message'),
          'required'  => false,
          'name'      => 'trans_msg',
          'style'		=> 'width: 600px',
      ));
      
      $fieldset->addField('root_url', 'text', array(
          'label'     => Mage::helper('xticket')->__('Root Url'),
          'required'  => false,
          'name'      => 'root_url',
          'style'		=> 'width: 300px',
      ));
      /*
      $fieldset->addField('mail_method', 'text', array(
          'label'     => Mage::helper('softicket')->__('Mail Method'),
          'required'  => false,
          'name'      => 'mail_method',
          'style'		=> 'width: 300px',
      ));*/
      
      $fieldset->addField('smtp_host', 'text', array(
          'label'     => Mage::helper('xticket')->__('Smtp Host'),
          'required'  => false,
          'name'      => 'smtp_host',
          'style'		=> 'width: 300px',
      ));
      
      $fieldset->addField('smtp_port', 'text', array(
          'label'     => Mage::helper('xticket')->__('Smtp Port'),
          'required'  => false,
          'name'      => 'smtp_port',
          'style'		=> 'width: 60px',
      ));
      
      $fieldset->addField('smtp_auth', 'checkbox', array(
          'label'     => Mage::helper('xticket')->__('Smtp Auth'),
          'required'  => false,
          'name'      => 'smtp_auth',
          'style'		=> 'text-align:left;width: 20px',
      	  'checked'   => $data->getData('smtp_auth'),
          'value'   => 1,
      ));
      
      $fieldset->addField('smtp_user', 'text', array(
          'label'     => Mage::helper('xticket')->__('Smtp User'),
          'required'  => false,
          'name'      => 'smtp_user',
          'style'		=> 'width: 150px',
      ));
      
      $fieldset->addField('smtp_pass', 'password', array(
          'label'     => Mage::helper('xticket')->__('Smtp Password'),
          'required'  => false,
          'name'      => 'smtp_pass',
          'style'		=> 'width: 150px',
      ));
      
      $fieldset->addField('sendmail_path', 'text', array(
          'label'     => Mage::helper('xticket')->__('Send Mail Path'),
          'required'  => false,
          'name'      => 'sendmail_path',
          'style'		=> 'width: 300px',
      ));
      
      if ( Mage::getSingleton('adminhtml/session')->getSofTicketSettingData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSofTicketSettingData());
          Mage::getSingleton('adminhtml/session')->getSofTicketSettingData(null);
      } elseif ( Mage::registry('xticket_settingdata') ) {
          $form->setValues(Mage::registry('xticket_settingdata')->getData());
      }
      return parent::_prepareForm();
  }
}