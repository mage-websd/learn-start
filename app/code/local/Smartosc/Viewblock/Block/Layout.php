<?php
class Smartosc_Viewblock_Block_Layout extends
    Mage_Core_Block_Template
{
    private $_titlePage = null;
    public function getTitlePage()
    {
        return $this->_titlePage;
    }
    public function setTitlePage($titlePage)
    {
        $this->_titlePage = $titlePage;
    }
}