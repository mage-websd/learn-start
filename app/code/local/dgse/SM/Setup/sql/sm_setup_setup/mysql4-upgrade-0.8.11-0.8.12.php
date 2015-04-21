<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
//change cotent block left bar product
$content = '
{{block type="core/template" template="catalog/product/view/left_more.phtml"}}
<div class="block hide-mobile">
<div class="block-content"><a href="{{store direct_url="under500"}}"><img src="{{skin url="images/dgse-gifts-under-500.jpg"}}" alt="" /></a></div>
</div>
<div class="block hide-mobile">
<div class="block-content"><a href="{{store direct_url="New30"}}"><img src="{{skin url="images/dgse-new-pieces.jpg"}}" alt="" /></a></div>
</div>
<div class="block hide-mobile">
<div class="block-content"><a href="https://www.facebook.com/DallasGoldandSilver" target="_blank"><img src="{{skin url="images/dgse-follow-us.jpg"}}" alt="" /></a></div>
</div>
';
$block = Mage::getModel('cms/block')->load('left_sidebar_product');
$block->setContent($content);
if ($block->getId()) {
    $block->setTitle('Left sidebar image');
    $block->setIdentifier('left_sidebar_product');
    $block->setStores(array(0));
    $block->setIsActive(1);
}
$block->save();

$category = Mage::getModel('catalog/category')
    ->getCollection()
    ->addAttributeToFilter('name','Diamonds')
    ->getFirstItem();
if($category->getId()) {
    $content = '<div class="block"><div class="block-content"><a href="{{store direct_url="educational-guides/diamonds/diamonds-101-how-to-choose-a-diamond"}}"><img src="{{skin url="images/diamond-buying-guide.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="{{store direct_url="under500"}}"><img src="{{skin url="images/dgse-gifts-under-500.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="{{store direct_url="New30"}}"><img src="{{skin url="images/dgse-new-pieces.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="https://www.facebook.com/DallasGoldandSilver"  target="_blank"><img src="{{skin url="images/dgse-follow-us.jpg"}}" alt="" /></a></div></div>';
    $category
        ->setData('promo_images',$content)
        ->save();
}

$installer->endSetup();