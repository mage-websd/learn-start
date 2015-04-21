<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 07/10/2014
 * Time: 10:07
 * To change this template use File | Settings | File Templates.
 */

class SM_Locations_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function _construct()
    {
        parent::_construct();
        $this->setId('location_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Manage location');
    }

    protected function _beforeToHtml()
    {
        $model = Mage::registry('sm_locations');

        $this->addTab('location_form', array(
            'label' => 'location Information',
            'title' => 'location Information',
            'content' => $this->getLayout()->createBlock('sm_locations/adminhtml_location_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
