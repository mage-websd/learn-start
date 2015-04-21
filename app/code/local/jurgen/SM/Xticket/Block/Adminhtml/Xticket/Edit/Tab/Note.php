<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Edit_Tab_Note extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('xticket_form_note', array('legend'=>Mage::helper('xticket')->__('Notes')));

      $fieldset->addField('note', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Note'),
          'required'  => false,
          'name'      => 'note',
      	  'style'	=> 'width: 600px',
          'class'     => 'input-select',
          'required'  => false,
	  )); 
	  
      if ( Mage::getSingleton('adminhtml/session')->getSofTicketData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSofTicketData());
          Mage::getSingleton('adminhtml/session')->setSofTicketData(null);
      } elseif ( Mage::registry('xticket_data') ) {
          $form->setValues(Mage::registry('xticket_data')->getData());
      }
      return parent::_prepareForm();
  }
}