<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getTable('helloworld/datatest');

$sql = "create table if not exists {$table}(
            `id` int(11) not null auto_increment,
            `name` varchar(255) not null,
            primary key(`id`)
        )";
$installer->run($sql);

$installer->endSetup();

/*
 * CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)
 */