<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<p>If you are unable to visit our multiple DFW locations in person you can send us your valuables in an easy-to-use, insured mailer by visiting our sister company&nbsp;<a title="American Gold &amp; Silver Exchange" href="http://www.americangoldandsilverexchange.com/" target="_blank">American Gold &amp; Silver Exchange</a>.</p>
EOT;

Mage::getModel('cms/block')->load('sell-footer-company', 'identifier')->setContent($content)->save();
$installer->endSetup();