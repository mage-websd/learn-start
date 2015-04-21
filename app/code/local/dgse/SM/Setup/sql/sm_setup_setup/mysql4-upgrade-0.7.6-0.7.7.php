<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<div id="sell-page">
<div class="row-fluid sell-main">
<div class="head-sell span12">Sell to DGSE</div>
</div>
{{block type="cms/block" block_id="sell-subpage-menu"}}
<div class="row-fluid sell-main"><!-- div include left and right -->
<div class="left-sell span6"><!-- left sell -->
<div class="text-sell"><span><span>Since 1978, Dallas Gold &amp; Silver Exchange has paid top dollar for North Texans' gold, silver, jewelry, rare coins and more. We've been recognized numerous times as the highest paying buyer in Metroplex and we're proud to have thousands of customers who enthusiastically recommend us. We have an A+ Better Business Bureau rating. We're publicly-traded, trusted, and we offer a fast and easy selling process.</span></span>
<ul>
<li>No appointment needed - just stop into any of our SEVEN Metroplex stores (map of stores&nbsp; <a title="Map store" href="https://www.google.com/maps/place/Metroplex+Gymnastics+&amp;+Swim/@33.090638,-96.672236,17z/data=!3m1!4b1!4m2!3m1!1s0x864c175036973a55:0x9d95c96174a79c60" target="_blank">here</a>).</li>
<li>Quick offer for your items - you'll usually have an offer in 10 minutes or less.</li>
<li>No pressure - our offers speak for themselves.</li>
<li>Immediate payment in cash or check - your choice.</li>
<li>No amount too small - every day, we have people that sell old gold or silver for just $5 or $10 - maybe earning backs or broken pieces.</li>
<li>No amount too large - we're publicly-traded and have the ability to purchase large estate and other collections up to and over $10 Million.</li>
<li>We'll explain the process - we examine pieces for purity, weigh them, then base our offer on current precious metal prices.</li>
<li>If you are unable to visit our multiple DFW locations you can send us your valuables in an easy-to-use, insured mailer by visiting our sister company&nbsp;<a title="American Gold &amp; Silver Exchange" href="http://www.americangoldandsilverexchange.com/" target="_blank">American Gold &amp; Silver Exchange</a>.</li>
</ul>
</div>
</div>
<!-- // end left sell -->
<div class="right-sell span6"><!-- // right sell --> {{block type="core/template" template="sell/form.phtml"}}</div>
<!-- // end right sell --></div>
<!-- //end div include left and right --></div>
EOT;
Mage::getModel('cms/page')->load('sell', 'identifier')->setContent($content)->save();

$installer->endSetup();