<?php
/**
 * Created by PhpStorm.
 * User: HaBM
 * Date: 15/01/2015
 * Time: 10:07 PM
 *
 */
$installer = $this;
$installer->startSetup();

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

// Create cms page "Interest Free Shopping"
$identifierCmsPage = 'interest-free-shopping';
$contentCmsPage = <<<'EOD'
<link rel="stylesheet" type="text/css" href="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/zipmoney-css.css" media="all" />
<div style="margin-bottom: 90px;" class="zm-landing-container">
	<div class="zm-one-container" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);height:auto">
		<img src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/banner-Farm-Store.png" alt="">
	</div>
	<div class="zm-two-container">
        <h6 class="zm-got-book zm-zip-so-good">A simple and secure way to pay...</h6>
        <div class="zm-circle-check">
            <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-tick.png">
            <span>No deposit</span>
        </div>
        <div class="zm-circle-check">
            <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-tick.png">
            <span>Quick<br>and simple</span>
        </div>
        <div class="zm-circle-check">
            <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-tick.png">
            <span>6 months<br>interest free*</span>
        </div>
        <div class="zm-circle-check zm-extra">
            <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-tick.png">
            <span>$2,000 credit<br>shop anytime</span>
        </div>
        <div class="zm-circle-check zm-extra">
            <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-tick.png">
            <span>Low and easy<br>monthly payments</span>
        </div>
        <div class="zm-clearfix"></div>
    </div>
	<div class="zm-third-container">
		<h6 class="zm-got-light zm-i-want-zip">I want zipMoney</h6>
		<h6 class="zm-got-bold zm-sim-convent">SIMPLE &amp; CONVENIENT</h6>
		<div class="zm-gray-bot-line"></div>
		<div class="zm-land-three-boxes">
		<div class="zm-got-light zm-land-per-box">
			<img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/applynow.png">
			<b>Simple Application</b> 3 minutes to complete</div>
		<div class="zm-land-per-box zm-arr-green">
			<img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-arrow.png">
		</div>
		<div class="zm-got-light zm-land-per-box">
			<img src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/approved.jpg" alt="" />
			<b>Buy Instantly</b> Get your goods today
			<br>&nbsp;</div>
		<div class="zm-land-per-box zm-arr-green">
			<img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/green-arrow.png">
		</div>
		<div class="zm-got-light zm-land-per-box">
			<img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/girl-fun.png" style="" class="lady">
			<b>More time to pay</b>Relax and enjoy
			<br>&nbsp;</div>
		<div class="zm-clearfix"></div>
	</div>
    <a class="zm-get-pre-btn zm-got-light" href="https://app.zipmoney.com.au/#/?m=27&c=27THEFA48" target="_blank">Get Approved Now</a>
    <a class="zm-get-pre-btn zm-got-light" href="https://www.thefarmstore.com.au/">Apply at Checkout</a>
    <div class="zm-got-book zm-a-desc-sec">A decision in seconds</div>
		<div class="zm-handofsean zm-land-buy-more">Buy more of what you want, and have more time to pay</div>
    </div>
	<div class="zm-fourth-container zm-got-light">
        <div class="zm-land-2-col zm-fourth-first">
            <div style="text-align:center">
                <img alt="" style="margin-bottom: 17.5px;" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/calculator.png">
                <br>
                <span class="zm-land-2col-txt">Fees and charges</span>
            </div>
            <div class="zm-land-2col-inner">
                <div class="zm-per-land2col" style="">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">No deposit required today</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">Pay NO INTEREST for 6 MONTHS on any purchases above $500</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">All other purchases (under $500) enjoy 3 months interest free</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">Minimum monthly repayment of $40 per month or 3% of balance (whichever greater)</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">A one-time sign-up fee of $20 (added to your balance)</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">A small monthly admin fee of $4.95, only if there is a balance owing</div>
                    <div class="zm-clearfix"></div>
                </div>
            </div>
        </div>
        <div class="zm-land-2-col zm-fourth-last">
            <div style="text-align:center">
                <img alt="" style="margin-bottom: 17.5px;" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/lock.png">
                <br>
                <span class="zm-land-2col-txt">Safety and security</span>
            </div>
            <div class="zm-land-2col-inner">
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">Enjoy buyer protection on all purchases made using zipMoney</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">No credit card numbers. No worries!</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">We employ the same encryption as the big banks</div>
                    <div class="zm-clearfix"></div>
                </div>
                <div class="zm-per-land2col">
                    <div class="zm-land2col-check">
                        <img alt="" src="https://d3k1w8lx8mqizo.cloudfront.net/merchants/assets/grey-tick.png">
                    </div>
                    <div class="zm-land2col-txt">We have partnered with global leaders in fraud prevention who count PayPal and eBay as clients</div>
                    <div class="zm-clearfix"></div>
                </div>
            </div>
        </div>
        <div class="zm-clearfix"></div>
        </div>
	<div class="zm-fifth-container">
		<div class="zm-green-txt zm-got-light">You must be an Australian resident,<br>18 years or over and have a job to apply.</div>
		<p class="zm-got-light zm-imp-notice">
			<span class="zm-got-bold">Important Notice</span>
			<br>Available to approved applicants only. Minimum monthly payments of $40 or 3% of the outstanding balance (whichever is greater) are required. Paying only the minimum monthly repayment amount will not pay out the purchase within the interest free period. Any balance outstanding at the expiry of the interest free period will be charged interest at the standard annual percentage rate, currently 23.90%. An establishment fee of $20 applies to your account. A monthly account service fee of $4.95 is applicable while there is a balance outstanding. Lending criteria, terms, conditions, fees and charges apply and are available on application. Credit is provided by zipMoney Pty Ltd (ABN 58 164 440 993), Australian Credit Licence number 441878. Visit <a href="https://www.zipmoney.com.au"> www.zipmoney.com.au </a> to learn more about zipMoney.</p>
	</div>
</div>
EOD;
$cmsPage = Mage::getModel('cms/page')->load($identifierCmsPage);
if($cmsPage->getId())
{
    $cmsPage->setContent($contentCmsPage)->save();
}
else
{
    $dataCmsPage = array(
        'title' => 'Interest Free Shopping',
        'identifier' => $identifierCmsPage,
        'stores' => array(0),
        'root_template' => 'one_column',
        'content' => $contentCmsPage,
        'is_active' => 1
    );
    $cmsPage->setData($dataCmsPage)->save();
}

// Add link in footer: Update static block 'footer-information-block'
$identifierBlock = 'footer-information-block';
$contentFooterBlock = <<<'EOD'
<div class="footer-imformation">
    <div class="footer-links1">
        <ul>
            <li><a href="{{store url=''}}">Home</a></li>
            <li><a href="{{store url='interest-free-shopping'}}">Interest Free</a></li>
            <li><a href="{{store url=''}}customer-service">Customer Service</a></li>
            <li><a href="{{store url=''}}contacts/">Contact Us</a></li>
            <li><a href="{{store url=''}}about-us/">About Us</a></li>
            <li class="last"><a href="customer/account/login/">Log In</a></li>
        </ul>
    </div>
    <div class="footer-links2">
        <li><span>&copy; Copyright 2011 - 2015 The Farm Store</span></li>
        <li><a href="{{store url=''}}">Site Map</a></li>
        <li style="background: none;"><a href="{{store url=''}}">Privacy Policy</a></li>
    </div>
    <p>&nbsp;</p>
</div>
<div class="footer-search"><div class="form-search">{{block type="cms/block" block_id="paymentmethods"}}</div></div>
EOD;
$footerInformationBlock = Mage::getModel('cms/block')->load($identifierBlock);
if($footerInformationBlock->getId())
{
    $footerInformationBlock->setContent($contentFooterBlock)->save();
}
else
{
    $dataStaticBlock = array(
        'identifier' => $identifierBlock,
        'stores' => array(0),
        'content' => $contentFooterBlock,
        'is_active' => 1
    );
    $footerInformationBlock->setData($dataStaticBlock)->save();
}

// Add image in footer: update static block
$identifierBlock = 'paymentmethods';
$contentPaymentMethodBlock = <<<'EOD'
<div class="payment-icon">
    <img src="{{media url="payment-methods/zipmoney.gif"}}" alt="" height="30" />
    <img src="{{media url="payment-methods/visa.gif"}}" alt="" />
    <img src="{{media url="payment-methods/master.gif"}}" alt="" />
    <img src="{{media url="payment-methods/american.gif"}}" alt="" />
    <img src="{{media url="payment-methods/paypal.gif"}}" alt="" />
    <img src="{{media url="payment-methods/westpack.gif"}}" alt="" />
</div>
EOD;
$paymentMethodBlock = Mage::getModel('cms/block')->load($identifierBlock);
if($paymentMethodBlock->getId())
{
    $paymentMethodBlock->setContent($contentPaymentMethodBlock)->save();
}
else
{
    $dataStaticBlock = array(
        'identifier' => $identifierBlock,
        'stores' => array(0),
        'content' => $contentPaymentMethodBlock,
        'is_active' => 1
    );
    $paymentMethodBlock->setData($dataStaticBlock)->save();
}
$installer->endSetup();