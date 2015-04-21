<?php
$installer = $this;
$installer->startSetup();

$installer->run("
    ALTER TABLE  `".$this->getTable('manufacturers_products')."`
    ADD COLUMN `position`  int(5) NULL DEFAULT 1 AFTER `product_id`;
");

$installer->endSetup();