<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/DGSE_Mock-Ups-7.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell Watches</div>
</div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->{{block type="cms/block" block_id="sell-subpage-menu"}}
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