<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Xticket_Edit_Tab_NewGeneral extends Mage_Adminhtml_Block_Widget_Form
{

	public function __construct()
	{                     
//		$this->_controller = 'adminhtml_xticket';
//		$this->_blockGroup = 'xticket';
		parent::__construct();		
		$this->setTemplate('sm_xticket/newform.phtml');
	}	
	
	protected function _prepareForm()
	{
		$this->setChild('load_button',
			$this->getLayout()->createBlock('adminhtml/widget_button')
				->setData(
					array(
						'label'   => Mage::helper('adminhtml')->__('Load Template'),
						'onclick' => 'templateControl.load();',
						'type'    => 'button',
						'class'   => 'save'
					)
				)
		);
		
		$this->setChild('form',
			$this->getLayout()->createBlock('xticket/adminhtml_xticket_edit_tab_general_newform')
		);	  
	  return parent::_prepareLayout();
	  //return parent::_prepareForm();
	}
	
	public function getLoadButtonHtml()
	{
		return $this->getChildHtml('load_button');
	}  

//    public function getEmailTemplate()
//    {
//        return Mage::registry('email_template');
//    }
//
//    public function getLocaleOptions()
//    {
//        return Mage::app()->getLocale()->getOptionLocales();
//    }
//
//    public function getTemplateOptions()
//    {
//        return Mage_Core_Model_Email_Template::getDefaultTemplatesAsOptionsArray();
//    }
//
//    public function getCurrentLocale()
//    {
//        return Mage::app()->getLocale()->getLocaleCode();
//    }
//
    public function getFormHtml()
    {
        return $this->getChildHtml('form');
    }
	
    /**
     * Load template url
     *
     * @return string
     */
    public function getLoadUrl()
    {
        return $this->getUrl('*/*/defaultTemplate');
    }
	
//	public function getRepresantatives() {
//		$reps=Mage::registry('xticket_represantatives');
//		$return_array=array();
//		foreach ($reps as $key=>$val){
//			$name=$val->getData('name');
//			$return_array[$key]= $name;
//		}
//		array_unshift($return_array,'');
//		return $return_array;
//	}
//	
//	public function getCategories() {
//		$model = Mage::getResourceModel('xticket/cats');
//		$return_array=array();
//		foreach ($model->getDepartmentActive() as $key=>$val){
//			$name=$val['name'].'&nbsp;&lt;'.$val['email'].'&gt;&nbsp;';
//			$return_array[$key]= $name;
//		}
//		return $return_array;
//	}
//	public function getTemplates() {
//		//$cats=Mage::registry('xticket_templates');
//		$model = Mage::getResourceModel('xticket/templates');
//		$return_array=array();
//		foreach ($model->getTemplateActive() as $key=>$val){
//			$name=$val['name'];
//			$return_array[$key]= $name;
//		}
//		return $return_array;
//	}
}