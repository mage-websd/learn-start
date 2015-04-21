<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

//change content block slide
$content = ' 
<li style="color: #333;cursor: pointer;" data-transition="fade" data-slotamount="6" data-masterspeed="300" data-delay="7000"  onclick="window.location=\'{{store url="jewelry/rings"}}\'">
<img src="{{skin url="images/slide/shop-rings.jpg"}}" alt=""/>
<div class="tp-caption" data-x="140" data-y="270" data-start="0" data-speed="300" data-easing="Bounce.easeOut" data-endspeed="300" data-endeasing="Power1.easeIn" data-captionhidden="off"></div>
</li>
';
$block = Mage::getModel('cms/block')->load('slide_html1');
$block->setContent($content);
if (!$block->getId()) {
    $block->setTitle('slide_html1');
    $block->setIdentifier('slide_html1');
    $block->setStores(array(0));
    $block->setIsActive(1);
}
$block->save();

$content = '
<li style="color: #333;cursor: pointer;" data-transition="fade" data-slotamount="6" data-masterspeed="300" data-delay="7000"  onclick="window.location=\'{{store url="jewelry/earrings"}}\'">
    <img src="{{skin url="images/slide/shop-earrings.jpg"}}" alt=""/>
    <div class="tp-caption" data-x="140" data-y="270" data-start="0" data-speed="300" data-easing="Bounce.easeOut" data-endspeed="300" data-endeasing="Power1.easeIn" data-captionhidden="off"></div>
</li>
';
$block = Mage::getModel('cms/block')->load('slide_html2');
$block->setContent($content);
if (!$block->getId()) {
    $block->setTitle('slide_html2');
    $block->setIdentifier('slide_html2');
    $block->setStores(array(0));
    $block->setIsActive(1);
}
$block->save();

$content = '
<li style="color: #333; cursor: pointer;" data-transition="fade" data-slotamount="6" data-masterspeed="300" data-delay="7000" onclick="window.location=\'{{store url=""}}jewelry/watches\'">
    <img src="{{skin url="images/slide/shop-watches.jpg"}}" alt=""/>
    <div class="tp-caption" data-x="140" data-y="270" data-start="0" data-speed="300" data-easing="Bounce.easeOut" data-endspeed="300" data-endeasing="Power1.easeIn" data-captionhidden="off"></div>
</li>
';
$block = Mage::getModel('cms/block')->load('slide_html3');
$block->setContent($content);
if (!$block->getId()) {
    $block->setTitle('slide_html3');
    $block->setIdentifier('slide_html3');
    $block->setStores(array(0));
    $block->setIsActive(1);
}

$block->save();
$installer->endSetup();