<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('sm_xadvertising')} ADD `stores` text default '' AFTER `title`;
    ");

$installer->endSetup();