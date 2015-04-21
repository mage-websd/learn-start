<?php
/**
 * @category   SmartOSC
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */

class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Schedule extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('schedule_fieldset_display', array('legend'=>Mage::helper('xblock')->__('Display Block')));
              
        $fieldset->addField('from_date', 'date', array(
            'name'      => 'from_date',
            'label'     => Mage::helper('xblock')->__('From Date'),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset->addField('to_date', 'date', array(
            'name'      => 'to_date',
            'label'     => Mage::helper('xblock')->__('To Date'),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset = $form->addFieldset('schedule_fieldset_partent', array(
            'legend' => Mage::helper('xblock')->__('Schedule Partent'),
            'class'  => 'fieldset-wide',
        ));
        
        $fieldset->addField('show', 'select', array(
            'label'     => Mage::helper('xblock')->__('Show'),
            'title'     => Mage::helper('xblock')->__('Show'),
            'name'      => 'show',
            'required'  => false,
            'options'   => array(
                '1' => Mage::helper('xblock')->__('From Monday To Friday')
            ),
        )); 
        $fieldset->addField('from_time', 'text', array(
            'name'      => 'from_time',
            'label'     => Mage::helper('xblock')->__('From Time'),
            'after_element_html' => '<span class="hint">(As Hours:minutes:seconds)</span>',
        ));

        $fieldset->addField('to_time', 'text', array(
            'name'      => 'to_time',
            'label'     => Mage::helper('xblock')->__('To Time'),
            'after_element_html' => '<span class="hint">(As Hours:minutes:seconds)</span>', 
        )); 
        

        
        if ( Mage::getSingleton('adminhtml/session')->getxblockData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getxblockData());
            Mage::getSingleton('adminhtml/session')->setxblockData(null);
            } elseif ( Mage::registry('xblock_data') ) 
            {
                $form->setValues(Mage::registry('xblock_data')->getData());
            }
            return parent::_prepareForm();
        }
            
 
}
