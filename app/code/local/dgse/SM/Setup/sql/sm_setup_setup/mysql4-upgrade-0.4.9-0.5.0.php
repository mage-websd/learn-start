<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOT
<p style="text-align: justify;">As a promotional offer, all orders placed on DGSE.com or CGDEInc.com will be shipped at no cost to you via UPS Overnight.&nbsp; The offer of free shipping may change at any time at DGSE&rsquo;s sole discretion.&nbsp;</p>
<p style="text-align: justify;">For insurance reasons, a signature is required for UPS shipments of $1,000 or more, regardless of any signed waivers you may have with UPS.&nbsp; Your order will be shipped to you fully insured. We urge all customers to inspect your package for damage or tampering before receiving or signing for receipt.</p>
<p style="text-align: justify;">Most items may be returned within 30 days of the order date provided that the item is received by DGSE in the same condition in which it was shipped to you.&nbsp;</p>
<p style="text-align: justify;">Bullion, Rare Coins, Currency and items that derive 90% or more of their value based their precious metal content may not be returned.&nbsp; All sales of these items are final.</p>
<p style="text-align: justify;">For more information please contact a Internet Sales Manager at <a href="mailto:info@DGSE.com">info@DGSE.com</a> or 972.481.3800.</p>
EOT;

Mage::getModel('cms/block')->load('shipping_return', 'identifier')->setContent($content)->save();
$installer->endSetup();