<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOT
<div class="row-fluid sell-main">
<div class="head-sell span12">Employment</div>
</div>
<p>Dallas Gold &amp; Silver Exchange is always looking for motivated, exceptional employees to join our team. We offer competitive pay, paid training, medical/dental/vision, vacation, profit sharing and more &ndash; all in a professional, fast-paced environment where performance is rewarded.</p>
<p align="center"><img title="jobs" src="{{media url="wysiwyg/m.png"}}" alt="" /></p>
<p>If you have experience in retail sales, precious metals, rare coins or jewelry; we&rsquo;d love to talk to you!</p>
<p>Please send a current resume along with a description of what type of position you&rsquo;re looking for to <a class="contact-link" href="mailto:jobs@dgse.com">Jobs@dgse.com</a>.</p>
<p>DGSE Companies, Inc. is an Equal Opportunity Employer. This company does not and will not discriminate in employment and personnel practices on the basis of race, sex, age, handicap, religion, sexual orientation, national origin or any other basis prohibited by applicable law. Hiring, transferring and promotion practices are performed without regard to the above listed items.</p>
EOT;

Mage::getModel('cms/page')->load('employment', 'identifier')->setContent($content)->save();
$installer->endSetup();