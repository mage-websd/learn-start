<?php
class SM_Press_Block_Social extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('sm/social.phtml');
    }
}