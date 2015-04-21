<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOT
<table class="fondo_bullion" style="width: 100%;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center">
<div class="header_coin"><span id="ctl00_Content_Central_lblNameCoin" style="color: #7f6c31; font-size: 13pt; font-weight: bold;">Gold Australian Koala</span></div>
</td>
</tr>
<tr>
<td align="center"><img id="ctl00_Content_Central_ImgBullionCoin" style="border-width: 0px;" src="{{media url="wysiwyg/GetBullionImage_11_.jpg"}}" alt="Gold Australian Koala Coin" /></td>
</tr>
<tr>
<td>
<div class="text_description">
<div><strong>The Platinum Australian Koala</strong> is one of the most popular platinum issues in the world. The Platinum Australian Koala features the portrait of Queen Elizabeth II on the obverse, while on the reverse depicts a design of the koala which changes annually. <br /> </div>
</div>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" height="62">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
EOT;

Mage::getModel('cms/page')->load('platinum-australian-kangaroo', 'identifier')
    ->setContent($content)
    ->setIdentifier('platinum-australian-koala')
    ->save();
$installer->endSetup();