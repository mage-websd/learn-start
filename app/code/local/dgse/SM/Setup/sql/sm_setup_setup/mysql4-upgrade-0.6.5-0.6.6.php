<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$blockContent = <<<EOT
<p id="bullion-notice"><span class="text">Contact one of our bullion experts to learn more or place an order</span><a class="button" href="http://dgse.imiqa.com/contactus">Contact Us</a></p>
EOT;
Mage::getModel('cms/block')
    ->setContent($blockContent)
    ->setIdentifier('bullion-notice')
    ->setStores(array(0))
    ->save();

$pageAddContent = <<<EOT
{{block type="cms/block" block_id="bullion-notice"}}
EOT;
$bullionContent = <<<EOT
<div id="right_side">
<div class="bullion-page-header">
<h1>Bullion Catalog</h1>
<span>Select Bullion Metal</span></div>
<ul class="bullion-cate-img">
<li><a class="link_rare_coin_bullion" href="{{store url='Gold'}}"><img src="{{media url="wysiwyg/Precious-Metals-Catalog-Gold.jpg"}}" alt="" /><span>Gold&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Silver'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Silver.jpg"}}" alt="" /><span>Silver&nbsp;&nbsp;</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Platinum'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Platinum.jpg"}}" alt="" /><span>Platinum</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Palladium'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Palladium.jpg"}}" alt="" /><span>Palladium </span></a></li>
</ul>
</div>
EOT;

Mage::getModel('cms/page')->load('bullion', 'identifier')->setContent($pageAddContent.$bullionContent)->save();

$pages = Mage::getModel('cms/page')->getCollection()
    ->addFieldToFilter(
        'identifier',
        array(
            array('like'=>'%gold-%'),
            array('like'=>'%silver-%'),
            array('like'=>'%platinum-%'),
            array('like'=>'%palladiumplatinum-%')
        )
    );

foreach($pages as $page) {
    $page->setContent($pageAddContent.$page->getContent())->setStores(array(0))->save();
}

$installer->endSetup();