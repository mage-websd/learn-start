<?php

class SM_Youtube_Block_Adminhtml_Youtube_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldSet = $form->addFieldset('form_form', array('legend'=>Mage::helper('sm_youtube')->__('Youtube information')));

        $fieldSet->addField('title', 'text', array(
            'label'     => Mage::helper('sm_youtube')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldSet->addField('active', 'select', array(
            'label'     => Mage::helper('sm_youtube')->__('Active'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'active',
            'options'   => array(
                '1' => Mage::helper('sm_youtube')->__('Yes'),
                '0' => Mage::helper('sm_youtube')->__('No'),
            ),
        ));

        $fieldSet->addField('link', 'text', array(
            'label'     => Mage::helper('sm_youtube')->__('Link'),
            'name'      => 'link',
        ));

        $fieldSet->addField('image', 'image', array(
            'label'     => Mage::helper('sm_youtube')->__('Image'),
            'name'      => 'image',
            'value'     => Mage::getBaseUrl().'image',
            'tabindex'  => 1,
        ));

        $fieldSet->addField('order', 'text', array(
            'label'     => Mage::helper('sm_youtube')->__('Order'),
            'name'      => 'order',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getWebData() ) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getWebData());
            Mage::getSingleton('adminhtml/session')->setWebData(null);
        } elseif ( Mage::registry('sm_youtube_data') ) {
            $form->setValues(Mage::registry('sm_youtube_data')->getData());
        }
        return parent::_prepareForm();
    }

}
