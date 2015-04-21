<?php
/**
 * Created by PhpStorm.
 * User: GiangSoda
 * Date: 10/6/14
 * Time: 3:54 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup
        Create block content sell
 */
$installer = $this;
$installer->startSetup();

$templateTransaction = Mage::getModel('core/email_template')
    ->load('Sell email template','template_code');
$content = '
<h1>Email request to seller</h1>
<br/>
<b>Email:</b> {{var email_sell}}<br/>
<br/>
<b>Name:</b> {{var name_sell}}<br/>
<br/>
<b>Phone:</b> {{var phone_sell}}<br/>
<br/>
<b>Message:</b> {{var message_sell}}<br/>
';
$templateTransaction->setTemplateText($content);
if(!$templateTransaction->getTemplateId()) {
    $templateTransaction->setData('template_code','Sell email template')
        ->setData('template_subject','DGSE.com: sell request');
}
$templateTransaction->save();

$installer->endSetup();