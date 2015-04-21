<?php
class SM_BlockHtmlCache_Model_Observer
{
    public function autoUpdateCache() {
        Mage::app()->getCacheInstance()->cleanType('block_html');
        return $this;
    }
}