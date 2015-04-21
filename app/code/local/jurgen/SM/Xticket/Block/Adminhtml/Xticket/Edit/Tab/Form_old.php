<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Xticket_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('xticket_form', array('legend'=>Mage::helper('xticket')->__('Ticket Information')));
     
      $fieldset->addField('ID', 'label', array(
          'label'     => Mage::helper('xticket')->__('Ticket ID'),
          'id'      => 'ID',
      	  'name'      => 'ID',
      ));
      $fieldset->addField('hidden_ID', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Ticket ID'),
          'id'      => 'hidden_ID',
      	  'name'      => 'hidden_ID',
      ));
      
      $fieldset->addField('status', 'label', array(
		  'name'  	=> 'status',
          'label' 	=> Mage::helper('xticket')->__('Status'),
          'id'    	=> 'status',
          'title' 	=> Mage::helper('xticket')->__('Status'),
      ));
      $fieldset->addField('hidden_status', 'hidden', array(
		  'name'  	=> 'hidden_status',
          'label' 	=> Mage::helper('xticket')->__('Status'),
          'id'    	=> 'hidden_status',
          'title' 	=> Mage::helper('xticket')->__('Status'),
      ));
      
      $fieldset->addField('subject', 'label', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'id'      => 'subject',
      	  'name'      => 'subject',
	  ));
      $fieldset->addField('hidden_subject', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Subject'),
          'id'      => 'hidden_subject',
      	  'name'      => 'hidden_subject',
	  ));
	  
      $fieldset->addField('name', 'label', array(
          'label'     => Mage::helper('xticket')->__('Name'),
          'id'      => 'name',
      	  'name'      => 'name',
      ));
      $fieldset->addField('hidden_name', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Name'),
          'id'      => 'hidden_name',
      	  'name'      => 'hidden_name',
      ));
      
      $fieldset->addField('email', 'label', array(
          'label'     => Mage::helper('xticket')->__('Email'),
          'id'      => 'email',
      	  'name'      => 'email',
	  ));
      $fieldset->addField('hidden_email', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Email'),
          'id'      => 'hidden_email',
      	  'name'      => 'hidden_email',
	  ));
	  
	  $fieldset->addField('phone', 'label', array(
          'label'     => Mage::helper('xticket')->__('Phone'),
          'id'      => 'phone',
      	  'name'      => 'phone',
      ));
      $fieldset->addField('hidden_phone', 'hidden', array(
          'label'     => Mage::helper('xticket')->__('Phone'),
          'id'      => 'hidden_phone',
      	  'phone'      => 'hidden_phone',
      ));
      
	  $fieldset->addField('priority', 'select', array(
          'name'  	=> 'priority',
          'label' 	=> Mage::helper('xticket')->__('Priority'),
          'id'    	=> 'priority',
          'title' 	=> Mage::helper('xticket')->__('Priority'),
          'class' 	=> 'input-select',
          'style'		=> 'width: 250px',
          'options'	=> array('1' => Mage::helper('xticket')->__('Low'), '2' => Mage::helper('xticket')->__('Medium'), '3' => Mage::helper('xticket')->__('High')),
      ));
	  
      $fieldset->addField('rep', 'select', array(
          'name'  	=> 'rep',
          'label' 	=> Mage::helper('xticket')->__('Representative'),
          'id'    	=> 'rep',
          'title' 	=> Mage::helper('xticket')->__('Representative'),
          'class' 	=> 'input-select',
          'style'	=> 'width: 250px',
          'options'	=> $this->getRepresantatives(),
      ));
	  
      $fieldset->addField('rep_alert', 'checkbox', array(
          'name'  	=> 'rep_alert',
          'label' 	=> Mage::helper('xticket')->__('Rep Send Alert'),
          'id'    	=> 'rep_alert',
          'title' 	=> Mage::helper('xticket')->__('Rep Send Alert'),
          'value'   => 1,
      ));
      
      $fieldset->addField('cat', 'select', array(
          'name'  	=> 'cat',
          'label' 	=> Mage::helper('xticket')->__('Department'),
          'id'    	=> 'cat',
          'title' 	=> Mage::helper('xticket')->__('Department'),
          'class' 	=> 'input-select',
          'style'	=> 'width: 250px',
          'options'	=> $this->getCategories(),
      ));
      
      if ((Mage::registry('xticket_data')->getData('trans_note'))){
	      $fieldset->addField('trans_note', 'textarea', array(
	          'label'     => Mage::helper('xticket')->__('Transfer Note'),
	          'required'  => false,
	          'name'      => 'trans_note',
	          'style'	=> 'width: 600px; rows:5; background:#f2f2f2; height: 50px;',
	          'readonly'	=> 'readonly',
		  )); 
      }         
      $fieldset->addField('trans_msg', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Optional Department Message'),
          'required'  => false,
          'name'      => 'trans_msg',
          'style'	=> 'width: 600px; height: 60px;',
	  ));
      $fieldset->addField('cat_alert', 'checkbox', array(
          'name'  	=> 'cat_alert',
          'label' 	=> Mage::helper('xticket')->__('Department Send Alert'),
      	  'class' => 'attribute-checkbox',
      ));
      
      $fieldset->addField('message', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Message'),
          'required'  => false,
          'name'      => 'message',
      	  'class' 	=> 'input-select',
      	  'style'	=> 'width: 600px; background:#f2f2f2; height: 120px;',
      	  'readonly'	=> 'readonly',
	  ));
	  
	  $statuses= Mage::getSingleton('xticket/status');
	  
	  $fieldset->addField('new_status', 'select', array(
          'name'  	=> 'new_status',
          'label' 	=> Mage::helper('xticket')->__('New Status'),
          'id'    	=> 'new_status',
          'title' 	=> Mage::helper('xticket')->__('New Status'),
          'class' 	=> 'input-select',
          'style'	=> 'width: 150px',
          'options'	=> $statuses->getOptionArray(),
      ));
	  
      $fieldset->addField('answer', 'textarea', array(
          'label'     => Mage::helper('xticket')->__('Answer'),
          'required'  => false,
          'name'      => 'answer',
      	  'style'	=> 'width: 600px; height: 120px;',
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
  
  public function getRepresantatives() {

  	 $reps=Mage::registry('xticket_represantatives');
  	 $return_array=array();
  	 array_unshift($return_array,'');
  	 if ($reps)
 	 foreach ($reps as $key=>$val){
 	 	if ($val){
			$name=$val->getData('name');
			$return_array[$val->getData('ID')]= $name;
 	 	}
	}

	return $return_array;
  }
  
  public function getCategories() {
  	 $cats=Mage::registry('xticket_categories');
  	 $return_array=array();
  	 array_unshift($return_array,'');
  	 if ($cats)
 	 foreach ($cats as $key=>$val){
 	 	if ($val){
			$name=$val->getData('name');
			$return_array[$val->getData('ID')]= $name;
 	 	}
	}
	return $return_array;
  }

}
