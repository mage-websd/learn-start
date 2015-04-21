<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 04/02/2015
 * Time: 13:56
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/*set email template new account, reset password*/
$config = Mage::getModel('core/config');
$config->saveConfig('customer/create_account/email_template','customer_create_account_email_template');
$config->saveConfig('customer/password/forgot_email_template','customer_password_forgot_email_template');

$installer->endSetup();