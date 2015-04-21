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

$block = Mage::getModel('cms/block')->load('promotion-news');
if ($block->getId()) {
    Mage::getModel('cms/block')->setIsActive(0)->save();
}

$content = <<<EOD
<div class="span4"><a class="banner-item" href="#"><img src="{{skin url="images/banner.jpg"}}" alt="" /></a></div>
<div class="span4"><a class="banner-item" href="#"><img src="{{skin url="images/banner.jpg"}}" alt="" /></a></div>
<div class="span4"><a class="banner-item" href="#"><img src="{{skin url="images/banner.jpg"}}" alt="" /></a></div>
EOD;
$block = Mage::getModel('cms/block')->load('main-banner');
if($block->getId()){
    $block->setContent($content)->save();
}
$installer->endSetup();