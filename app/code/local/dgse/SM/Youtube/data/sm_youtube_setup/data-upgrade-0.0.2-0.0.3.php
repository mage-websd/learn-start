<?php

$installer = $this;
$installer->startSetup();

$block = Mage::getModel('cms/block')->load('footer_links');

$content = <<<EOD
    <ul>
        <li><a href="{{store direct_url="catalog/seo_sitemap/category"}}">Site Map</a><span class="separate">|</span></li>
        <li><a href="{{store direct_url="terms-of-use"}}">Terms of Use</a><span class="separate">|</span></li>
        <li><a href="{{store direct_url="terms-of-use"}}">Privacy Policy</a></li>
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

$installer->endSetup();

