<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
//change cotent block left bar product
$content = '
<ul class="payment">
<li><a href="https://www.facebook.com/dgsecompanies" target="_blank"><img src="{{skin url="images/social/facebook.png"}}" alt="" /></a></li>
<li><a href="https://twitter.com/dgsecompanies" target="_blank"><img src="{{skin url="images/social/twitter.png"}}" alt="" /></a></li>
<li><a href="https://www.pinterest.com/DGSEInc/" target="_blank"><img src="{{skin url="images/social/pinterest.png"}}" alt="" /></a></li>
<li><a href="https://instagram.com/dallasgoldandsilver/" target="_blank"><img src="{{skin url="images/social/instagram.png"}}" alt="" /></a></li>
</ul>
<ul class="payment">
<li><span class="visa" title="Visa">Visa</span></li>
<li><span class="mastercard" title="Master Card">Master Card</span></li>
<li><span class="discover" title="Discover">Discover</span></li>
<li><span class="paypal" title="paypal">Paypal</span></li>
<li><span class="amex" title="Amex">Amex</span></li>
</ul>
<ul class="payment" id="secure-logo">
<li><img src="{{skin url="images/comodo-secure.png"}}" alt="" /></li>
</ul>
';
$block = Mage::getModel('cms/block')->load('position-12');
$block->setContent($content);
if (!$block->getId()) {
    $block->setTitle('Payment methods');
    $block->setIdentifier('position-12');
    $block->setStores(array(0));
    $block->setIsActive(1);
}
$block->save();
$installer->endSetup();