<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Edit_Tab_Additional extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('xticket_form_additional', 
										array('legend'=>Mage::helper('xticket')->__('Additional Information')));		
		$fieldset->addField('ID', 'label', array(
							'label'     => Mage::helper('xticket')->__('Ticket ID'),
							'id'      => 'ID',
							'name'      => 'ID',
		));
		$fieldset->addField('email', 'label', array(
							'label'     => Mage::helper('xticket')->__('Assigned to customer'),
		));
		$fieldset->addField('hidden_email', 'hidden', array(
							'label'     => Mage::helper('xticket')->__('Email'),
							'id'      => 'hidden_email',
							'name'      => 'hidden_email',
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