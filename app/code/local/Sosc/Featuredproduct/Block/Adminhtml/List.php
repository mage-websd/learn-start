<?php
class Sosc_Featuredproduct_Block_Adminhtml_List extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for grid containers, parent constructor must be called last - not good design

        $this->_controller = 'adminhtml_List'; # this is the common prefix in the second part of the grouped class name, i.e. whatever/(this_bit)
        $this->_blockGroup = 'featuredproduct'; # the first part of the grouped class name, i.e. (some_module)/whatever
        $this->_headerText = Mage::helper('featuredproduct')->__('Featured product'); # sets the name in the header
        //$this->_addButtonLabel = Mage::helper('featuredproduct')->__('Save Featured product'); # sets the text for the add button
        $this->_removeButton('add');
        /*$this->_addButton('save',array(
            'label'     =>'Save',
            'onclick'   =>'location.href=\''.$this->getUrl('edit').'\'',
            'class'     =>'save',
        ));*/
    }

    /**
     * Header CSS class
     *
     * Used to set the icon next to the header text, not at all needed but a
     * nice touch. Look at all the headers to see the available icons, or make
     * your own by omitting this and making a CSS rule for .head-adminhtml-thing
     *
     * @return string The CSS class
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-page';
    }

    /*protected function _prepareLayout()
    {
        $this->setChild('store_switcher', $this->getLayout()->createBlock('adminhtml/store_switcher', 'store_switcher')->setUseConfirm(false));
        return parent::_prepareLayout();
    }*/
}
