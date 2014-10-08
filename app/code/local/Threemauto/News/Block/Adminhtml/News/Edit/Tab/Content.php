<?php
class Threemauto_News_Block_Adminhtml_News_Edit_Tab_Content extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        if (Mage::registry('news_data')) {
            $data = Mage::registry('news_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('news_news', array('legend' => Mage::helper('news')->__('More information')));

        /*
         * Editing the form field in wysiwyg editor.
         */

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
        $wysiwygConfig->addData(array('add_variables' => false,
            'add_widgets' => true,
            'add_images' => true,
            'directives_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive'),
            'directives_url_quoted' => preg_quote(Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive')),
            'widget_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index'),
            'files_browser_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
            'files_browser_window_width' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width'),
            'files_browser_window_height' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height')
        ));


        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('news')->__('Description'),
            'title' => Mage::helper('news')->__('Description'),
            'style' => 'width:800px; height:500px;',
            'config' => $wysiwygConfig,
            'required' => false,
            'wysiwyg' => true
        ));

        $form->setValues($data);
    }
}