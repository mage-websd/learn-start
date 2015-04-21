<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Template_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('template_form_detail', array('legend'=>Mage::helper('xticket')->__('Template details')));

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
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
        $fieldset->addField('name', 'text', array(
                'label'     => Mage::helper('xticket')->__('Title'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'name',
                'after_element_html' => '<span class="hint">Service name of template</span>',
        ));

        $fieldset->addField('content', 'textarea', array(
                'label'     => Mage::helper('xticket')->__('Content'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'content',
                'style'		=> 'width: 600px',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getRepData() ) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getRepData());
            Mage::getSingleton('adminhtml/session')->setRepData(null);
        } elseif ( Mage::registry('template_data') ) {
            $form->setValues(Mage::registry('template_data')->getData());
        }
        return parent::_prepareForm();
    }
}