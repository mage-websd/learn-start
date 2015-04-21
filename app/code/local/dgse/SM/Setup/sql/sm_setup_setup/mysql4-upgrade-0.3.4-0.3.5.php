<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOD
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Jewelry</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
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
<div class="text_4">If you are unable to visit our multiple DFW locations you can send us your valuables in an&nbsp;easy-to-use, insured maller by visiting our sister company&nbsp;<a title="American Gold &amp; Silver Exchange" href="http://www.americangoldandsilverexchange.com/" target="_blank">American Gold &amp; Silver Exchange</a>.</div>
</div>
</div>
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->
<p>&nbsp;</p>
EOD;

$pageId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'sell-jewelry')->getFirstItem()->getId();

if($pageId){
    $page = Mage::getModel('cms/page')->load($pageId);
    $page->setContent($content)->save();
}

$installer->endSetup();