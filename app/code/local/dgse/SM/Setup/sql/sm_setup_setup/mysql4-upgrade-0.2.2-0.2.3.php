<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$block = Mage::getModel('cms/block')->load('footer_links');

$content = <<<EOD
    <ul>
        <li><a href="{{store direct_url="catalog/seo_sitemap/category"}}">Site Map</a><span class="separate">|</span></li>
        <li><a href="{{store direct_url="terms-of-use"}}">Terms of Use</a><span class="separate">|</span></li>
        <li><a href="{{store direct_url="terms-of-use"}}">Privacy Policy</a><span class="separate">|</span></li>
        <li><a href="{{store direct_url="contacts"}}">Contact Us</a></li>
    </ul>
EOD;

$data = array(
    'title'      => 'Footer Links',
    'identifier' => 'footer_links',
    'content'    => $content,
    'stores'     => array(0)
);

if($block->getId()) {
    $block->setContent($content);
}else{
    $block->setData($data);
}
$block->save();


$content = <<<EOD
    <span>For maps and details about any of the nine D/FW Dallas Gold Silver Exchange locations, please click one of the yellow markers on the map below. To reach us by phone, call (972) 484-3662. To contact us via email, please complete the form</span>
    <p align="center"><img src="{{media url="wysiwyg/contact-maps.jpg"}}" alt="" width="650" height="443" usemap="#Map" border="0" /> <map id="Map" name="Map">
    <area title="Southlake" shape="rect" coords="174,130,224,180" href="southlake" alt="Southlake" />
    <area title="Euless" shape="rect" coords="224,252,274,302" href="euless" alt="Euless" />

    <area title="Arlington" shape="rect" coords="234,349,284,399" href="arlington" alt="Arlington" />

    <area title="Fort Worth" shape="rect" coords="52,338,102,388" href="fortworth" alt="Fort Worth" />

    <area title="Dallas (I-35 and Royal)" shape="rect" coords="409,187,451,229" href="reeder" alt="Dallas (I-35 and Royal)" />

    <area title="Dallas (Preston Center)" shape="rect" coords="454,216,492,253" href="store" alt="Dallas (Preston Center)" />

    <area title="Dallas (Preston and Alpha)" shape="rect" coords="462,138,507,180" href="preston" alt="Dallas (Preston and Alpha)" />

    <area title="Garland" shape="rect" coords="599,213,644,255" href="garland" alt="Garland" />

    <area title="Allen" shape="rect" coords="554,38,599,80" href="allen" alt="Allen" />
     </map> <br /> <br /> Or select from the following locations:</p>
    <p align="center"><a href="sherry" target="_parent">Dallas (Preston Center)</a> | <a href="eeder" target="_parent">Dallas (I-35 &amp; Royal)</a> | <a href="preston" target="_parent">Dallas (Preston &amp; Alpha)</a><br /> <a href="allen" target="_parent">Allen</a> | <a href="fortworth" target="_parent">Fort Worth</a> | <a href="euless" target="_parent">Euless</a> | <a href="arlington" target="_parent">Arlington</a> | <a href="southlake" target="_parent">Southlake</a> | <a href="garland" target="_parent">Garland</a></p>
EOD;

$contact = Mage::getModel('cms/block')->load('contact-map');

$data = array(
    'title'      => 'Contact Map',
    'identifier' => 'contact-map',
    'content'    => $content,
    'stores'     => array(0)
);

if($contact->getId()) {
    $contact->setContent($content);
}else{
    $contact->setData($data);
}
$contact->save();

$installer->endSetup();