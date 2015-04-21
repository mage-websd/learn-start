<?php
/**
 * Created by PhpStorm.
 * User: GiangSoda
 * Date: 10/6/14
 * Time: 3:54 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup
Create block content sell
 */
$installer = $this;
$installer->startSetup();

if(!Mage::registry('isSecureArea')) {
    Mage::register('isSecureArea', 1);
}
Mage::app()->setUpdateMode(false);

$baseUrl = Mage::app()->getStore(Mage::app()->getStore()->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
/* cms page education */
$content = '
<div class="row-fuild education">
    <div class="span12">
        <span>Dallas Gold &amp; Silver Exchange has developed the following Educational Guides so that our clients can make informed decisions when buying or selling Fine Jewelry, Watches, Wedding Jewelry, Diamonds, Precious Metals, Rare Coins and more.</span>
    </div>
    <div class="span12">
        <div class="span6">
            <h3><a href="{{store url=\'\'}}educational-guides/jewelry">Engagement Rings</a></h3>
            <a href="{{store url=\'\'}}educational-guides/jewelry">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/engagement-rings.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>The experts at Dallas Gold & Silver Exchange have developed this <a href="{{store url=\'\'}}educational-guides/jewelry">Guide to Purchasing an Engagement Ring</a> to help you through this exciting process. Topics covered include: setting a budget, educating yourself about diamonds, choosing a ring setting and picking a jeweler.</span>
            </div>
        </div>

        <div class="span6">
            <h3><a href="{{store url=\'\'}}educational-guides/diamonds">Diamonds</a></h3>
            <a href="{{store url=\'\'}}educational-guides/diamonds">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/diamonds.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>Choosing a diamond can seem like a daunting task but with the information in our <a href="{{store url=\'\'}}educational-guides/diamonds">Diamond Guide</a> and help from the knowledgeable experts at Dallas Gold & Silver Exchange it will be an enjoyable experience.</span>
            </div>
        </div>

        <div class="span12">
            <div class="span6">
                <h3><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins">Bullion & Rare Coins</a></h3>
                <a href="{{store url=\'\'}}educational-guides/bullion-rare-coins">
                    <img title="Engagement Rings" alt="Engagement Rings"
                         src="{{media url=\'wysiwyg/bullion-rare-coins.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has compiled the following <a href="{{store url=\'\'}}educational-guides/bullion-rare-coins">Investor Guides</a> to help you make an informed decision when buying or selling Bullion, Rare Coins and Currency.</span>
                </div>
            </div>

            <div class="span6">
                <h3><a href="{{store url=\'\'}}educational-guides/fine-watches">Fine Watches</a></h3>
                <a href="{{store url=\'\'}}educational-guides/fine-watches">
                    <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/fine-watches.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has the largest selection of fine watches in Dallas. <a href="{{store url=\'\'}}educational-guides/fine-watches">Our Fine Watch Educational Guide</a> helps answer your questions about these magnificent time pieces.</span>
                </div>
            </div>
        </div>
    </div>
</div>
';

$page = Mage::getModel('cms/page')
    ->load('educational-guides','identifier');
    $page->setLayoutUpdateXml('<reference name="left"><block type="wordpress/sidebar_widget_categories" template="wp/education/left_bar.phtml"/></reference>');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Educational Guides');
    $page->setIdentifier('educational-guides');
    $page->setRootTemplate('two_columns_left');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$installer->endSetup();