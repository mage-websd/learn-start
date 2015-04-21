<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giga
 * Date: 2/27/14
 * Time: 1:36 PM
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

Mage::register('isSecureArea', true);
$invoiceId = Mage::getModel("sales/order_invoice")->loadByIncrementId(3300142)->getId();
$invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);

$orderID = $invoice->getOrderId();
$order = Mage::getModel('sales/order')->load($orderID);
$invoices = $order->getInvoiceCollection();
foreach ($invoices as $inv) {
    $inv->delete();
}

$installer->endSetup();