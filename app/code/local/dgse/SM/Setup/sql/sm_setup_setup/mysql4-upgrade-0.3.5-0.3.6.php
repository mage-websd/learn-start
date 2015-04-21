<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$allenContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Allen,TX</h1>
<p align="left">190 East Stacy Road<br /> Allen, TX 75002<br /> 972-481-3870</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{media url="checklist.pdf"}}" target="_blank">checklist</a> of things we buy.</p>
<p>&nbsp;</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3341.3042620075958!2d-96.6602717!3d33.12737029999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c112a4265cdc9%3A0x10ed7d0230444652!2s190+E+Stacy+Rd+%23216%2C+Allen%2C+TX+75002%2C+USA!5e0!3m2!1sen!2s!4v1415245390615" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$arlingtonContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Arlington, TX</h1>
<p align="left">1109 West I-20<br />Arlington, TX 76017<br /> 817-505-1005</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3358.3006860389087!2d-97.12478949999999!3d32.6780489!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e62c33695cddb%3A0x5568bea0a5f171e8!2s1109+W+Interstate+20%2C+Arlington%2C+TX+76017%2C+USA!5e0!3m2!1sen!2sus!4v1415245567533" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$dallasalphaContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Dallas, TX</h1>
<p align="left">13534 Preston Road<br /> Dallas, TX 75240<br /> 972-481-3850</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3348.728236196514!2d-96.8031805!3d32.931777700000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c20e4ca416405%3A0x91542f7ba74d7ad4!2s13534+Preston+Rd%2C+Dallas%2C+TX+75240%2C+USA!5e0!3m2!1sen!2s!4v1417516339519" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$dallascenterContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Dallas, TX</h1>
<p align="left">6174 Sherry Lane <br />Dallas, TX 75225<br /> 972-481-3800</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3351.369363688493!2d-96.80478749999999!3d32.861945399999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e9e4516df4e49%3A0xa514c1984a17e84c!2s6174+Sherry+Ln%2C+Dallas%2C+TX+75225%2C+Hoa+K%E1%BB%B3!5e0!3m2!1svi!2sus!4v1415246282258" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$dallasroyalContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Dallas, TX</h1>
<p align="left">11311 Reeder Road<br /> Dallas, TX 75229 <br /> 972-484-3662</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3350.1880234483783!2d-96.8967562!3d32.8931967!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c278b9fde66bb%3A0x4c3c7b98e8dcc9db!2s11311+Reeder+Rd%2C+Dallas%2C+TX+75229%2C+USA!5e0!3m2!1sen!2sus!4v1415246159693" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$eulessContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span3">
<h1>Euless, TX</h1>
<p align="left">1201 Airport Freeway<br /> Euless, TX 76040<br /> 817-283-4460</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span5"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3352.3519440541704!2d-97.101913!3d32.835932!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e7fd25b6862d7%3A0xddf81f163f426c4c!2s1201+Airport+Fwy%2C+Euless%2C+TX+76040%2C+USA!5e0!3m2!1sen!2sus!4v1415246431871" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;
$southlakeContent = <<<EOD
<div class="location-page clearfix">
<div class="row-fluid">
<div class="location-desc span4">
<h1>Southlake, TX</h1>
<p align="left">200 N. Kimball Ave. #205<br /> Southlake, TX 76092<br /> 817-722-0075</p>
<h2>Hours</h2>
<p align="left">Monday: 10AM - 6PM<br /> Tuesday: 10AM - 6PM<br /> Wednesday: 10AM - 6PM<br /> Thursday: 10AM - 6PM<br /> Friday: 10AM - 6PM<br /> Saturday: 10AM - 4PM<br /> Sunday: Closed</p>
<p>No appointment necessary. <br /> Before you go - print our <a href="{{config path="web/unsecure/base_url"}}checklist.pdf" target="_blank">checklist</a> of things we buy.</p>
</div>
<div class="location-image span4"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3348.3390540324626!2d-97.11905240000002!3d32.9420567!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864dd4eb68960ee1%3A0xe27006d508c022ff!2s200+N+Kimball+Ave%2C+Southlake+Corners%2C+Southlake%2C+TX+76092%2C+Hoa+K%E1%BB%B3!5e0!3m2!1svi!2s!4v1415332624038" frameborder="0" width="430" height="430"></iframe></div>
{{block type="core/template" block_id="location_form" template="location/form.phtml"}}</div>
</div>
EOD;

//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'allen')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'arlington')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'dallas_preston_alpha')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', '')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'dallas_royal')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'euless')->getFirstItem()->getId();
//$allenId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'southlake')->getFirstItem()->getId();
$cmsPage = Mage::getModel('cms/page');
$cmsPage->load('allen', 'identifier')->setContent($allenContent)->save();
$cmsPage->load('arlington', 'identifier')->setContent($arlingtonContent)->save();
$cmsPage->load('dallas_preston_alpha', 'identifier')->setContent($dallasalphaContent)->save();
$cmsPage->load('dallas_preston_center', 'identifier')->setContent($dallascenterContent)->save();
$cmsPage->load('dallas_royal', 'identifier')->setContent($dallasroyalContent)->save();
$cmsPage->load('euless', 'identifier')->setContent($eulessContent)->save();
$cmsPage->load('southlake', 'identifier')->setContent($southlakeContent)->save();

$installer->endSetup();