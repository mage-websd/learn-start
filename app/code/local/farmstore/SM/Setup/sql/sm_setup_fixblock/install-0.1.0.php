<?php
/**
 * setup block
 */
/* @var  Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/*header contact phone*/
$identifier = 'header-contact-phone';
$content = '<img alt="the farm store phone no" src="{{skin url="images/hardstyle/contact-phone.jpg"}}" />';
$block = Mage::getModel('cms/block')->load($identifier);
$block
    ->setStores(array(0))
    ->setData('is_active',1)
    ->setData('content',$content)
    ->setData('title',"Header Contact Phone");
if(!$block->getId()) {
    $block->setData('identifier',$identifier);
}
$block->save();


/*offer strip*/
$identifier = 'offer-strip';
$content = '
<span class="offer-strip-left">
    <img src="{{skin url="images/hardstyle/left.png"}}" border="0" alt="banner" />
</span>
<span class="offer-center">
    <a href="{{store url="shipping-information"}}" target="_self">
        <img src="{{skin url="images/hardstyle/offer-strip_3.jpg"}}" alt="" />
    </a>
</span>
<span class="offer-strip-right">
    <img src="{{skin url="images/hardstyle/right.png"}}" border="0" alt="banner" />
</span>';
$block = Mage::getModel('cms/block')->load($identifier);
$block
    ->setStores(array(0))
    ->setData('is_active',1)
    ->setData('content',$content)
    ->setData('title',"Offer Strip");
if(!$block->getId()) {
    $block->setData('identifier',$identifier);
}
$block->save();

$installer->endSetup();