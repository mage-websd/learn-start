<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$contentPage = <<<EOT
<p>{{block type="cms/block" block_id="bullion-notice"}}</p>
<table class="fondo_bullion" style="width: 100%;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center">
<div class="header_coin"><span id="ctl00_Content_Central_lblNameCoin" style="color: #7f6c31; font-size: 13pt; font-weight: bold;">Palladium Canadian Maple Leaf</span></div>
</td>
</tr>
<tr>
<td align="center"><img id="ctl00_Content_Central_ImgBullionCoin" style="border-width: 0px;" src="{{media url="wysiwyg/GetBullionImage_10_.jpg"}}" alt="Palladium Canadian Maple Leaf Coin" /></td>
</tr>
<tr>
<td>
<div class="text_description">
<div>In November 2005 the Royal Canadian Mint introduced the first palladium product, the Palladium Maple Leaf Coin. A single maple leaf appears on the reverse of this coin, which is the national symbol of Canada. A sculpture Queen Elizabeth II adorns the obverse.</div>
</div>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" height="62">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
EOT;
$contentBlock = <<<EOT
<div id="left_side">
<div id="menu_bullion" class="collapse-parent">
<div class="block collapse-block">
<div class="block-title collapse-title"><strong><span>REFINE SEARCH BY</span></strong></div>
<div class="block-content collapse-content">
<div id="submenu-menu-bullion-collapse" class="collapse-parent">
<div class="collapse-block">
<div class="collapse-title"><a id="ctl00_Content_Central_ListCatgories_ctrl0_lnkCategory" href="{{store url='Gold'}}">Gold</a></div>
<div class="collapse-content">
<ul class="coins_list">
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl0_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-American-Buffalo'}}">American Buffalo</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl1_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-American-Eagle'}}">American Eagle</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl2_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Canadian-Maple-Leaf'}}">Canadian Maple Leaf</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl3_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-South-African-Krugerrand'}}">S. African Krugerrand</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl4_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Australian-Kangaroo'}}">Australian Kangaroo</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl5_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Chinese-Panda'}}">Chinese Panda</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl6_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Mexican-50-Pesos'}}">Mexican 50 Pesos</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl7_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Austrian-Philharmonic'}}">Austrian Philharmonic</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl8_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Credit-Suisse-Bar'}}">Credit Suisse Bar</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl9_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-Austrian-Corona'}}">Austrian Corona</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl10_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-British-Sovereign'}}">British Sovereign</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl0_ListCoins_ctrl11_lnkCoin" class="op_menu_bullion" href="{{store url='Gold-20-Franc-French-Rooster'}}">French Rooster</a></li>
</ul>
</div>
</div>
<div class="collapse-block">
<div class="collapse-title"><a id="ctl00_Content_Central_ListCatgories_ctrl1_lnkCategory" href="{{store url='Silver'}}">Silver</a></div>
<div class="collapse-content">
<ul class="coins_list">
<li><a id="ctl00_Content_Central_ListCatgories_ctrl1_ListCoins_ctrl0_lnkCoin" class="op_menu_bullion" href="{{store url='Silver-American-Eagle'}}">American Eagle</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl1_ListCoins_ctrl1_lnkCoin" class="op_menu_bullion" href="{{store url='Pre-1965-Silver-Coins'}}">Pre 1965 Silver Coins</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl1_ListCoins_ctrl2_lnkCoin" class="op_menu_bullion" href="{{store url='Silver-Bars-and-Silver-Rounds'}}">Bars and Rounds</a></li>
</ul>
</div>
</div>
<div class="collapse-block">
<div class="collapse-title"><a id="ctl00_Content_Central_ListCatgories_ctrl2_lnkCategory" href="{{store url='Platinum'}}">Platinum</a></div>
<div class="collapse-content">
<ul class="coins_list">
<li><a id="ctl00_Content_Central_ListCatgories_ctrl2_ListCoins_ctrl0_lnkCoin" class="op_menu_bullion" href="{{store url='Platinum-American-Eagle'}}">American Eagle</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl2_ListCoins_ctrl1_lnkCoin" class="op_menu_bullion" href="{{store url='Platinum-Canadian-Maple-Leaf'}}">Canadian Maple Leaf</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl2_ListCoins_ctrl2_lnkCoin" class="op_menu_bullion" href="{{store url='Platinum-Australian-Koala'}}">Australian Koala</a></li>
<li><a id="ctl00_Content_Central_ListCatgories_ctrl2_ListCoins_ctrl3_lnkCoin" class="op_menu_bullion" href="{{store url='Platinum-Bars'}}">Bars</a></li>
</ul>
</div>
</div>
<div class="collapse-block">
<div class="collapse-title"><a id="ctl00_Content_Central_ListCatgories_ctrl3_lnkCategory" href="{{store url='Palladium'}}">Palladium</a></div>
<div class="collapse-content">
<ul class="coins_list">
<li><a id="ctl00_Content_Central_ListCatgories_ctrl3_ListCoins_ctrl0_lnkCoin" class="op_menu_bullion" href="{{store url='Palladium-Canadian-Maple-Leaf'}}">Canadian Maple Leaf</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
EOT;

Mage::getModel('cms/page')->load('palladiumplatinum-canadian-maple-leaf', 'identifier')
    ->setTitle('Palladium Canadian Maple Leaf')
    ->setContent($contentPage)
    ->setIdentifier('palladium-canadian-maple-leaf')
    ->save();
Mage::getModel('cms/block')->load('cms-column-left', 'identifier')
    ->setContent($contentBlock)
    ->save();

$pageAddContent = <<<EOT
{{block type="cms/block" block_id="bullion-notice"}}
EOT;
$gold = Mage::getModel('cms/page')->load('gold', 'identifier');
$gold->setContent($pageAddContent.$gold->getContent())->save();
$silver = Mage::getModel('cms/page')->load('silver', 'identifier');
$silver->setContent($pageAddContent.$silver->getContent())->save();
$platinum = Mage::getModel('cms/page')->load('platinum', 'identifier');
$platinum->setContent($pageAddContent.$platinum->getContent())->save();
$palladium = Mage::getModel('cms/page')->load('palladium', 'identifier');
$palladium->setContent($pageAddContent.$palladium->getContent())->save();
$installer->endSetup();