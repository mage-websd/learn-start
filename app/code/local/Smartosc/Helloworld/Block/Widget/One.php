<?php
class Smartosc_Helloworld_Block_Widget_One extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        return '<h1>GiangSoda WidgetOne </h1>';
    }
}