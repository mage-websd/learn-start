<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-L.txt
 *
 * @category   AW
 * @package    AW_Blog
 * @copyright  Copyright (c) 2008-2009 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-L.txt
 */

class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
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
        $fieldset = $form->addFieldset('schedule_fieldset_display', array('legend'=>Mage::helper('xblock')->__('Content Item Information')));
        $fieldset->addField('block_id', 'hidden', array('name'      => 'block_id'));
        $fieldset->addField('title_item', 'text', array(
            'name'      => 'title_item',
            'label'     => Mage::helper('xblock')->__('Title'),
        ));
        
        $fieldset->addField('is_active_item', 'select', array(
        'label'     => Mage::helper('xblock')->__('Status'),
        'name'      => 'is_active_item',
        'values'    => array(
          array(
              'value'     => 1,
              'label'     => Mage::helper('xblock')->__('Enabled'),
          ),
        
          array(
              'value'     => 0,
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
