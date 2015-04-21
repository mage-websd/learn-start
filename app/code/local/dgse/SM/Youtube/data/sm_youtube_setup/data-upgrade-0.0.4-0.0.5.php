<?php

$installer = $this;
$installer->startSetup();

$block = Mage::getModel('cms/block')->load('position-10');

$content = <<<EOD
<div class="block block-shop span4">
<div class="block-title">Buy</div>
<div class="block-content">
<ul>
<li><a href="{{store direct_url="jewelry-20.html"}}">Jewelry</a></li>
<li><a href="{{store direct_url="watches-7.html"}}">Watches</a></li>
<li><a href="{{store direct_url="rare-coins/rare-coins-currency.html"}}">Rare Coins &amp; Currency</a></li>
<li><a href="{{store direct_url="bullion"}}">Bullion</a></li>
<li><a href="{{store direct_url="collectibles"}}">Collectibles</a></li>
</ul>
</div>
</div>
<div class="block block-sell span4">
<div class="block-title">Sell</div>
<div class="block-content">
<ul>
<li><a href="{{store direct_url="sell-jewelry"}}">Jewelry</a></li>
<li><a href="{{store direct_url="sell-watches"}}">Watches</a></li>
<li><a href="{{store direct_url="sell-rare-coins"}}">Rare Coins &amp; Currency</a></li>
<li><a href="{{store direct_url="sell-bullion"}}">Bullion</a></li>
<li><a href="{{store direct_url="sell-collectibles"}}">Collectibles</a></li>
</ul>
</div>
</div>
<div class="block block-about span4">
<div class="block-title">About</div>
<div class="block-content">
<ul>
<li><a href="{{store direct_url="overview"}}">Overview</a></li>
<li><a href="{{store direct_url="leadership"}}">Leadership</a></li>
<li><a href="http://dgsecompanies.com">DGSE Companies</a></li>
<li><a href="{{store direct_url="press"}}">Press</a></li>
<li><a href="{{store direct_url="extras"}}">Extras</a></li>
</ul>
</div>
</div>
EOD;

$data = array(
    'title' => 'Shop Categories',
    'identifier' => 'position-10',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);

if($block->getId()) {
    $block->setContent($content);
}else{
    $block->setData($data);
}
$block->save();

$installer->endSetup();

