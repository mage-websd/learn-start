<?php
class SM_Manufacturers_Block_Adminhtml_Manufacturers_Edit_Tab_Renderer_Position extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render (Varien_Object $row) {
        $value = $row->getData($this->getColumn()->getIndex());
        $html = $value;
        $html .= '<input type="text" class="input-text " name="position_'. $row->getId() .'" value="'. $value .'">';
        return $html;
    }

}