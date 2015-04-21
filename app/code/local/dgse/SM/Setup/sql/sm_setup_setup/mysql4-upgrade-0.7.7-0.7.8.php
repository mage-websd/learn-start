<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<div class="repair-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Jewelry and Watch Repair</div>
</div>
<div class="description-repair"><span>Dallas Gold &amp; Silver Exchange&rsquo;s on-site Craftsmen have decades of experience and offer a wide variety of jewelry and watch repair services. We perform all repair, design, cleaning and warranty work in our on-site facilities and pride ourselves on our attention to detail and quality craftsmanship. Some jobs can even be finished while you wait.</span></div>
<div class="description-repair"><span><br /></span></div>
<div class="description-repair"><span><br /></span></div>
<!-- //end description-repair -->
<div class="repair-img-row">
<div class="list-repair">
<div class="list-note">
<div><span style="font-size: large;">Jewelry Service</span></div>
<div class="row-fluid">
<div class="span6">
<ul class="note-column-left">
<li>Repairs from the simple to the complex</li>
<li>Custom jewelry design and fabrication</li>
<li>Sizing for silver, gold or platinum rings</li>
<li>Chain, necklace and bracelet repair</li>
<li>Mounting, tipping and prong repair</li>
<li>Diamond and colored stone replacement</li>
<li>Stone settings of all types</li>
</ul>
</div>
<div class="span6">
<ul class="note-column-right">
<li>Cleaning and polishing</li>
<li>Pearl restringing</li>
<li>Rhodium plating</li>
<li>Wax carving</li>
<li>Sand blasting</li>
<li>Laser soldering</li>
<li>CAD service</li>
</ul>
</div>
</div>
</div>
<!--  //end list-note-->
<div class="list-note">
<div><span style="font-size: large;"><br /></span></div>
<div><span style="font-size: large;">Watch Service</span></div>
<div class="row-fluid">
<div class="span6">
<ul class="note-column-left">
<li>Specializing in repair, servicing and customization of Rolex watches</li>
<li>Installation of custom bands, dials and bezels</li>
<li>Band repair</li>
<li>Refurbishing</li>
</ul>
</div>
<div class="span6">
<ul class="note-column-right">
<li>Cleaning and polishing</li>
<li>Dial changes</li>
<li>Bezel press</li>
<li>Water testing and pressure proofing</li>
</ul>
</div>
</div>
</div>
<!--  //end list-note--></div>
<!-- //end list repair -->
<div class="repair-img-right"><img src="{{media url="wysiwyg/repair_V2_JPEG_copy.jpg"}}" alt="" /> <img src="{{media url="wysiwyg/repair_V5-copy.jpg"}}" alt="" /></div>
</div>
</div>
<!-- //end repaire page -->
<p>&nbsp;</p>
EOT;
Mage::getModel('cms/page')->load('repair', 'identifier')->setContent($content)->save();

$installer->endSetup();