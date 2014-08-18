<?php

/**
 * Class Smartosc_Converturl_Block_Addtext
 * @ insert text in block
 */
class Smartosc_Converturl_Block_Addtext extends Mage_Core_Block_Template
{
    private $_addText = null; //text display - string
    private $_option = null; // option style text - array

    /**
     * setText(): set text and option
     *
     * @param $addText
     * @param null $option
     */
    public function setText($addText,$option=null)
    {
        $this->_addText = $addText;
        $this->_option = $option;
    }

    /**
     * getText(): return text with option
     *
     * @return null|string
     */
    public function getText()
    {
        //if text null, return null
        if(!$this->_addText)
            return null;

        //if option null or not array, return text
        if(!$this->_option || !is_array($this->_option))
            return $this->_addText;

        // else, return text with style option
        $option = '';
        foreach($this->_option as $key => $value) {
            $option .= "{$key}: {$value};";
        }
        $output = "<div style='{$option}'>{$this->_addText}</div>";
        return $output;
    }

    /**
     * _toHtml(): auto print text
     */
    protected function _toHtml()
    {
        if(!$this->getText())
            return '';
        return $this->getText();
    }
}