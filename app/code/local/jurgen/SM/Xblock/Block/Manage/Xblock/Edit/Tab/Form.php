<?php
/**
 * @category   SmartOSC
 * @package    SM_Xblock
 * @copyright  Copyright (c) SmartOSC
 */

class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('xblock_form', array('legend'=>Mage::helper('xblock')->__('Block information')));
		
		$fieldset->addField('title', 'text', array(
		  'label'     => Mage::helper('xblock')->__('Title'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'title',
		));
	  
	  	/**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('xblock')->__('Store View'),
                'title'     => Mage::helper('xblock')->__('Store View'),
                'required'  => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
		
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
		  
//		  array(
//			  'value'     => 3,
//			  'label'     => Mage::helper('xblock')->__('Hidden'),
//		  ),
		),
		'after_element_html' => '<span class="hint">(Hidden Pages will not show in the blog but can still be accessed directly)</span>',
		));
		
        $fieldset->addField('default_position', 'select', array(
            'name'      => 'default_position',
            'label'     => Mage::helper('xblock')->__('Block Position'),
            'title'     => Mage::helper('xblock')->__('Block Position'),
            'required'  => true,
            'class'     => 'validate-xml-identifier',
            'options'   => array(
                'sidebar-right-top' => Mage::helper('xblock')->__('Sidebar Right Top'),
                'sidebar-right-bottom' => Mage::helper('xblock')->__('Sidebar Right Bottom'),
                'sidebar-left-top' => Mage::helper('xblock')->__('Sidebar Left Top'),
                'sidebar-left-bottom' => Mage::helper('xblock')->__('Sidebar Left Bottom'),
                'content-top' => Mage::helper('xblock')->__('Content Top'),
                'menu-top' => Mage::helper('xblock')->__('Menu Top'),
                'menu-bottom' => Mage::helper('xblock')->__('Menu Bottom'),
                'page-bottom' => Mage::helper('xblock')->__('Page Bottom'),
                'catalog-sidebar-right-top' => Mage::helper('xblock')->__('Only Catalog Sidebar Right Top'),
                'catalog-sidebar-right-bottom' => Mage::helper('xblock')->__('Only Catalog Sidebar Right Bottom'),
                'catalog-sidebar-left-top' => Mage::helper('xblock')->__('Only Catalog Sidebar Left Top'),
                'catalog-sidebar-left-bottom' => Mage::helper('xblock')->__('Only Catalog Sidebar Left Bottom'),
                'catalog-content-top' => Mage::helper('xblock')->__('Only Catalog Content Top'),
                'catalog-menu-top' => Mage::helper('xblock')->__('Only Catalog Menu Top'),
                'catalog-menu-bottom' => Mage::helper('xblock')->__('Only Catalog Menu Bottom'),
                'catalog-page-bottom' => Mage::helper('xblock')->__('Only Catalog Page Bottom'),
 //               'product-sidebar-right-top' => Mage::helper('xblock')->__('Only Product Sidebar Right Top'),
//                'product-sidebar-right-bottom' => Mage::helper('xblock')->__('Only Product Sidebar Right Bottom'),
//                'product-sidebar-left-top' => Mage::helper('xblock')->__('Only Product Sidebar Left Top'),
//                'product-content-top' => Mage::helper('xblock')->__('Only Product Content Top'),
//                'product-menu-top' => Mage::helper('xblock')->__('Only Product Menu Top'),
//                'product-menu-bottom' => Mage::helper('xblock')->__('Only Product Menu Bottom'),
//                'product-page-bottom' => Mage::helper('xblock')->__('Only Product Page Bottom'),
//                'product-sidebar-left-bottom' => Mage::helper('xblock')->__('Only Product Sidebar Left Bottom'),
//                'customer-menu-bottom' => Mage::helper('xblock')->__('Only Customer Content Top'),
//                'cart-content-top' => Mage::helper('xblock')->__('Only Cart Content Top'),
            ),
        ));

        $fieldset->addField('mode', 'select', array(
            'label'     => Mage::helper('xblock')->__('Mode'),
            'title'     => Mage::helper('xblock')->__('Mode'),
            'name'      => 'mode',
            'options'   => array(
                'show_all' => Mage::helper('xblock')->__('Show All'),
                'rotate_one_by_one' => Mage::helper('xblock')->__('Rotate One-By-One'),      
                'show_random' => Mage::helper('xblock')->__('Show Random'),
            ),
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label'     => Mage::helper('xblock')->__('Sort Order'),
            'title'     => Mage::helper('xblock')->__('Order'),
            'name'      => 'sort_order',
        ));
        
		if ( Mage::getSingleton('adminhtml/session')->getBlogData() )
		{
		  $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
		  Mage::getSingleton('adminhtml/session')->setBlogData(null);
		} elseif ( Mage::registry('xblock_data') ) {
		  $form->setValues(Mage::registry('xblock_data')->getData());
		}
		return parent::_prepareForm();
  }
}
