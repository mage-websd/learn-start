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

$content = <<<EOD
<div class="sitemap-banner">
<ul>
<li><img src="{{skin url="images/sitemap/banner_sitemap1.jpg"}}" alt="sitemap-banner" /></li>
<li><img src="{{skin url="images/sitemap/banner_sitemap2.jpg"}}" alt="sitemap-banner" /></li>
<li><img src="{{skin url="images/sitemap/banner_sitemap3.jpg"}}" alt="sitemap-banner" /></li>
</ul>
</div>
EOD;

$staticBlock = array(
    'title' => 'Banner sitemap',
    'identifier' => 'banner-sitemap',
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);
$block = Mage::getModel('cms/block')->load('banner-sitemap');
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock)->save();
} else {
    $block->setContent($content)->save();
}

$installer->endSetup();