<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Bullion</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold &amp; Silver Exchange is one of the largest Precious Metals dealers in the United States. We buy and sell gold, silver, platinum, and palladium of all kinds. GOLD, SILVER, PLATINUM, and PALLADIUM prices are high. Call us at&nbsp;<span class="skype_c2c_print_container notranslate">972-484-3662</span><span id="skype_c2c_container" class="skype_c2c_container notranslate" dir="ltr" data-numbertocall="+19724843662" data-isfreecall="false" data-isrtl="false" data-ismobile="false"><span class="skype_c2c_highlighting_inactive_common" dir="ltr"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img class="skype_c2c_logo_img" src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/call_skype_logo.png" alt="" width="0" height="0" /></span></span></span>&nbsp;for daily quotes.</strong></span></p>
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
Mage::getModel('cms/page')->load('sell-bullion', 'identifier')->setContent($content)->save();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Collectibles</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">&nbsp;
<p class="text_4">Dallas Gold &amp; Silver Exchange purchases all types of vintage and modern collectibles &ndash; mainly focusing on sports, historical and political memorabilia in nature.&nbsp; However, other collectibles such as antiques and toys are also desired. There are few dealers in the Metroplex that have both the knowledge and the willingness to pay top dollar for these types of items.&nbsp; We conduct this type of business on a daily basis. Dallas Gold &amp; Silver Exchange has an A+ Better Business Bureau rating as well as being a publicly traded company (NYSEMKT: DGSE). No appointments are necessary.</p>
<p class="text_4">Please stop by any of our seven (7) locations in the DFW Metroplex.</p>
<p class="text_4">We will be happy to assist you any way.</p>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
<p>&nbsp;</p>
EOT;
Mage::getModel('cms/page')->load('sell-collectibles', 'identifier')->setContent($content)->save();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Jewelry</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold &amp; Silver Exchange always needs to purchase fine jewelry for use at our nationwide jewelry stores. Our expert appraisers will evaluate your items individually to ensure that the highest quality items bring the highest payouts.</strong></span></p>
<div style="float: left; margin: 0; padding: 0;">
<ul>
<li class="text_4">Men's Diamond Rings</li>
<li class="text_4">Ladies Diamond Rings</li>
<li class="text_4">Necklaces</li>
<li class="text_4">Diamond Pendants</li>
<li class="text_4">Wedding Rings</li>
<li class="text_4">Wedding Bands</li>
<li class="text_4">Anniversary Rings</li>
<li class="text_4">Diamond Eternity Bands</li>
<li class="text_4">Diamond Waterfall Rings</li>
<li class="text_4">Ring Sets</li>
<li class="text_4">Antique Rings</li>
<li class="text_4">Diamond Earrings</li>
<li class="text_4">Diamond Bracelets</li>
<li class="text_4">Tennis Bracelets</li>
<li class="text_4">Masonic Rings</li>
<li class="text_4">Designer Rings</li>
<li class="text_4">Cartier</li>
</ul>
</div>
<div style="float: left; margin: 0; padding: 0;">
<ul>
<li class="text_4">Harry Winston</li>
<li class="text_4">Tiffany &amp; Company</li>
<li class="text_4">Mikimoto</li>
<li class="text_4">Van Cleef</li>
<li class="text_4">Hammerman</li>
<li class="text_4">Ripka</li>
<li class="text_4">Graff</li>
<li class="text_4">David Yurman</li>
<li class="text_4">Baccarat</li>
<li class="text_4">John Hardy</li>
<li class="text_4">Paul Morelli</li>
<li class="text_4">Fabrikant</li>
<li class="text_4">David Webb</li>
<li class="text_4">Buccellati</li>
<li class="text_4">Bvlgari</li>
<li class="text_4">Seaman Shepps</li>
<li class="text_4">Much More&hellip;</li>
</ul>
</div>
<div style="clear: left;">&nbsp;</div>
<div class="text_4">If you are unable to visit our multiple DFW locations you can send us your valuables in an&nbsp;easy-to-use, insured mailer by visiting our sister company&nbsp;<a title="American Gold &amp; Silver Exchange" href="http://www.americangoldandsilverexchange.com/" target="_blank">American Gold &amp; Silver Exchange</a>.</div>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
<p>&nbsp;</p>
EOT;
Mage::getModel('cms/page')->load('sell-jewelry', 'identifier')->setContent($content)->save();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Rare Coins &amp; Currency</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold &amp; Silver Exchange is one of the largest buyers of rare coins, currency and collectibles in the country. No collection is too small or too large.</strong></span></p>
<ul>
<li class="text_4">Certified Coins PCGS and NGC</li>
<li class="text_4">Raw Coins</li>
<li class="text_4">United States Proof Sets</li>
<li class="text_4">Silver Dollars</li>
<li class="text_4">Gold Coins</li>
<li class="text_4">Colonial Coin and Currency</li>
<li class="text_4">Large Note Currency</li>
<li class="text_4">Rare and Collectible Bank Notes</li>
<li class="text_4">Commemorative US Gold Coins</li>
<li class="text_4">Much More&hellip;</li>
</ul>
</div>
<div style="clear: left;">&nbsp;</div>
<div class="text_4">If you are unable to visit our multiple DFW locations you can send us your valuables in an Ease-to-use, insured mailer by visiting our sister company&nbsp;<a title="American Gold &amp; Silver Exchange" href="http://www.americangoldandsilverexchange.com/" target="_blank">American Gold &amp; Silver Exchange</a>.</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
<p>&nbsp;</p>
EOT;
Mage::getModel('cms/page')->load('sell-rare-coins', 'identifier')->setContent($content)->save();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Watches</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell">
<p><span class="text_4">Dallas Gold &amp; Silver Exchange purchases all models of these fine watches, please call if you do not see your watch listed. We purchase fine watches in any condition working or not.</span></p>
<div class="row-fluid content-sell">
<div class="span4">
<ul>
<li>Alain Silberstein</li>
<li>Audemars Piguet</li>
<li>Baume &amp; Mercier</li>
<li>Bedat</li>
<li>Bell &amp; Ross</li>
<li>Bertolucci</li>
<li>Blancpain</li>
<li>Boucheron</li>
<li>Bovet</li>
<li>Breguet</li>
<li>Breitling</li>
<li>Bvlgari</li>
<li>Cartier</li>
<li>Chanel</li>
<li>Chaumet</li>
<li>Chopard</li>
<li>Chronoswiss</li>
<li>Concord</li>
<li>Corum</li>
<li>Daniel Roth</li>
<li>DeLaneau</li>
<li>Dubey &amp; Schaldenbrand</li>
<li>Dunhill</li>
<li>Ebel</li>
<li>Eberhard &amp; Co.</li>
</ul>
</div>
<div class="span4">
<ul>
<li>Elgin</li>
<li>Fortis</li>
<li>Fred</li>
<li>F.P. Journe</li>
<li>Franck Muller</li>
<li>Gerald Genta</li>
<li>Girard-Perregaux</li>
<li>Glahutte</li>
<li>Gruen</li>
<li>Gucci</li>
<li>Illinois</li>
<li>Hamilton</li>
<li>Hampton</li>
<li>Harry Winston</li>
<li>Heuer</li>
<li>Howard</li>
<li>Hublot</li>
<li>I.W.C.</li>
<li>Jacob &amp; Co.</li>
<li>Jaeger-LeCoultre</li>
<li>Krieger</li>
<li>Lange &amp; Sohne</li>
<li>LeCoultre</li>
<li>Mauboussin</li>
<li>Maurice Lacroix</li>
</ul>
</div>
<div class="span4">
<ul>
<li>Montblanc</li>
<li>Omega</li>
<li>Oris</li>
<li>Panerai</li>
<li>Parmigiani</li>
<li>Patek Philippe</li>
<li>Philippe Charriol</li>
<li>Piaget</li>
<li>Porsche Design</li>
<li>Railroad</li>
<li>Repeaters</li>
<li>Roger Dubuis</li>
<li>Rolex</li>
<li>Tag Heuer</li>
<li>Tissot</li>
<li>Tourneau</li>
<li>Tudor</li>
<li>Ulysse Nardin</li>
<li>Vacheron Constantin</li>
<li>Vacheron-Constantin</li>
<li>Van Cleef &amp; Arpels</li>
<li>Versace</li>
<li>Zenith</li>
<li>Waltham</li>
</ul>
</div>
<div style="clear: left;">&nbsp;</div>
<!--<ul>
<li class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul> --></div>
</div>
</div>
<!-- // end left sell -->
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right -->
<p>&nbsp;</p>
<!-- end sell page --></div>
EOT;
Mage::getModel('cms/page')->load('sell-watches', 'identifier')->setContent($content)->save();

$installer->endSetup();