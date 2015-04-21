<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Xticket_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    public function __construct() {
//		$this->_controller = 'adminhtml_xticket';
//		$this->_blockGroup = 'xticket';
        parent::__construct();
        $this->setTemplate('sm_xticket/form.phtml');
    }

    protected function _prepareForm() {
        $form = new Varien_Data_Form();

        $this->setForm($form);
        $fieldset = $form->addFieldset('xticket_form', array('legend'=>Mage::helper('xticket')->__('Ticket Options')));
        $fieldset->addField('status', 'select', array(
                'name'  	=> 'status',
                'label' 	=> Mage::helper('xticket')->__('Set status to'),
                'id'    	=> 'status',
                'title' 	=> Mage::helper('xticket')->__('Set status to'),
                'class' 	=> 'required-entry',
                'style'		=> 'width: 250px',
                'required'  => false,
                'options'	=> array(
                        '1' => Mage::helper('xticket')->__('Open'),
                        '2' => Mage::helper('xticket')->__('Closed'),
                        '3' => Mage::helper('xticket')->__('Waiting for customer')),
        ));
        $fieldset->addField('priority', 'select', array(
                'name'  	=> 'priority',
                'label' 	=> Mage::helper('xticket')->__('Priority'),
                'id'    	=> 'priority',
                'title' 	=> Mage::helper('xticket')->__('Priority'),
                'class' 	=> 'input-select',
                'style'		=> 'width: 250px',
                'options'	=> array(	'1' => Mage::helper('xticket')->__('Urgent'),
                        '2' => Mage::helper('xticket')->__('ASAP'),
                        '3' => Mage::helper('xticket')->__('To do'),
                        '4' => Mage::helper('xticket')->__('If time'),
                        '5' => Mage::helper('xticket')->__('Postponed')),
        ));
        $fieldset->addField('is_sendmail', 'select', array(
                'name'  	=> 'is_sendmail',
                'label' 	=> Mage::helper('xticket')->__('Send Email'),
                'id'    	=> 'is_sendmail',
                'title' 	=> Mage::helper('xticket')->__('Send Email'),
                'class' 	=> 'required-entry',
                'style'		=> 'width: 250px',
                'required'  => false,
                'options'	=> array('1' => Mage::helper('xticket')->__('Yes'),
                        '0' => Mage::helper('xticket')->__('No')),
        ));
        $fieldset->addField('is_lock', 'select', array(
                'name'  	=> 'is_lock',
                'label' 	=> Mage::helper('xticket')->__('Locked'),
                'id'    	=> 'is_lock',
                'title' 	=> Mage::helper('xticket')->__('Locked'),
                'class' 	=> 'required-entry',
                'style'		=> 'width: 250px',
                'required'  => false,
                'options'	=> array(
                        '0' => Mage::helper('xticket')->__('No'),
                        '1' => Mage::helper('xticket')->__('Yes')),
        ));
        $fieldset->addField('email', 'text', array(
                'label'     => Mage::helper('xticket')->__('Assign to customer'),
                'id'      => 'email',
                'name'      => 'email',
                'class'     => 'required-entry',
                'style'		=> 'width: 250px',
                'required'  => true,
        ));
        $fieldset->addField('cat', 'select', array(
                'name'  	=> 'cat',
                'label' 	=> Mage::helper('xticket')->__('Assign to department'),
                'id'    	=> 'cat',
                'title' 	=> Mage::helper('xticket')->__('Assign to department'),
                'class' 	=> 'input-select',
                'style'	=> 'width: 250px',
                'required'  => false,
                'options'	=> $this->getCategories(),
        ));
        $fieldset->addField('order_incremental_id', 'text', array(
                'label'     => Mage::helper('xticket')->__('Assign to order #'),
                'id'      => 'order_incremental_id',
                'name'      => 'order_incremental_id',
                'class'     => 'input-select',
                'style'		=> 'width: 250px',
                'required'  => false,
        ));
        $fieldset->addField('quick_template', 'select', array(
                'name'  	=> 'quick_template',
                'label' 	=> Mage::helper('xticket')->__('Use template'),
                'id'    	=> 'quick_template',
                'title' 	=> Mage::helper('xticket')->__('Use template'),
                'class' 	=> 'input-select',
                'style'	=> 'width: 250px',
                'required'  => false,
                'options'	=> $this->getTemplates(),
        ));

        $fieldset->addField('email_fill', 'button', array(
                'label'     => Mage::helper('xticket')->__('Paste Template'),
                'id'      => 'email_fill',
                'name'      => 'email',
                'value' => 'Paste Template',
                'class'     => 'scalable',
        ));

        $fieldset = $form->addFieldset('xticket_form_ticket', array('legend'=>Mage::helper('xticket')->__('Reply')));
        $fieldset->addField('answer', 'textarea', array(
                'label'     => Mage::helper('xticket')->__('Message'),
                'required'  => false,
                'name'      => 'answer',
                'style'	=> 'width: 600px',
                'class'     => 'input-select',
                'required'  => false,
        ));
        $fieldset->addField('filename', 'file', array(
                'label'     => Mage::helper('xticket')->__('File(2 Mb)'),
                'required'  => false,
                'name'      => 'filename',
                'class'     => 'input-select',
                'required'  => false,
        ));
        $fieldset = $form->addFieldset('xticket_form_thread', array('legend'=>Mage::helper('xticket')->__('Ticket Thread')));
//	  $fieldset->addField('reply', 'label', array(
//		  'label'     => Mage::helper('xticket')->__('Message'),
//		  'required'  => false,
//		  'name'      => 'reply',
//		  'style'	=> 'width: 600px',
//		  'class'     => 'input-select',
//		  'required'  => false,
//	  )); 
        $fieldset->addType('thread', 'SM_Xticket_Element_Thread');
        $threadArray = array(	'label'     => Mage::helper('xticket')->__('Message'),
                'name'      => 'samplefilename',
                'content'     => Mage::registry('xticket_data')->getData('data_message'),
        );
        $fieldset->addField('samplefilename', 'thread',$threadArray);


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

        if ( Mage::getSingleton('adminhtml/session')->getSofTicketData() ) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSofTicketData());
            Mage::getSingleton('adminhtml/session')->setSofTicketData(null);
        } elseif ( Mage::registry('xticket_data') ) {
            $form->setValues(Mage::registry('xticket_data')->getData());
        }

//		$this->setChild('form',
//			$this->getLayout()->createBlock('adminhtml/xticket_edit_tab_form')
//		);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getLoadButtonHtml() {
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
    public function getFormHtml() {
        return $this->getChildHtml('form');
    }

    /**
     * Load template url
     *
     * @return string
     */
    public function getLoadUrl() {
        return $this->getUrl('*/*/defaultTemplate');
    }

    public function getRepresantatives() {
        $reps=Mage::registry('xticket_represantatives');
        $return_array=array();
        foreach ($reps as $key=>$val) {
            $name=$val->getData('name');
            $return_array[$key]= $name;
        }
        array_unshift($return_array,'');
        return $return_array;
    }

    public function getCategories() {
        $model = Mage::getResourceModel('xticket/cats');
        $return_array=array();
        foreach ($model->getDepartmentActive() as $key=>$val) {
            $name=$val['name'].'&nbsp;&lt;'.$val['email'].'&gt;&nbsp;';
            $return_array[$key]= $name;
        }
        return $return_array;
    }
    public function getTemplates() {
        //$cats=Mage::registry('xticket_templates');
        $model = Mage::getResourceModel('xticket/templates');
        $return_array=array();
        foreach ($model->getTemplateActive() as $key=>$val) {
            $name=$val['name'];
            $return_array[$key]= $name;
        }
        return $return_array;
    }
}