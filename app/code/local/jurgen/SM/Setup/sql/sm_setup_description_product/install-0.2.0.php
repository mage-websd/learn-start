<?php
/**
* Created by PhpStorm.
* User: Hà
* Date: 13/10/2014
* Time: 2:31 PM
*
* @var $installer Mage_Core_Model_Resource_Setup
* Fix description of product "Eiwitrijke Speculoos dieetkoekjes (7x 3)" : excess tag </div> in description
*/
$installer = $this;

Mage::app()->setUpdateMode(false); // run for function save()
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID); // store admin : default value of attribute

$productName = "Eiwitrijke Speculoos dieetkoekjes (7x 3)";
$product = Mage::getModel('catalog/product')->getCollection()
    ->addAttributeToSelect('description')
    ->addAttributeToFilter('name', array('eq'=>$productName))
    ->getFirstItem();
$productId = $product->getEntityId();
$productDescription = $product->getDescription();
if($product && $productDescription)
{
    if(substr($productDescription, -6) == '</div>')
    {
        $productDescription = substr($productDescription,0,-6);
        $product = Mage::getModel('catalog/product')->load($productId);
        $product->setStoreId(Mage_Core_Model_App::ADMIN_STORE_ID)
            ->setDescription($productDescription)
            ->save();
    }
}

$installer->endSetup();