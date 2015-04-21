<?php
class SM_Xpurchase_CustomerController extends Mage_Adminhtml_Controller_Action
{

    protected function _initCustomer($idFieldName = 'id')
    {
        $customerId = (int) $this->getRequest()->getParam($idFieldName);
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);
        return $this;
    }
    /**
     * Purchased products grid
     *
     */
    public function purchasesAction() {
        $this->_initCustomer();
        $this->getResponse()->setBody($this->getLayout()->createBlock('xpurchase/customer_edit_tab_purchases')->toHtml());
    }
}