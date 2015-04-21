<?php
/**
 * @category   SmartOSC
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */
 
class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Category extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('categories_fieldset_display', array('legend'=>Mage::helper('xblock')->__('Categories')));
              
        $fieldset->addField('category_id', 'text', array(
            'name'      => 'categories',
            'label'     => Mage::helper('xblock')->__('Categories ID'),
            'after_element_html' => '<span class="hint">(Ex: 1, 3, 5)</span>',
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
