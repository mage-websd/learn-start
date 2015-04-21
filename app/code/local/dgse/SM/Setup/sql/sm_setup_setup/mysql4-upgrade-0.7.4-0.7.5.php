<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT
<p><span>For maps and details about any of the nine D/FW Dallas Gold Silver Exchange locations, please click one of the yellow markers on the map below. To reach us by phone, call (972) 484-3662. To contact us via email, please complete the form to the right of this page</span></p>
<p align="center"><img src="{{media url="wysiwyg/contact-maps.jpg"}}" alt="" width="650" height="443" usemap="#Map" border="0" /> <map id="Map" name="Map">
<area title="Southlake" shape="rect" coords="174,130,224,180" href="southlake" alt="Southlake" />

<area title="Euless" shape="rect" coords="224,252,274,302" href="euless" alt="Euless" />

<area title="Arlington" shape="rect" coords="234,349,284,399" href="arlington" alt="Arlington" />

<area title="Dallas (I-35 and Royal)" shape="rect" coords="409,187,451,229" href="dallas_royal" alt="Dallas (I-35 and Royal)" />

<area title="Dallas (Preston Center)" shape="rect" coords="454,216,492,253" href="dallas_preston_center" alt="Dallas (Preston Center)" />
 
<area title="Dallas (Preston and Alpha)" shape="rect" coords="462,138,507,180" href="dallas_preston_alpha" alt="Dallas (Preston and Alpha)" />

<area title="Allen" shape="rect" coords="554,38,599,80" href="allen" alt="Allen" />
 </map> <br /> <br /> Or select from the following locations:</p>
<p align="center"><a href="dallas_preston_center" target="_parent">Dallas (Preston Center)</a> | <a href="dallas_royal" target="_parent">Dallas (I-35 &amp; Royal)</a> | <a href="dallas_preston_alpha" target="_parent">Dallas (Preston &amp; Alpha)</a><br /> <a href="allen" target="_parent">Allen</a> | <a href="euless" target="_parent">Euless</a> | <a href="arlington" target="_parent">Arlington</a> | <a href="southlake" target="_parent">Southlake</a></p>
<h3>Customer Satisfaction</h3>
<p>How was your experience? Click <a class="contact-link" href="{{store direct_url="survey"}}"> here.</a> to complete an online survey.</p>
<h3>Investor Relations</h3>
<p>To subscribe to DGSE Companies, Inc. Investor Email Alerts to receive important investor news and press releases via email, please email <a class="contact-link" href="mailto:investorrelations@dgse.com"> investorrelations@dgse.com</a> with your full name and preferred email address.</p>
<h3>Employment</h3>
<p>Looking for employment?<a class="contact-link" href="{{store direct_url="employment"}}"> Click here.</a></p>
EOT;

Mage::getModel('cms/block')->load('contact-map', 'identifier')->setContent($content)->save();
$installer->endSetup();