<?php

$installer = $this;
$installer->startSetup();

/* Create table sm_blog_entity */

$table = $installer->getConnection()
    ->newTable($installer->getTable('sm_youtube/youtube'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Entity ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'title')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Image')
    ->addColumn('link', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Link')
    ->addColumn('order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
    ), 'Order')
    ->addColumn('active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
    ), 'Active')
;
$installer->getConnection()->createTable($table);

$installer->endSetup();

