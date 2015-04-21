<?php
class SM_Youtube_Block_Adminhtml_Youtube_Render_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $itemName = $row->getImage();
        $val = str_replace("no_selection", "", $itemName);
        if(!empty($val))
        {
            $url = Mage::getBaseUrl('media').$val;
        }
        else
        {
            $url = Mage::getBaseUrl('media').'sm/megamenu/no-icon.jpg';
        }
        $image = "<img src=". $url ." width='60px' height='50px' title='".$val."'/>";
        return $image;
    }
}