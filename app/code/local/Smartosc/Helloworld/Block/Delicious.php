<?php

class Smartosc_Helloworld_Block_Delicious extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        $pageTitle = '';
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $pageTitle = $headBlock->getTitle();
        }
        $html = '<a class="delicious" href="'
            . 'http://del.icio.us/post?url='
            . $this ->getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true))
            . '" onclick="window.open(\'http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url=\'+encodeURIComponent(\''
            . $this ->getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true))
            . "')+'&amp;title='+encodeURIComponent('"
            . $pageTitle
            . "'),'delicious', 'toolbar=no,width=700,height=400'); return false;"
            . '" title="Add to del.icio.us">Del.icio.us</a>';
        return $html;
}
}