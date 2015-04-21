<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/* add image for category diamonds */
$category = Mage::getModel('catalog/category')
    ->getCollection()
    ->addAttributeToFilter('name','Diamonds')
    ->getFirstItem();
if($category->getId()) {
    $content = '<div class="block"><div class="block-content"><a href="{{store direct_url="blog/category/educational-guides/diamonds/"}}"><img src="{{skin url="images/diamond-buying-guide.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="{{store direct_url="under500"}}"><img src="{{skin url="images/dgse-gifts-under-500.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="{{store direct_url="New30"}}"><img src="{{skin url="images/dgse-new-pieces.jpg"}}" alt="" /></a></div></div>
        <div class="block"><div class="block-content"><a href="https://www.facebook.com/DallasGoldandSilver"  target="_blank"><img src="{{skin url="images/dgse-follow-us.jpg"}}" alt="" /></a></div></div>';
    $category
        ->setData('promo_images',$content)
        ->save();
}
$installer->endSetup();