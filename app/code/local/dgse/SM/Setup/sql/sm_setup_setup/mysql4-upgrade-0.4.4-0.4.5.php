<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOT
<p style="margin-top:30px;"><span style="font-size: medium;"><strong>Our apologies, this link appears to be broken. <a href="mailto:info@dgse.com">Please click here to report this error</a></strong></span></p>
EOT;

Mage::getModel('cms/page')->load('no-route', 'identifier')->setContent($content)->save();
$installer->endSetup();