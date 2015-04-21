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
<div class="text_4">If you are unable to visit our multiple DFW locations you can send us your valuables in an ease-to-use, insured mailer by visiting our sister company <a href="http://www.americangoldandsilverexchange.com/" title="American Gold & Silver Exchange">American Gold & Silver Exchange</a>.</div>
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
<li>If you are unable to visit our multiple DFW locations you can send us your valuables in an easy-to-use, insured mailer by visiting our sister company <a href="http://www.americangoldandsilverexchange.com/" title="American Gold & Silver Exchange">American Gold & Silver Exchange</a>.</li>
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
<li class="text_4">If you are unable to visit our multiple DFW locations you can send us your valuables in an Ease-to-use, insured mailer by visiting our sister company <a href="http://www.americangoldandsilverexchange.com/" title="American Gold & Silver Exchange">American Gold & Silver Exchange</a>.</li>
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

$content='
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Pocket Watch</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
{{block type="cms/block" block_id="sell-subpage-menu"}}
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
</ul>
</div>
<div class="span4">
<ul>
<li>Dubey &amp; Schaldenbrand</li>
<li>Dunhill</li>
<li>Ebel</li>
<li>Eberhard &amp; Co.</li>
<li>Fortis</li>
<li>Fred</li>
<li>F.P. Journe</li>
<li>Franck Muller</li>
<li>Gerald Genta</li>
<li>Girard-Perregaux</li>
<li>Glahutte</li>
<li>Gucci</li>
<li>Harry Winston</li>
<li>Heuer</li>
<li>Hublot</li>
<li>I.W.C.</li>
<li>Jacob &amp; Co.</li>
<li>Jaeger-LeCoultre</li>
<li>Krieger</li>
<li>Lange &amp; Sohne</li>
<li>LeCoultre</li>
</ul>
</div>
<div class="span4">
<ul>
<li>Mauboussin</li>
<li>Maurice Lacroix</li>
<li>Montblanc</li>
<li>Omega</li>
<li>Oris</li>
<li>Panerai</li>
<li>Parmigiani</li>
<li>Patek Philippe</li>
<li>Philippe Charriol</li>
<li>Piaget</li>
<li>Porsche Design</li>
<li>Roger Dubuis</li>
<li>Rolex</li>
<li>Tag Heuer</li>
<li>Tissot</li>
<li>Tourneau</li>
<li>Tudor</li>
<li>Ulysse Nardin</li>
<li>Vacheron Constantin</li>
<li>Van Cleef &amp; Arpels</li>
<li>Versace</li>
</ul>
</div>
<div class="span4">
<ul>
<li>Zenith</li>
<li>Waltham</li>
<li>Hampton</li>
<li>Howard</li>
<li>Elgin</li>
<li>Gruen</li>
<li>Illinois</li>
<li>Hamilton</li>
<li>Vacheron-Constantin</li>
<li>Repeaters</li>
<li>Railroad</li>
</ul>
</div>
<div style="clear: left;">&nbsp;</div>
<!--<ul>
<li class="text_4">{{block type="cms/block" block_id="sell-footer-company"}}</li>
</ul> -->
</div>
</div>
</div>
<!-- // end left sell -->
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right -->
<p>&nbsp;</p>
<!-- end sell page -->
';
$page = Mage::getModel('cms/page')
    ->load('sell-watches','identifier');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Sell Watches');
    $page->setIdentifier('sell-watches');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$installer->endSetup();