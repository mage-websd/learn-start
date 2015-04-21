<?php

class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item_Form extends Mage_Adminhtml_Block_Widget_Form
{
//  protected function _prepareForm()
//  {   
//      $form = new Varien_Data_Form(array(
//                                      'id' => 'edit_form',
//                                      'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
//                                      'method' => 'post',
//                                   )
//      );

//      $form->setUseContainer(true);
//      $this->setForm($form);
//      return parent::_prepareForm();
//  }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('content_fieldset_display', array('legend'=>Mage::helper('xblock')->__('Content Item Information')));
        
        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('xblock')->__('Title'),
        ));
        
        $fieldset->addField('is_active', 'select', array(
        'label'     => Mage::helper('xblock')->__('Status'),
        'name'      => 'is_active',
        'values'    => array(
          array(
              'value'     => 1,
              'label'     => Mage::helper('xblock')->__('Enabled'),
          ),
        
          array(
              'value'     => 2,
              'label'     => Mage::helper('xblock')->__('Disabled'),
          ),
        ),
        ));
        
        $fieldset->addField('sort_order', 'text', array(
            'name'      => 'sort_order',
            'label'     => Mage::helper('xblock')->__('Sort Order'),
        ));
        
        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('xblock')->__('Content'),
            'required'  => true,
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
