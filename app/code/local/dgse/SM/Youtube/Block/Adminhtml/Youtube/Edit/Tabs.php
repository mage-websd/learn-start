<?php

class SM_Youtube_Block_Adminhtml_Youtube_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('blog_tabs_form');
        $this->setDestElementId('edit_form'); // this should be same as the form id define above
        $this->setTitle(Mage::helper('sm_youtube')->__('Youtube Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('sm_youtube')->__('Youtube Basic'),
            'title'     => Mage::helper('sm_youtube')->__('Youtube Basic'),
            'content'   => $this->getLayout()->createBlock('sm_youtube/adminhtml_youtube_edit_tab_form')->toHtml()
        ));

        return parent::_beforeToHtml();
    }
}
