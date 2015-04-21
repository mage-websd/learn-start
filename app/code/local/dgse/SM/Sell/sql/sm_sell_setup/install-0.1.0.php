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

$content = '
<div id="sell-page">
<div class="sell-banner"><img src="{{media url="wysiwyg/sl3-img1.jpg"}}" alt="" /></div>
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="head-sell">Sell to Dgse</div>
<div class="text-sell"><span><span>Since 1978, Dallas Gold &amp; Sliver Exchange has paid top dollar for North Texans\' gold, sliver, jewelry, rare coins and more. We\'ve been recognized numerous times as the hightest paying buyer in Metroplex and we\'re proud to have thousands of customers who enthusiastically recommend us. We have an A+ Better Business Bureau rating, we\'re publicly-traded, trusted, and we offer a fast and esay selling process. No appointment needed - just stop into any of our EIGHT Metroplex stores (map of stores here)</span></span>
<ul>
<li>Quick appraisal and offer for your items - you\'ll usually have an offer in 10 minutes or less.</li>
<li>No pressure - our offers speak for themselves, we don\'t pressure anyone.</li>
<li>Immediate payment in cash or check - your choice</li>
<li>No amount too small - every day, we have people that sell old gold or silver for just $5 or $10 - maybe earning backs or broken pleces.</li>
<li>No amount too large - we\'re publicly-traded and have the ablitity to purchse large estate and other collections up to and over %10 Million.</li>
<li>We\'ll explain the process - we examine pieces for purity, weigh them then base prices on our rent gold/silver prices.</li>
<li>AGSE - if you are unable to visit our multiple DFW locations in person you can send us your valuables in an Ease-to-use, insured maller by visiting our sister compayny American Gold &amp; Silver Exchange.</li>
</ul>
</div>
</div>
<!-- // end left sell -->
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
<!-- end sell page -->';

$page = Mage::getModel('cms/page')
    ->load('sell','identifier');
if(!$page->getPageId()) {
    $page = Mage::getModel('cms/page');
    $page->setContent($content);
    $page->setTitle('Sell');
    $page->setIdentifier('sell');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
    $page->save();
}

$installer->endSetup();