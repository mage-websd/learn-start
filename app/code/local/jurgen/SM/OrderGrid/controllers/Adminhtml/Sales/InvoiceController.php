<?php

/**
 * Change order status after order are printed
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @author      SMARTOSC
 */
require_once "Mage/Adminhtml/controllers/Sales/InvoiceController.php";

class SM_OrderGrid_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{
    /**
     * Print invoices for selected orders
     */
    public function printAction(){
        $invoiceId = $this->getRequest()->getParam('invoice_id');
        if(sizeof($invoiceId)){ 

            $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);
            //echo '<pre>'; print_r($invoice->getData()); die;
            if ($invoice) {
                //SMARTOSC ADD: change order status to packaging
                $this->changeOrderStatusAfterPrinted($invoice->getData('order_id'));
                //SMARTOSC END
            }
            $pdf = Mage::getModel('sales/order_pdf_invoice')->getPdf(array($invoice));
            
        } else {
            $this->_getSession()->addError($this->__('There are no printable documents related to this invoice'));
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }

    /**
     * UPDATE ORDER STATUS Packaging
     * @author SMARTOSC
     * @param int $orderId
     * @return change order status to 'Packaging'
     */
    private function changeOrderStatusAfterPrinted ($orderId = 0) {
        //echo $orderId; die('xxx');
    	try {
            //Load order
            $order = Mage::getModel('sales/order')->load($orderId);
            //Update order status to Packaging 
            $order->setState(SM_OrderGrid_Model_Sales_Order::STATE_PACKAGING, true)->save();
			
    	} catch (Exception $e) {
    		Mage::logException($e);
    	}
    }
    
}
