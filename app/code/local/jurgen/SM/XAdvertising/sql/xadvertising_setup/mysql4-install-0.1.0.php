<?php
$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('sm_xadvertising')};
CREATE TABLE {$this->getTable('sm_xadvertising')} (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`unique_id`),
  UNIQUE KEY `mail` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
    ");
$installer->endSetup(); 
