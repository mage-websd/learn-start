<?php
$installer = $this;
$installer->startSetup();

$footerBlocks = array('footer_links','footerbox_fr_fr','footerbox_fr_en','footer_box','footer_fr');

foreach ($footerBlocks as $blockName) {
    $block = Mage::getModel('cms/block')->load($blockName);
    $content = str_replace('contact-us','contacts',$block->getContent());
    $block->setContent($content);
    $block->save();
}

$installer->endSetup();