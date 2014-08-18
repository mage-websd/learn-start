<?php
/**
 * install script Mage_Customer_Model_Entity_Setup
 *
 * add attibute customer_type,logo, paypal_account
 */
$installer = $this;
$installer->startSetup();

//cutomer_type option select
$installer->addAttribute('customer', 'customer_type', array(
    'label'         => 'Customor Type',
    'type'          => 'varchar',
    'input'         => 'select',
    'source'        => 'sm_vendor/resource_vendor_attribute_unit',
    'visible'       => true,
    'required'      => true,
));

$installer->addAttribute('customer', 'logo', array(
    'label'         => 'Logo',
    'type'          => 'varchar',
    'input'         => 'text',
    'visible'       => true,
    'required'      => false,
));

$installer->addAttribute('customer', 'paypal_account', array(
    'label'         => 'Paypal Account',
    'type'          => 'varchar',
    'input'         => 'text',
    'visible'       => true,
    'required'      => false,
));
$installer->endSetup();

/*
 * $eavConfig = Mage::getSingleton('eav/config');

    $attributeCustomerType = $eavConfig->getAttribute('customer', 'vendor_customer_type');
    $attributeCustomerType->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'));
    $attributeCustomerType->save();

    $attributeVendorName = $eavConfig->getAttribute('customer', 'vendor_name');
    $attributeVendorName->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'));
    $attributeVendorName->save();

    $attributeVendorLogo = $eavConfig->getAttribute('customer', 'vendor_logo');
    $attributeVendorLogo->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'));
    $attributeVendorLogo->save();
    $attributeVendorPaypal = $eavConfig->getAttribute('customer', 'vendor_paypal');
    $attributeVendorPaypal->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'));
    $attributeVendorPaypal->save();

    $installer->endSetup();
    210
 */