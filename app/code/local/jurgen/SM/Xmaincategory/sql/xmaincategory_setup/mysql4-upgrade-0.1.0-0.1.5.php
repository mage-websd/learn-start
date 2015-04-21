<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    ALTER TABLE `{$installer->getTable('xmaincategory')}`
    ADD `store_id` int(11) unsigned;
");
$installer->endSetup();
