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

$registryData = array(
    array(
        'name' => 'user1',
    ),
    array(
        'name' => 'user2',
    ),
    array(
        'name' => 'user3',
    ),
    array(
        'name' => 'user4',
    ),
);
/*$model = Mage::getModel('helloworld/datatest');
foreach ($registryData as $data) {
        $model->setData('name',$data['name'])
        //->addData($data)
        //->setStoreId($data['store_id'])
        ->save();
}
*/
$sql = '';
foreach($registryData as $data) {
    $sql .= "insert into {$table} (`id`,`name`) values (null,'".$data['name']."');";
}
$installer->run($sql);

$installer->endSetup();

/*
 * CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)
 */