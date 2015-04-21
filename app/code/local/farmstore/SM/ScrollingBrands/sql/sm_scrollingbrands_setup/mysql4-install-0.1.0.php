<?php
/**
 * Created by PhpStorm.
 * User: Hà
 * Date: 25/12/2014
 * Time: 1:42 PM
 */
$installer = $this;
$installer->startSetup();

$contentBrandsStaticBlock = <<<'EOD'
<div class="featured-slider">
<script src="{{skin url='js/jquery.jcarousel.min.js'}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{skin url='css/jcarousel.css'}}" />
<script type="text/javascript">
// <![CDATA[
    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            auto: 5,
            wrap: 'circular',
            buttonNextHTML: null,
            buttonPrevHTML: null
        });
    });
// ]]>
</script>
<div id="wrap">
    <div class="scroller-heading">Brands</div>
        <ul id="mycarousel" class="jcarousel-skin-tango">
            {{block type="sm_scrollingbrands/brands" block_id="homepage_copy_block" template="scrollingbrands/scrolling_brands.phtml"}}
        </ul>
    </div>
</div>
<div style="clear:both">&nbsp;</div>
EOD;

$identifierBrandsStaticBlock = 'featured_brand';
$brandsBlock = Mage::getModel('cms/block')->load($identifierBrandsStaticBlock);
if($brandsBlock->getId())
{
    $brandsBlock->setContent($contentBrandsStaticBlock)
        ->save();
}
else
{
    $dataBrandsStaticBlock = array(
        'identifier' => $identifierBrandsStaticBlock,
        'store' => array(0),
        'content' => $contentBrandsStaticBlock,
        'is_active' => 1
    );
    $brandsBlock->setData($dataBrandsStaticBlock)
        ->save();
}
$installer->endSetup();