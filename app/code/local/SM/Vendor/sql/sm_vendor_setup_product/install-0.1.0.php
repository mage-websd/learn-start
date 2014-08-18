<?php
/**
 * Add attribute for product
 *
 * @attribute `of vendor``
 */


$installer = $this;
$installer->startSetup();

$installer->addAttribute('catalog_product', 'of_vendor', array(
    'label'         => 'Of Vendor',
    'type'          => 'int',
    'input'         => 'text',
    'visible'       => true,
    'required'      => false,
));

$installer->endSetup();