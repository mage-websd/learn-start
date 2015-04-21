<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$cmsContent = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Bullion</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold &amp; Silver Exchange is one of the largest Precious Metals dealers in the United States. We buy and sell gold, silver, platinum, and palladium of all kinds. GOLD, SILVER, PLATINUM, and PALLADIUM prices are high. Call us at 972-484-3662 for daily quotes.</strong></span></p>
<p class="text_4"><strong>Here is a list of some of the most popular Gold, Silver, Platinum and Palladium products we purchase:</strong></p>
<ul>
<li class="text_4">American Gold Eagle</li>
<li class="text_4">American Silver Eagle</li>
<li class="text_4">American Platinum Eagle</li>
<li class="text_4">American Gold Buffalo</li>
<li class="text_4">Canadian Gold Maple Leaf</li>
<li class="text_4">Canadian Silver Maple Leaf</li>
<li class="text_4">South African Gold Krugerrand</li>
<li class="text_4">Mexican Gold Pesos</li>
<li class="text_4">Credit Suisse Gold Bars</li>
<li class="text_4">20 French Gold Francs</li>
<li class="text_4">Gold Coins</li>
<li class="text_4">Silver Coins</li>
<li class="text_4">Platinum Coins</li>
<li class="text_4">Palladium Coins</li>
<li class="text_4">Gold Bars</li>
<li class="text_4">Silver Bars</li>
<li class="text_4">Platinum Coins</li>
<li class="text_4">Platinum Bars</li>
<li class="text_4">Palladium Coins</li>
<li class="text_4">Palladium Bars</li>
<li class="text_4">Kilo Bars</li>
<li class="text_4">Gold, Silver and Platinum Coins from all foreign Countries</li>
<li class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
<p>&nbsp;</p>
EOT;

$cmsPage = Mage::getModel('cms/page');
$cmsPage->load('sell-bullion', 'identifier')->setContent($cmsContent)->save();

$installer->endSetup();