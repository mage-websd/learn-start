<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 07/10/2014
 * Time: 10:28
 * To change this template use File | Settings | File Templates.
 */

class SM_Locations_Block_Adminhtml_Location_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('sm_locations');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('location Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('location_id', 'hidden', array(
                'name' => 'location_id',
            ));
        }

        $fieldset->addField('location_title', 'text', array(
            'name'      => 'location_title',
            'label'     => $this->__('location Title'),
            'title'     => $this->__('location Title'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $fieldset->addField('location_page', 'text', array(
            'name'      => 'location_page',
            'label'     => $this->__('location Page'),
            'title'     => $this->__('location Page'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $fieldset->addField('location_email', 'text', array(
            'name'      => 'location_email',
            'label'     => $this->__('location Email'),
            'title'     => $this->__('location Email'),
            'required'  => true,
            'class'     => 'required-entry validate-email',
        ));

        $fieldset->addField('telephone', 'text', array(
            'name'      => 'telephone',
            'label'     => $this->__('Telephone'),
            'title'     => $this->__('Telephone'),
            'required'  => true,
        ));

        $fieldset->addField('location_content', 'textarea', array(
            'name'      => 'location_content',
            'label'     => $this->__('location Content'),
            'title'     => $this->__('location Content'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}