<?php
class Threemauto_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        if (Mage::registry('news_data')) {
            $data = Mage::registry('news_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('news_news', array('legend' => Mage::helper('news')->__('news information')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('news')->__('News Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

        /*$fieldset->addField('tag', 'text', array(
            'label' => Mage::helper('news')->__('Tag'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'tag',
        ));*/

        $form->setValues($data);

        return parent::_prepareForm();
    }
}