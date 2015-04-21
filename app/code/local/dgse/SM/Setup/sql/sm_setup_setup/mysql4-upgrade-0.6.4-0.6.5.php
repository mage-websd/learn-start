<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = '
<p>&nbsp;</p>
<table style="width: 650px; font-size: 15px;" border="0" cellspacing="0" cellpadding="5" align="center"
       bgcolor="#FFFFFF">
    <tbody>
    <tr>
        <td><img src="{{media url="wysiwyg/survey_top.jpg"}}" alt="" width="800" height="285" /></td>
    </tr>
    <tr>
        <td>
            <p align="center"><span class="style1">Please select the type of transaction you had at Dallas Gold &amp; Silver Exchange:</span>
            </p>

            <p align="center"><img src="{{media url="wysiwyg/website-survey.jpg"}}" alt="" width="650" height="426"
                usemap="#Map" /></p>

            <p class="style1" align="center">As always, feel free to contact us via email at info@dgse.com <br/> or call
                972.484.3662 to speak with a manager.</p>

            <p class="style1" align="center">THANK YOU!</p>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><img src="{{media url="wysiwyg/DGSE_logo-goldbug.jpg"}}" alt="" width="250"
                height="103" />
            </div>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
    <map id="Map" name="Map">
        <area shape="rect" coords="13,12,147,126" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=a501fa00e625432495c92eaefbf1cd56" target="_self" />

        <area shape="rect" coords="177,12,314,131" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=e9944aa339ee4405b7caa30a991d9fae" />

        <area shape="rect" coords="335,12,468,128" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=7e1774bb95484964b1c3b723cef34274" />

        <area shape="rect" coords="497,13,629,129" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=8ef991a18d5a4d3da1bb01f2ffd0e54b" />

        <area shape="rect" coords="14,150,148,263" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=49fa4ef2d04b473792692731608a3fb9" />

        <area shape="rect" coords="179,150,315,265" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=eb1369dcfb254c7aa558961f8adf5feb" />

        <area shape="rect" coords="336,150,471,264" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=06ec0ecad40945719bb731ee3f4067e3" />

        <area shape="rect" coords="497,150,634,268" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=af41720394d84d32b0e19ff47dc0aaea" />

        <area shape="rect" coords="14,288,147,403" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=180c8a299c3b454ca2667fb280ebf0b1" />

        <area shape="rect" coords="178,289,313,404" href="{{config path="web
        /unsecure/base_url"}}survey-content?link=http://dgse.checkboxonline.com/Survey.aspx?s=36cc516e21444b67899141055eb5c426" />
    </map>
</p>
';

$page = Mage::getModel('cms/page')->load('survey', 'identifier')
    ->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Survey');
    $page->setIdentifier('survey');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

$content = '
<table style="width: 650px;" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF">
<tbody>
<tr>
<td>
<div align="center"><img src="{{media url="wysiwyg/survey_top.jpg"}}" alt="" width="800" height="285" /></div>
</td>
</tr>
<tr>
<td>
<p align="center">{{block type="core/template" template="sm/survey.phtml"}} &nbsp;</p>
<p class="style1" align="center">As always, feel free to contact us via email at info@dgse.com <br /> or call 972.484.3662 to speak with a manager.</p>
<p class="style1" align="center">THANK YOU!</p>
</td>
</tr>
<tr>
<td>
<div align="center"><img src="{{media url="wysiwyg/DGSE_logo-goldbug.jpg"}}" alt="" width="250" height="103" /></div>
</td>
</tr>
</tbody>
</table>
';

$page = Mage::getModel('cms/page')->load('survey-content', 'identifier')
    ->setContent($content)
    ->setData('layout_update_xml','');
if(!$page->getPageId()) {
    $page->setTitle('Survey Page');
    $page->setIdentifier('survey-content');
    $page->setRootTemplate('one_column');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();
$installer->endSetup();