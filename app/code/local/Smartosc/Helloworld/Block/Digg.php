<?php

class Smartosc_Helloworld_Block_Digg extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        return '<a class="digg" href="http://www.digg.com/submit?url='
        . $this ->getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true))
    . '&amp;phase=2" title="You Digg?">You Digg?</a>';
    }
}