<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$cmsContent = <<<EOT
<p>&nbsp;</p>
<table style="width: 650px; font-size: 15px;" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF">
<tbody>
<tr>
<td><img src="{{media url="wysiwyg/survey_top.jpg"}}" alt="" width="800" height="285" /></td>
</tr>
<tr>
<td>
<p align="center"><span class="style1">Please select the type of transaction you had at Dallas Gold &amp; Silver Exchange:</span></p>
<p align="center"><img src="{{media url="wysiwyg/website-survey.jpg"}}" alt="" width="650" height="426" usemap="#Map" /></p>
<p class="style1" align="center">As always, feel free to contact us via email at info@dgse.com <br /> or call 972.484.3662 to speak with a manager.</p>
<p class="style1" align="center">THANK YOU!</p>
</td>
</tr>
<tr>
<td>
<div align="center"><img src="{{media url="wysiwyg/DGSE_logo-goldbug.jpg"}}" alt="" width="250" height="103" /></div>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><map id="Map" name="Map">
<area shape="rect" coords="13,12,147,126" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/purchase_jewelry_survey.html" target="_self" />

<area shape="rect" coords="177,12,314,131" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/purchase_rc_survey.html" />

<area shape="rect" coords="335,12,468,128" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/purchase_bullion_survey.html" />

<area shape="rect" coords="497,13,629,129" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/purchase_rolex_survey.html" />

<area shape="rect" coords="14,150,148,263" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/sale_jewelry_survey.html" />

<area shape="rect" coords="179,150,315,265" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/sale_rc_survey.html" />

<area shape="rect" coords="336,150,471,264" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/sale_bullion_survey.html" />

<area shape="rect" coords="497,150,634,268" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/sale_rolex_survey.html" />

<area shape="rect" coords="14,288,147,403" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/website_survey.html" />

<area shape="rect" coords="178,289,313,404" href="{{config path="web/unsecure/base_url"}}survey-content?link=http://dgse.com/survey/nobusiness_survey.html" />
</map></p>
EOT;

$pageId = $collection = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', 'survey')->getFirstItem()->getId();
if ($pageId) {
    $page = Mage::getModel('cms/page')->load($pageId);
    $page->delete();
}

$cmsPageData = array(
    'title' => 'Survey',
    'root_template' => 'one_column',
    'identifier' => 'survey',
    'status' => 1,
    'stores' => array(0),
    'layout_update_xml' => '',
    'content' => $cmsContent,
);
Mage::getModel('cms/page')->setData($cmsPageData)->save();
$installer->endSetup();