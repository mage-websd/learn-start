<?php
/**
 * Created by PhpStorm.
 * User: kien
 * Date: 9/26/14
 * Time: 3:55 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$content = <<<EOT

This is the content of alt tag.

EOT;

$cmsBlock = Mage::getModel('cms/block')->load('alt-tag-image', 'identifier');
if ($cmsBlock->isObjectNew()) {
    $cmsBlock->setIdentifier('alt-tag-image')
        ->setStores(array(0))
        ->setIsActive(true)
        ->setTitle('Alt tag');
}
$cmsBlock->setContent($content)
    ->save();

$installer->endSetup();