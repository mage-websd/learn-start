<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Model_System_Config_Source_Type
{

    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('adminhtml')->__('POP3')),
			array('value'=>2, 'label'=>Mage::helper('adminhtml')->__('IMAP')),
        );
    }

}
