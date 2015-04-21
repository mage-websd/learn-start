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

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Bullion</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold &amp; Silver Exchange is one of the largest Precious Metals dealers in the United States. We make precious metal markets in GOLD, SILVER, PLATINUM and PALLIDUM (Over 250 bullion items). GOLD, SILVER, PLATINUM, and PALLADIUM price are high call us at&nbsp;<span class="skype_c2c_print_container notranslate">972-484-3662</span><span id="skype_c2c_container" class="skype_c2c_container notranslate" dir="ltr" data-numbertocall="+19724843662" data-isfreecall="false" data-isrtl="false" data-ismobile="false"><span class="skype_c2c_highlighting_inactive_common" dir="ltr"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img class="skype_c2c_logo_img" src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/call_skype_logo.png" alt="" width="0" height="0" /></span></span></span>&nbsp;for daily quotes.</strong></span></p>
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
';

$page = Mage::getModel('cms/page')
    ->load('sell-bullion','identifier');
    $page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell Bullion');
    $page->setIdentifier('sell-bullion');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Collectibles</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="text-sell">&nbsp;
<p class="text_4">Dallas Gold & Silver Exchange purchases all types of vintage and modern collectibles – mainly focusing on sports, historical and political memorabilia in nature.  However, other collectibles such as antiques and toys are also desired. There are few dealers in the Metroplex that have both the knowledge and the willingness to pay top dollar for these types of items.  We conduct this type of business on a daily basis. Dallas Gold & Silver Exchange has an A+ Better Business Bureau rating as well as being a publicly traded company (NYSEMKT: DGSE). No appointments are necessary.</p>
<p class="text_4">Please stop by any of our seven (7) locations in the DFW Metroplex.</p>
<p class="text_4">We will be happy to assist you any way.</p>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
';
/*<p class="text_4"><strong>DGSE is interested in buying anything of intrinsic value including:</strong></p>
<ul>
<li class="text_4">10k,12k, 14k, 18k, 22k and 24k gold</li>
<li class="text_4">Scrap Gold</li>
<li class="text_4">Broken or damaged jewelry and items missing stones</li>
<li class="text_4">Wedding and engagement rings</li>
<li class="text_4">Class rings, cocktail rings and cluster rings</li>
<li class="text_4">Broken, damaged or obsolete watches</li>
<li class="text_4">Coins and medals</li>
<li class="text_4">Brooches and pins</li>
<li class="text_4">Statues</li>
<li class="text_4">Dental gold</li>
<li class="text_4">Gold grills</li>
<li class="text_4">Lockets and charms</li>
<li class="text_4">Earrings matched or unmatched</li>
<li class="text_4">Gemstones and colored stones</li>
<li class="text_4">Sterling silverware and serving sets</li>
<li class="text_4">Sports memorabilia</li>
<li class="text_4">Historic memorabilia</li>
<li class="text_4">Collectibles of all types</li>
<li class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul>*/
$page = Mage::getModel('cms/page')
    ->load('sell-collectibles','identifier');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell Collectibles');
    $page->setIdentifier('sell-collectibles');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Jewelry</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold & Silver Exchange always needs to purchase fine jewelry for use at our nationwide jewelry stores. Our expert appraisers will evaluate your items individually to ensure that the highest quality items bring the highest payouts.</strong></span></p>
<div style="float: left; margin: 0; padding: 0;">
<ul>
<li class="text_4">Men\'s Diamond Rings</li>
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
<div class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</div>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
';

$page = Mage::getModel('cms/page')
    ->load('sell-jewelry','identifier');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell Jewelry');
    $page->setIdentifier('sell-jewelry');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell to DGSE</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="text-sell"><span><span>Since 1978, Dallas Gold & Silver Exchange has paid top dollar for North Texans\' gold, silver, jewelry, rare coins and more. We\'ve been recognized numerous times as the highest paying buyer in Metroplex and we\'re proud to have thousands of customers who enthusiastically recommend us. We have an A+ Better Business Bureau rating. We\'re publicly-traded, trusted, and we offer a fast and easy selling process.</span></span>
<ul>
<li>No appointment needed - just stop into any of our SEVEN Metroplex stores (map of stores  <a title="Map store" href="https://www.google.com/maps/place/Metroplex+Gymnastics+&+Swim/@33.090638,-96.672236,17z/data=!3m1!4b1!4m2!3m1!1s0x864c175036973a55:0x9d95c96174a79c60" target="_blank">here</a>).</li>
<li>Quick offer for your items - you\'ll usually have an offer in 10 minutes or less.</li>
<li>No pressure - our offers speak for themselves.</li>
<li>Immediate payment in cash or check - your choice.</li>
<li>No amount too small - every day, we have people that sell old gold or silver for just $5 or $10 - maybe earning backs or broken pieces.</li>
<li>No amount too large - we\'re publicly-traded and have the ability to purchase large estate and other collections up to and over $10 Million.</li>
<li>We\'ll explain the process - we examine pieces for purity, weigh them, then base our offer on current precious metal prices.</li>
<li>{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul>
</div>
</div>
<!-- // end left sell -->
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
';

$page = Mage::getModel('cms/page')
    ->load('sell','identifier');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell');
    $page->setIdentifier('sell');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Rare Coins &amp; Currency</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="text-sell">
<p><span class="text_4"><strong>Dallas Gold & Silver Exchange is one of the largest buyers of rare coins, currency and collectibles in the country. No collection is too small or too large.</strong></span></p>
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
<li class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
';
$page = Mage::getModel('cms/page')
    ->load('sell-rare-coins','identifier');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell Rare Coins');
    $page->setIdentifier('sell-rare-coins');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$installer->endSetup();