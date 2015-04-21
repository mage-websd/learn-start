<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$content = <<<EOD
<ul>
<li data-transition="fade" data-slotamount="15" data-masterspeed="300" data-delay="7500"><img style="background-color: #f7f7f9;" src="{{media url="wysiwyg/bkg_black.jpg"}}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat" />
<div class="tp-caption large_text randomrotate" data-x="20" data-y="100" data-start="1000" data-speed="1000" data-easing="Power4.easeOut" data-endspeed="300" data-endeasing="Power1.easeIn" data-captionhidden="off"><span class="sld2-title">Annual Diamond Show</span><span class="sld2-subtitle">MAY st - 3rd, 2014</span></div>
<div class="tp-caption modern_small_text_dark sfr" data-x="20" data-y="270" data-start="1500" data-speed="1000" data-easing="easeInOutQuint" data-endspeed="300">
<p>Texas' largest inventory of certified diamonds. Thousands of diamonds valued <br />at more than $3 million. Luxury estate &amp; designer jewelry from around the world.</p>
<p>&bull; Complimentary sizing &amp; setting.<br /> &bull; Store hours extended to 8pm.<br /> &bull; Private showings Available.</p>
</div>
<div class="tp-caption sfl" data-x="300" data-y="330" data-start="2500" data-speed="1000" data-easing="Elastic.easeOut" data-endspeed="300" data-endeasing="Power1.easeIn" data-captionhidden="off"><a class="button" href="#">Learn More</a></div>
<div class="tp-caption sfl" data-x="603" data-y="66" data-start="3000" data-speed="1000" data-easing="Power4.easeOut" data-endspeed="300" data-captionhidden="off"><img src="{{media url="wysiwyg/banner.png"}}" alt="" /></div>
</li>
</ul>
EOD;
$staticBlock = array(
    'title' => 'slide_html2',
    'identifier' => 'slide_html2',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('slide_html2');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$installer->endSetup();