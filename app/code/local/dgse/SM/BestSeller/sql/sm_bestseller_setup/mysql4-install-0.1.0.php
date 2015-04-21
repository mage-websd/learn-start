<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/7/14
 * Time: 11:06 AM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$bestSellerPage = array(
    'title' => 'Best Seller',
    'root_template' => 'one_column',
    'identifier' => 'best-seller',
    'content_heading' => ' Best Seller Products',
    'stores' => array(0),
    'content' => '{{block type="sm_bestseller/list" template="catalog/product/bestseller.phtml"}}'
);

Mage::getModel('cms/page')->setData($bestSellerPage)->save();
$installer->endSetup();