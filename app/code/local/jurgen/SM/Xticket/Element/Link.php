<?php

class SM_Xticket_Element_Link extends Varien_Data_Form_Element_Abstract
{
//	public function __construct($attributes=array())
//    {
//        parent::__construct($attributes);
//        $this->setType('link');
//    }

    public function getElementHtml()
    {
//    	$html = $this->getBold() ? '<strong>' : '';
//    	$html.= $this->getEscapedValue();
//    	$html.= $this->getBold() ? '</strong>' : '';
//    	$html.= $this->getAfterElementHtml();
//    	return $html;
        $html = '<a href="">asdsads</a>';
print"<pre>"; print_r($this->getValue());
        if ($this->getValue()) {
            $url = $this->_getUrl();

            if( !preg_match("/^http\:\/\/|https\:\/\//", $url) ) {
                $url = Mage::getBaseUrl('media') . $url;
            }

            $html = ''.$this->getValue().' ';
        }
        $this->setClass('input-file');
        //$html.= parent::getElementHtml();

        return $html;
    }
    protected function _getUrl()
    {
        return $this->getValue();
    }

    public function getName()
    {
        return  $this->getData('name');
    }
}