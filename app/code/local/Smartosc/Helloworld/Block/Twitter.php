<?php

class Smartosc_Helloworld_Block_Twitter extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        $pageTitle = '';
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $pageTitle = $headBlock->getTitle();
        }
        $html = '<a title="Tweet about this page"'
            . ' href="http://twitter.com/home?status=Currently reading '
            . $pageTitle
            . ' at '
            . $this->getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true))
            . '" target="_blank">Tweet This!</a>';
        return $html;
    }
}