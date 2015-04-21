<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/*change name menu*/
$resource = Mage::getModel('core/resource');
$connect = $resource->getConnection('core_read');
$connectWrite = $resource->getConnection('core_write');
$table = $resource->getTableName('megamenu/menuitems');

//$connectWrite->update($table, array('title'=>'Eternity Bands'), array('title'=>'Eternity Band'));
$query = 'UPDATE '.$table . ' SET title="Eternity Bands" WHERE title="Eternity Band" and depth="3"';
$connectWrite->query($query);

$installer->endSetup();