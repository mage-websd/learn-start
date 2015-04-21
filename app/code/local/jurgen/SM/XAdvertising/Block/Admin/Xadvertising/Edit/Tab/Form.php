<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * XAdvertising admin edit form block:
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
 
class SM_XAdvertising_Block_Admin_Xadvertising_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('xadvertising_form', array('legend'=>Mage::helper('xadvertising')->__('TV & Advertising information')));
		
		$fieldset->addField('title', 'text', array(
		  'label'     => Mage::helper('xadvertising')->__('Title'),
		  'class'     => '',
		  'required'  => false,
		  'name'      => 'title',
		));
		
		if (!Mage::app()->isSingleStoreMode()) {
			$fieldset->addField('store_id', 'multiselect', array(
						'name'      => 'stores[]',
						'label'     => Mage::helper('cms')->__('Store View'),
						'title'     => Mage::helper('cms')->__('Store View'),
						'required'  => true,
						'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
				));
		}
		else {
				$fieldset->addField('store_id', 'hidden', array(
						'name'      => 'stores[]',
						'value'     => Mage::app()->getStore(true)->getId()
				));
				// $model->setStoreId(Mage::app()->getStore(true)->getId());
		}



		$fieldset->addField('link', 'text', array(
		  'label'     => Mage::helper('xadvertising')->__('Link to redirect'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'link',
		  'class'     => 'validate-link',
		  'after_element_html' => '<br><span class="hint">(eg: http://yourwebsite.com/product/view/123/test.html)</span>',
		));
		
		$fieldset->addField('adv_content', 'editor', array(
                    'name'      => 'adv_content',
                    'label'     => Mage::helper('xadvertising')->__('Content'),
                    'title'     => Mage::helper('xadvertising')->__('Content'),
                    'style'     => 'width:400px; height:200px;',
                    'after_element_html' => '<div style="float:left;width:300px"><p><b>Dimensions: 746px x 239px</b></p><p>If content is code of flash video, please paste some code to your content:</p>' .
                    		'<p><b>1.</b> insert attributes in &lt;object&gt; tag  <font color="#fff" style="background-color:#000"> classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=
6,0,0,0"</font></p>' .
                    		'<p><b>2.</b> insert tag "param" into &lt;object&gt; tag <br> <font color="#fff" style="background-color:#000">&lt;param name="wmode" value="transparent"&gt;&lt;/param&gt;</font></p>' .
                    		'<p><b>3.</b> insert attribute in &lt;object&gt; tag<br> <font color="#fff" style="background-color:#000">wmode="transparent"</font></p>' .
                    		'</div>',
            
                ));

        $fieldset->addField('status', 'select', array(
                    'label'     => Mage::helper('xadvertising')->__('Enable'),
                    'name'      => 'status',
                    'values'    => array(
                          array(
                                  'value'     => 2,
                                  'label'     => Mage::helper('xadvertising')->__('No'),
                          ),

                          array(
                                  'value'     => 1,
                                  'label'     => Mage::helper('xadvertising')->__('Yes'),
                          ),
                    ),
                   'style'  => 'width: 50px',
		));
		
		 $fieldset->addField('orders', 'text', array(
                    'label'     => Mage::helper('xadvertising')->__('Orders'),
                    'name'      => 'orders',
                    'style'  => 'width: 50px',
		));

		
		$data = Mage::registry('xadvertising_data')->getData();
		if ( Mage::getSingleton('adminhtml/session')->getXadvertisingData() )
		{
		  $form->setValues(Mage::getSingleton('adminhtml/session')->getXadvertisingData());
		  Mage::getSingleton('adminhtml/session')->setXadvertisingData(null);
		} elseif ( Mage::registry('xadvertising_data') ) {
		  $form->setValues(Mage::registry('xadvertising_data')->getData());
		}

		$data['store_id'] = explode(',',$data['stores']);
		//var_dump($data['store_id']);die;
	  	$form->setValues($data);
		return parent::_prepareForm();
  }
}
