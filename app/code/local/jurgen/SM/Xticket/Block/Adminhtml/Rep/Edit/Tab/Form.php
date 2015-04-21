<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Rep_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{


  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('rep_form', array('legend'=>Mage::helper('xticket')->__('Edit Representative')));
      $fieldset->addField('name', 'hidden', array('name'      => 'name'));
      $fieldset->addField('email', 'hidden', array('email'      => 'email'));
      $fieldset->addField('username', 'hidden', array('username'      => 'username'));
      $fieldset->addField('password', 'hidden', array('password'      => 'password'));
      
      $fieldset->addField('lbl_name', 'label', array(
          'label'     => Mage::helper('xticket')->__('Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'lbl_name',
      ));
      
      $fieldset->addField('lbl_email', 'label', array(
          'label'     => Mage::helper('xticket')->__('Email'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'lbl_email',
      ));
      
      $fieldset->addField('lbl_username', 'label', array(
          'label'     => Mage::helper('xticket')->__('User Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'lbl_username',
      ));
      
      $fieldset->addField('lbl_password', 'label', array(
          'label'     => Mage::helper('xticket')->__('Password'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'lbl_password',
      ));

      $fieldset->addField('signature', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Signature'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'signature',
      	 'style'		=> 'width: 600px',
      ));

      if ( Mage::getSingleton('adminhtml/session')->getRepData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRepData());
          Mage::getSingleton('adminhtml/session')->setRepData(null);
      } elseif ( Mage::registry('rep_data') ) {
          $form->setValues(Mage::registry('rep_data')->getData());
      }
      return parent::_prepareForm();
  }
}