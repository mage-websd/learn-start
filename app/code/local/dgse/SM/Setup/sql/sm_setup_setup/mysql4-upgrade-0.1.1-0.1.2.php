<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 10/7/14
 * Time: 11:06 AM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

//$_menu_item7 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Jewelry")->getFirstItem();
//if($_menu_item7->getId()){
//    $_menu_item7->setStatus(1)->setRgt(67)->setLft(66)->setCustomClass("ico-menu-jewelry")->save();
//}
//$_menu_item6 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Diamonds")->getFirstItem();
//if($_menu_item6->getId()){
//    $_menu_item6->setStatus(1)->setRgt(89)->setLft(68)->setCustomClass("ico-menu-diamonds")->save();
//}
//$_menu_item5 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Watches")->getFirstItem();
//if($_menu_item5->getId()){
//    $_menu_item5->setStatus(1)->setRgt(92)->setLft(93)->setCustomClass("ico-menu-watches")->save();
//}
//$_menu_item4 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Bullion")->getFirstItem();
//if($_menu_item4->getId()){
//    $_menu_item4->setStatus(1)->setRgt(95)->setLft(92)->setCustomClass("ico-menu-bullion")->save();
//}
//$_menu_item3 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Rare coins")->getFirstItem();
//if($_menu_item3->getId()){
//    $_menu_item3->setStatus(1)->setRgt(99)->setLft(96)->setCustomClass("ico-menu-rare-coins")->save();
//}
//$_menu_item2 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Collectibles")->getFirstItem();
//if($_menu_item2->getId()){
//    $_menu_item2->setStatus(1)->setRgt(107)->setLft(100)->setCustomClass("ico-menu-collectibles")->save();
//}
//$_menu_item1 = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Learning")->getFirstItem();
//if($_menu_item1->getId()){
//    $_menu_item1->setStatus(1)->setRgt(109)->setLft(108)->setCustomClass("ico-menu-learning")->save();
//}
//$_menu_item = Mage::getModel('megamenu/menuitems')->getCollection()->addFieldToSelect("*")->addFieldToFilter("title","Sell")->getFirstItem();
//if($_menu_item->getId()){
//    $_menu_item->setStatus(1)->setRgt(111)->setLft(110)->setCustomClass("ico-menu-sell")->save();
//}
$installer->endSetup();