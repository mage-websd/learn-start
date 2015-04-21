<?php
/**
 * Change ui home: shipping
 */
$installer = $this;
$installer->startSetup();

/*
 * old Free block right
 * <h5 class="ab_2">FREE SHIPPING<br />on your next order</h5>
   <p class="ab_2">and go in the draw to win a <b>$500 VOUCHER</b>, when you subscribe to our newsletter!</p>
<p>$11.95 Shipping charged on other orders *Conditions apply, click here for details</p>
 *
 * */
$content = <<<EOD
<form id="signup_2" class="bob" action="http://exceedmail.createsend.com/t/y/s/pdhdyi/" method="post">
    <p>FREE SHIPPING for all orders over $400 &  under 10kg</p>
    <p>$11.95 Shipping charged on other orders *Conditions apply, <a href="{{store url="shipping-information"}}">click here for details</a><p>
    <p class="ab_2">and go in the draw to win a <b>$500 VOUCHER</b>, when you subscribe to our newsletter!</p>
    <label for="name">Name</label> <input id="name" type="text" name="cm-name" />
    <label for="pdhdyi-pdhdyi">Email Address</label> <input id="pdhdyi-pdhdyi" type="text" name="cm-pdhdyi-pdhdyi" />
    <button class="button_new button" title="Search" type="submit">
        <span><span>Sign Up</span></span>
    </button>
</form>
EOD;

$block = Mage::getModel('cms/block')->load('newsletter_form');
$block->setContent($content);
if(!$block->getBlockId()) {
    $data = array(
        'title' => 'Body: Newsletter Form',
        'identifier' => 'newsletter_form',
        'is_active' => 1,
        'stores' => array(1),
    );
    $block->setData($data);
}
$block->save();

$installer->endSetup();
