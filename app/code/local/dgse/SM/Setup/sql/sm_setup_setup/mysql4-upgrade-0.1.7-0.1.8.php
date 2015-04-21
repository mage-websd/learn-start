<?php
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'];
$content = <<<EOT
<div class="block block-custom">
<div class="block-content">
<a class="banner-item" href="#">
<img src="$baseUrl/media/wysiwyg/left-banner-s2.jpg" alt="">
</a>
</div>
</div>
EOT;

$cmsBlock = Mage::getModel('cms/block');
$cmsBlock->setIdentifier('left-custom-wordpress')
    ->setStores(array(0))
    ->setIsActive(true)
    ->setTitle('Left block of wordpress');

$cmsBlock->setContent($content)->save();