<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/*Shop Categories block*/
$content = <<<EOD
<div class="block block-shop collapse-parent">
<div class="block span4 collapse-block">
<div class="block-title collapse-title">Buy</div>
<div class="block-content collapse-content">
<ul>
<li><a href="{{store direct_url="jewelry-20.html"}}">Jewelry</a></li>
<li><a href="{{store direct_url="watches-7.html"}}">Watches</a></li>
<li><a href="{{store direct_url=""}}rare-coins/currency">Rare Coins &amp; Currency</a></li>
<li><a href="{{store direct_url="bullion"}}">Bullion</a></li>
<li><a href="{{store direct_url="collectibles"}}">Collectibles</a></li>
</ul>
</div>
</div>
<div class="block block-sell span4 collapse-block">
<div class="block-title collapse-title">Sell</div>
<div class="block-content collapse-content">
<ul>
<li><a href="{{store direct_url="sell-jewelry"}}">Jewelry</a></li>
<li><a href="{{store direct_url="sell-watches"}}">Watches</a></li>
<li><a href="{{store direct_url="sell-rare-coins"}}">Rare Coins &amp; Currency</a></li>
<li><a href="{{store direct_url="sell-bullion"}}">Bullion</a></li>
<li><a href="{{store direct_url="sell-collectibles"}}">Collectibles</a></li>
</ul>
</div>
</div>
<div class="block block-about span4 collapse-block">
<div class="block-title collapse-title">About</div>
<div class="block-content collapse-content">
<ul>
<li><a href="{{store direct_url="overview"}}">Overview</a></li>
<li><a href="{{store direct_url="leadership"}}">Leadership</a></li>
<li><a href="http://dgsecompanies.com" target="_blank">DGSE Companies</a></li>
<li><a href="{{store direct_url="press"}}">Press</a></li>
<li><a href="{{store direct_url="extras"}}">Extras</a></li>
</ul>
</div>
</div>
</div>
EOD;
$block = Mage::getModel('cms/block')->load('position-10');
if($block->getId()){
    $block->setContent($content)->save();
}
$installer->endSetup();