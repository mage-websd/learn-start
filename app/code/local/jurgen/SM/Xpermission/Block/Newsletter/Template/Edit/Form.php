<?php
class SM_Xpermission_Block_Newsletter_Template_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
    public function __construct() {
        parent::__construct();
    }
    public function getModel() {
        return Mage::registry('_current_template');
    }
    protected function _prepareForm() {
        $model  = $this->getModel();
        $form   = new Varien_Data_Form(array(
                        'id'        => 'edit_form',
                        'action'    => $this->getData('action'),
                        'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
                'legend'    => Mage::helper('newsletter')->__('Template Information'),
                'class'     => 'fieldset-wide'
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                    'name'      => 'id',
                    'value'     => $model->getId(),
            ));
        }
        if (Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $fieldset->addField('website_id', 'select', array(
                    'name'      => 'website_id',
                    'label'     => Mage::helper('adminhtml')->__('Website'),
                    'title'     => Mage::helper('adminhtml')->__('Website'),
                    'required'  => true,
                    'values'    => Mage::getSingleton('adminhtml/system_store')->getWebsiteValuesForForm(false),
                    'value'     => $model->getWebsiteId(),
            ));
        }

        $fieldset->addField('code', 'text', array(
                'name'      => 'code',
                'label'     => Mage::helper('newsletter')->__('Template Name'),
                'title'     => Mage::helper('newsletter')->__('Template Name'),
                'required'  => true,
                'value'     => $model->getTemplateCode(),
        ));

        $fieldset->addField('subject', 'text', array(
                'name'      => 'subject',
                'label'     => Mage::helper('newsletter')->__('Template Subject'),
                'title'     => Mage::helper('newsletter')->__('Template Subject'),
                'required'  => true,
                'value'     => $model->getTemplateSubject(),
        ));

        $fieldset->addField('sender_name', 'text', array(
                'name'      =>'sender_name',
                'label'     => Mage::helper('newsletter')->__('Sender Name'),
                'title'     => Mage::helper('newsletter')->__('Sender Name'),
                'required'  => true,
                'value'     => $model->getTemplateSenderName(),
        ));

        $fieldset->addField('sender_email', 'text', array(
                'name'      =>'sender_email',
                'label'     => Mage::helper('newsletter')->__('Sender Email'),
                'title'     => Mage::helper('newsletter')->__('Sender Email'),
                'class'     => 'validate-email',
                'required'  => true,
                'value'     => $model->getTemplateSenderEmail(),
        ));


        $widgetFilters = array('is_email_compatible' => 1);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
        if ($model->isPlain()) {
            $wysiwygConfig->setEnabled(false);
        }
        $fieldset->addField('text', 'editor', array(
                'name'      => 'text',
                'label'     => Mage::helper('newsletter')->__('Template Content'),
                'title'     => Mage::helper('newsletter')->__('Template Content'),
                'required'  => true,
                'state'     => 'html',
                'style'     => 'height:36em;',
                'value'     => $model->getTemplateText(),
                'config'    => $wysiwygConfig
        ));

        if (!$model->isPlain()) {
            $fieldset->addField('template_styles', 'textarea', array(
                    'name'          =>'styles',
                    'label'         => Mage::helper('newsletter')->__('Template Styles'),
                    'container_id'  => 'field_template_styles',
                    'value'         => $model->getTemplateStyles()
            ));
        }

        $form->setAction($this->getUrl('*/*/save'));
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
