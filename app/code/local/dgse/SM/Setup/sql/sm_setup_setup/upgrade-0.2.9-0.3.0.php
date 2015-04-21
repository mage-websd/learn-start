<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOD
<div class="span4"><a class="banner-item" href="{{store url=""}}rare-coins"><img src="{{skin url="images/homeimg/homeimg6.jpg"}}" alt="" /></a></div>
<div class="span4"><a class="banner-item" href="{{store url=""}}jewelry"><img src="{{skin url="images/homeimg/homeimg7.jpg"}}" alt="" /></a></div>
<div class="span4"><a class="banner-item" href="{{store url=""}}repair"><img src="{{skin url="images/homeimg/homeimg8.jpg"}}" alt="" /></a></div>
EOD;
$block = Mage::getModel('cms/block')->load('main-banner');
if($block->getId()){
    $block->setContent($content)->save();
}
$installer->endSetup();