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

if (!Mage::registry('isSecureArea')) {
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
            <h3><a href="{{store url=\'\'}}educational-guides/jewelry/finding-the-right-ring">Engagement Rings</a></h3>
            <a href="{{store url=\'\'}}educational-guides/jewelry/finding-the-right-ring">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/engagement-rings.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>The experts at Dallas Gold & Silver Exchange have developed this <a href="{{store url=\'\'}}educational-guides/jewelry/finding-the-right-ring">Guide to Purchasing an Engagement Ring</a> to help you through this exciting process. Topics covered include: setting a budget, educating yourself about diamonds, choosing a ring setting and picking a jeweler.</span>
            </div>
        </div>

        <div class="span6">
            <h3><a href="{{store url=\'\'}}educational-guides/diamonds/diamonds-101-how-to-choose-a-diamond">Diamonds</a></h3>
            <a href="{{store url=\'\'}}educational-guides/diamonds/diamonds-101-how-to-choose-a-diamond">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/diamonds.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>Choosing a diamond can seem like a daunting task but with the information in our <a href="{{store url=\'\'}}educational-guides/diamonds/diamonds-101-how-to-choose-a-diamond">Diamond Guide</a> and help from the knowledgeable experts at Dallas Gold & Silver Exchange it will be an enjoyable experience.</span>
            </div>
        </div>

        <div class="span12">
            <div class="span6">
                <h3><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins-investment-guides">Bullion & Rare Coins</a></h3>
                <a href="{{store url=\'\'}}educational-guides/bullion-rare-coins-investment-guides">
                    <img title="Engagement Rings" alt="Engagement Rings"
                         src="{{media url=\'wysiwyg/bullion-rare-coins.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has compiled the following <a href="{{store url=\'\'}}educational-guides/bullion-rare-coins-investment-guides">Investor Guides</a> to help you make an informed decision when buying or selling Bullion, Rare Coins and Currency.</span>
                </div>
            </div>

            <div class="span6">
                <h3><a href="{{store url=\'\'}}educational-guides/fine-watches-investment-guides">Fine Watches</a></h3>
                <a href="{{store url=\'\'}}educational-guides/fine-watches-investment-guides">
                    <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/fine-watches.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has the largest selection of fine watches in Dallas. <a href="{{store url=\'\'}}educational-guides/fine-watches-investment-guides">Our Fine Watch Educational Guide</a> helps answer your questions about these magnificent time pieces.</span>
                </div>
            </div>
        </div>
    </div>
</div>
';

$page = Mage::getModel('cms/page')
    ->load('educational-guides', 'identifier');
$page->setLayoutUpdateXml('<reference name="left"><block type="wordpress/sidebar_widget_categories" template="wp/education/left_bar.phtml"/></reference>');
$page->setContent($content);
if (!$page->getPageId()) {
    $page->setTitle('Educational Guides');
    $page->setIdentifier('educational-guides');
    $page->setRootTemplate('two_columns_left');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

/*bullion page*/
$content = '
<div class="row-fuild education">
    <div class="span12">
        <h3 class="education-header">Bullion & Rare Coin</h3>
    </div>
    <div class="span12 text-justify">
        <img src="{{media url=\'\'}}wysiwyg/bullion-and-rare-coin-investment-guide.jpg"
             title="Bullion and Rare Coin Investment Guides" alt="Bullion and Rare Coin Investment Guides"
             style="float: right; margin: 0 0 0 15px">
        Investing or collecting Bullion and Rare Coins can be intimidating if you are not
        familiar with the terms and standards of the industry. Dallas Gold and Silver Exchange
        has compiled the following Investor Guides to help you make an informed decision.
        These Investor Guides are for informational purposes only.
        <br/>
        <ul>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/how-to-choose-a-firm-to-invest-with">
                    How to Choose a Firm to Invest With</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/investment-guide-to-gold">
                    Investing in Gold</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/investing-in-rare-coins">
                    Investing in Rare Coins</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/precious-metals-iras-the-key-to-a-well-diversified-retirement-plan">
                    Precious Metals IRAs</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/collecting-u-s-commemorative-coins">
                    Collecting U.S. Commemorative Coins</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/collecting-silver-dollars">
                    Collecting Silver Dollars</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/collecting-large-cents">
                    Collecting Large Cents</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/collecting-early-gold-coins">
                    Collecting Early Gold Coins</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/coin-care-storage-and-security">
                    Rare Coin Storage and Security</a></li>
            <li><a href="{{store url=\'\'}}educational-guides/bullion-rare-coins/super-galleries-book">
                    Reference Book: Superior Galleries – Introduction to Rare Coins and Precious Metals</a></li>
        </ul>
    </div>
    <div class="span12 education-small-bottom text-justify">
    Charts, graphs, guides and suggestions made on this website are for informational purposes only. By providing this information Dallas Gold and Silver Exchange is not acting as an advisor to you in any way. Dallas Gold and Silver Exchange and its associate companies have no fiduciary duty to your affiliates, associates or family members. Any investment made by you or any of your affiliates, associates or family members must be done after you have conducted careful independent research. Investment in anything has inherent risk. Bullion and Rare Coins are no different and by using this website you agree that all investment decisions are made by you alone.
    </div>
</div>
';

$page = Mage::getModel('cms/page')
    ->load('educational-guides/bullion-rare-coins-investment-guides', 'identifier');
$page->setLayoutUpdateXml('<reference name="left"><block type="wordpress/sidebar_widget_categories" template="wp/education/left_bar.phtml"/></reference>');
$page->setContent($content);
if (!$page->getPageId()) {
    $page->setTitle('Bullion Rare Coins Investment Guides');
    $page->setIdentifier('educational-guides/bullion-rare-coins-investment-guides');
    $page->setRootTemplate('two_columns_left');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

/*watch page*/
$content = '
<div class="row-fuild education">
    <div class="span12">
        <h3 class="education-header">Fine Watches</h3>
    </div>
    <div class="span12">
        <div class="span6">
            <div>
                <a href="{{store url=\'\'}}educational-guides/fine-watches/watch-guide">
                    <img src="{{media url=\'\'}}wysiwyg/fine-watch-educational-guide.jpg"
                         title="Fine Watch Educational Guide" alt="Fine Watch Educational Guide">
                </a>
            </div>
            <div>
                <a href="{{store url=\'\'}}educational-guides/fine-watches/watch-guide">Watch Guide</a>
            </div>
            </a>
        </div>
        <div class="span6">
            <div>
                <a href="{{store url=\'\'}}educational-guides/fine-watches/watch-vocabulary">
                    <img src="{{media url=\'\'}}wysiwyg/fine-watch-vocabulary-guide.jpg"
                         title="Fine Watch Vocabulary Guide" alt="Fine Watch Vocabulary Guide">
                </a>
            </div>
            <div>
                <a href="{{store url=\'\'}}educational-guides/fine-watches/watch-vocabulary">Watch Vocabulary </a>
            </div>
        </div>
    </div>
    <div class="span12 education-bottom">
        Dallas Gold and Silver Exchange has developed the following Watch Guide and Vocabulary List to help our
        customers when they are buying, selling or trading Rolex or other fine watches.
    </div>
</div>
';

$page = Mage::getModel('cms/page')
    ->load('educational-guides/fine-watches-investment-guides', 'identifier');
$page->setLayoutUpdateXml('<reference name="left"><block type="wordpress/sidebar_widget_categories" template="wp/education/left_bar.phtml"/></reference>');
$page->setContent($content);
if (!$page->getPageId()) {
    $page->setTitle('Fine Watches Investment Guides');
    $page->setIdentifier('educational-guides/fine-watches-investment-guides');
    $page->setRootTemplate('two_columns_left');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();
$installer->endSetup();
