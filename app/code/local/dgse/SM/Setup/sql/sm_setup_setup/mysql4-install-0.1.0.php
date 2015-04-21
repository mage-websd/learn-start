<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/7/14
 * Time: 11:06 AM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$Config = Mage::app()->getConfig();
$Config ->saveConfig('design/footer/copyright', "Copy right &copy; 2014 by DGSE companies. All Rights Reserved.");

$content = <<<EOD
    <ul>
	<li><a href="{{store direct_url="catalog/seo_sitemap/category"}}">Site Map</a><span class="separate">|</span></li>
	<li><a href="{{store direct_url="teams-of-use"}}">Terms of Use</a><span class="separate">|</span></li>
	<li class="last privacy"><a href="{{store direct_url="privacy-policy"}}">Privacy Policy</a></li>
</ul>
EOD;
$staticBlock = array(
    'title' => 'Footer Links',
    'identifier' => 'footer_links',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('footer_links');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
    <p class="connect-us">Call DGSE: (972) 481-3800</p>
EOD;
$staticBlock = array(
    'title' => 'Connect Us',
    'identifier' => 'connect-us',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('connect-us');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
    <div class="span4" data-tablet="span6">
<div class="block block-location">
<div class="block-title">Locations</div>
<div class="block-content clearfix">
<ul>
<li>Allen</li>
<li>Arlington</li>
<li>Dallas(I-35 & Royal)</li>
<li>Dallas (Preston & Alpha)</li>
<li>Dallas (Preston Center)</li>
<li>Euless</li>
<li>Fort Worth</li>
<li>garland</li>
<li>Southlake</li>
</ul>
</div>
</div>
</div>
<div class="span4" data-tablet="span6">
<div class="block block-subscribe">
<div class="block-title">Newsletters</div>
<div class="block-content clearfix"><label for="newsletter">Subscribe to the DGSE mailing list to receive updates on new arrivals</label> {{block type="newsletter/subscribe" name="footer.newsletter" template="newsletter/subscribe-footer.phtml"}}</div>
</div>
</div>
<div class="span4" data-tablet="span6">
<div class="block block-youtube">
<div class="block-title">Youtube</div>
<div class="block-content clearfix"><iframe src="//www.youtube.com/embed/_2jRVKqYuVs" frameborder="0" width="370" height="215"></iframe></div>
</div>
</div>
EOD;
$staticBlock = array(
    'title' => 'Contact Info - Newsletters',
    'identifier' => 'position-6',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('position-6');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
 <div class="block block-shop span4">
<div class="block-title">Buy</div>
<div class="block-content">
<ul>
<li><a href="#">Jewelry</a></li>
<li><a href="#">Watches</a></li>
<li><a href="#">Rare Coins &amp; Currency</a></li>
<li><a href="#">Bullion</a></li>
<li><a href="#">Collectibles</a></li>
</ul>
</div>
</div>
<div class="block block-sell span4">
<div class="block-title">Sell</div>
<div class="block-content">
<ul>
<li><a href="{{store direct_url="sell-to-dgse"}}">How It Works</a></li>
<li><a href="{{store direct_url="sell-to-dgse"}}">Ready To Sell?</a></li>
</ul>
</div>
</div>
<div class="block block-about span4">
<div class="block-title">About</div>
<div class="block-content">
<ul>
<li><a href="{{store direct_url="overview"}}">Overview</a></li>
<li><a href="{{store direct_url="leadership"}}">Leadership</a></li>
<li><a href="{{store direct_url="dgse-companies"}}">DGSE Companies</a></li>
<li><a href="{{store direct_url="press"}}">Press</a></li>
</ul>
</div>
</div>
EOD;
$staticBlock = array(
    'title' => 'Shop Categories',
    'identifier' => 'position-10',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('position-10');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
 <ul class="payment">
<li><a class="visa" title="Visa" href="#" data-original-title="Visa" data-toggle="tooltip">Visa</a></li>
<li><a class="mastercard" title="Master Card" href="#" data-original-title="Master Card" data-toggle="tooltip">Master Card</a></li>
<li><a class="discover" title="Discover" href="#" data-original-title="Discover" data-toggle="tooltip">Discover</a></li>
</ul>
<p><a class="truste" title="truste" href="#" data-original-title="Truste" data-toggle="tooltip">Truste</a></p>
EOD;
$staticBlock = array(
    'title' => 'Payment methods',
    'identifier' => 'position-12',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('position-12');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
 <div class="span12 footer-logo">
<p>"One of the country's largest jewelry, rare coin and</p>
<p>precious metal dealers."</p>
</div>
EOD;
$staticBlock = array(
    'title' => 'Footer Logo',
    'identifier' => 'position-11',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('position-11');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$content = <<<EOD
 <div class="banner-promotions">
<div class="container">
<div class="banner-col-left"><a href="#"><img src="{{skin url='images/same1.jpg'}}" alt="" /></a><a href="#"> <img src="{{skin url='images/same2.jpg'}}" alt="" /> </a><a href="#"><img src="{{skin url='images/same3.jpg'}}" alt="" /></a></div>
<div class="banner-col-right"><a href="#"><img src="{{skin url='images/same4.jpg'}}" alt="" /></a><a href="#"> <img src="{{skin url='images/same5.jpg'}}" alt="" /></a></div>
</div>
</div>
EOD;
$staticBlock = array(
    'title' => 'Banner Promotions',
    'identifier' => 'banner_promotion',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('banner_promotion');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}


$installer->endSetup();