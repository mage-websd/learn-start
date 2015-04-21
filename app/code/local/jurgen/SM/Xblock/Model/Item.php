<?php
class SM_Xblock_Model_Item extends Mage_Core_Model_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('xblock/item');
    }
    public function getContent() {
        $processor = Mage::getModel('core/email_template_filter');
        return nl2br($processor->filter($this->getData('content')));

    }

}
