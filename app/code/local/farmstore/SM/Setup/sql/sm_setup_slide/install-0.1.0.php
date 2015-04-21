<?php
/**
 * setup slider - add 6 slide
 */
/* @var  Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/*hero banner manager*/
$identifier = 'home-hero-banner';
$content = '
<div class="home-content-hero-banner">
<script src="{{skin url="js/exceed/tabs.js"}}"></script>
    <div class="home-banner">
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td valign="top">
                        <div id="panelContainer">
                            <div id="1" class="tab_content">{{block type="cms/block" block_id="hero-banner-1"}}</div>
                            <div id="2" class="tab_content">{{block type="cms/block" block_id="hero-banner-2"}}</div>
                            <div id="3" class="tab_content">{{block type="cms/block" block_id="hero-banner-3"}}</div>
                            <div id="4" class="tab_content">{{block type="cms/block" block_id="hero-banner-4"}}</div>
                            <div id="5" class="tab_content">{{block type="cms/block" block_id="hero-banner-5"}}</div>
                            <div id="6" class="tab_content">{{block type="cms/block" block_id="hero-banner-6"}}</div>
                            <div class="BannerControl"><!-- Controller -->
                                <ul id="tabContainer">
                                    <li class="first"><a class="tabs_on" title="1" href="#1"><span class="count">1</span></a></li>
                                    <li><a class="tabs_off" title="2" href="#2"><span class="count">2</span></a></li>
                                    <li><a class="tabs_off" title="3" href="#3"><span class="count">3</span></a></li>
                                    <li><a class="tabs_off" title="4" href="#4"><span class="count">4</span></a></li>
                                    <li><a class="tabs_off" title="5" href="#5"><span class="count">5</span></a></li>
                                    <li><a class="tabs_off" title="6" href="#6"><span class="count">6</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<script type="text/javascript">// <![CDATA[
 exceedTabs.addTabs("tabContainer", "panelContainer");
// ]]></script>
</div>
';
$slider = Mage::getModel('cms/block')->load($identifier);
$slider
    ->setStores(array(0))
    ->setData('is_active',1)
    ->setData('content',$content)
    ->setData('title',$identifier);
if(!$slider->getId()) {
    $slider->setData('identifier',$identifier);
}
$slider->save();

/*cms block slide*/
/*add 6 banner*/
for($i = 1 ; $i <= 6 ; $i++) {
    $identifier = 'hero-banner-'.$i;
    $url = '';
    switch($i){
        case 1:
            $url = 'shipping-infomation';
            break;
        case 2:
            $url = 'animal-farming-equipment-brands-1/brands-a-f/cashel';
            break;
        default:
            $url = '#'.$i;
    }
    $content = '
    <a href="{{store url="'.$url.'"}}">
        <img src="{{media url="wysiwyg/herobanner/farm'.$i.'.jpg"}}" alt="" />
    </a>';
    $slide = Mage::getModel('cms/block')->load($identifier);
    $slide
        ->setStores(array(0))
        ->setData('is_active',1)
        ->setData('content',$content)
        ->setData('title',$identifier);
    if(!$slide->getId()) {
        $slide->setData('identifier',$identifier);
    }
    $slide->save();
}
$installer->endSetup();