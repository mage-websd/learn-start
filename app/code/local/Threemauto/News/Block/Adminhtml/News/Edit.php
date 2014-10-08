<?php
class Threemauto_News_Block_Adminhtml_News_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'news';
        $this->_controller = 'adminhtml_news';
        $this->_mode = 'edit';
        $this->_updateButton('save', 'label', Mage::helper('news')->__('Save News'));
        $this->_updateButton('delete', 'label', Mage::helper('news')->__('Delete'));
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('news')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    /*
     * This function is responsible for Including TincyMCE in Head.
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        }
    }


    public function getHeaderText() {
        if (Mage::registry('news_data') && Mage::registry('news_data')->getId()) {
            return Mage::helper('news')->__('Edit News "%s"', $this->htmlEscape(Mage::registry('news_data')->getTitle()));
        } else {
            return Mage::helper('news')->__('New News');
        }
    }
}