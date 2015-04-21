<?php
/**
 * Created by PhpStorm.
 * User: GiangSoda
 * Date: 10/6/14
 * Time: 3:54 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup
Create block content sell
 */
$installer = $this;
$installer->startSetup();

if(!Mage::registry('isSecureArea')) {
    Mage::register('isSecureArea', 1);
}
Mage::app()->setUpdateMode(false);

$baseUrl = Mage::app()->getStore(Mage::app()->getStore()->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
/* cms page education */
$content = '
<div class="row-fuild education">
    <div class="span12">
        <span>Dallas Gold &amp; Silver Exchange has developed the following Educational Guides so that our clients can make informed decisions when buying or selling Fine Jewelry, Watches, Wedding Jewelry, Diamonds, Precious Metals, Rare Coins and more.</span>
    </div>
    <div class="span12">
        <div class="span6">
            <h3><a href="{{store url=\'\'}}blog/category/educational-guides/jewelry">Engagement Rings</a></h3>
            <a href="{{store url=\'\'}}blog/category/educational-guides/jewelry">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/engagement-rings.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>The experts at Dallas Gold & Silver Exchange have developed this <a href="{{store url=\'\'}}blog/category/educational-guides/jewelry">Guide to Purchasing an Engagement Ring</a> to help you through this exciting process. Topics covered include: setting a budget, educating yourself about diamonds, choosing a ring setting and picking a jeweler.</span>
            </div>
        </div>

        <div class="span6">
            <h3><a href="{{store url=\'\'}}blog/category/educational-guides/diamonds">Diamonds</a></h3>
            <a href="{{store url=\'\'}}blog/category/educational-guides/diamonds">
                <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/diamonds.jpg\'}}">
            </a>

            <div class="content-short-description">
                <span>Choosing a diamond can seem like a daunting task but with the information in our <a href="{{store url=\'\'}}blog/category/educational-guides/diamonds">Diamond Guide</a> and help from the knowledgeable experts at Dallas Gold & Silver Exchange it will be an enjoyable experience.</span>
            </div>
        </div>

        <div class="span12">
            <div class="span6">
                <h3><a href="{{store url=\'\'}}blog/category/educational-guides/bullion-rare-coins">Bullion & Rare Coins</a></h3>
                <a href="{{store url=\'\'}}blog/category/educational-guides/bullion-rare-coins">
                    <img title="Engagement Rings" alt="Engagement Rings"
                         src="{{media url=\'wysiwyg/bullion-rare-coins.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has compiled the following <a href="{{store url=\'\'}}blog/category/educational-guides/bullion-rare-coins">Investor Guides</a> to help you make an informed decision when buying or selling Bullion, Rare Coins and Currency.</span>
                </div>
            </div>

            <div class="span6">
                <h3><a href="{{store url=\'\'}}blog/category/educational-guides/fine-watches">Fine Watches</a></h3>
                <a href="{{store url=\'\'}}blog/category/educational-guides/fine-watches">
                    <img title="Engagement Rings" alt="Engagement Rings" src="{{media url=\'wysiwyg/fine-watches.jpg\'}}">
                </a>

                <div class="content-short-description">
                    <span>Dallas Gold & Silver Exchange has the largest selection of fine watches in Dallas. <a href="{{store url=\'\'}}blog/category/educational-guides/fine-watches">Our Fine Watch Educational Guide</a> helps answer your questions about these magnificent time pieces.</span>
                </div>
            </div>
        </div>
    </div>
</div>
';

$page = Mage::getModel('cms/page')
    ->load('educational-guides','identifier');
    $page->setLayoutUpdateXml('<reference name="left"><block type="wordpress/sidebar_widget_categories" template="wp/education/left_bar.phtml"/></reference>');
$page->setContent($content);
if(!$page->getPageId()) {
    $page->setTitle('Educational Guides');
    $page->setIdentifier('educational-guides');
    $page->setRootTemplate('two_columns_left');
    $page->setStores(array(0));
    $page->setIsActive(1);
}
$page->save();

/*setup category wp*/
$wpDatabase = Mage::helper('wordpress/database');
$read = $wpDatabase->getReadAdapter();
$write = $wpDatabase->getWriteAdapter();

$educationCategory = Mage::getModel('wordpress/post_category')->getCollection()
    ->addSlugFilter('educational-guides')
    ->getFirstItem();
if($educationCategory->getTermId()) {
    $educationCategoryId = $educationCategory->getTermId();
    $tableTeta = $wpDatabase->getTableName('wordpress/term_taxonomy');
    $tableTe = $wpDatabase->getTableName('wordpress/term');

    $arrayChild = array('bullion-rare-coins','diamonds','fine-watches','jewelry');
    foreach($arrayChild as $child) {
        $query = 'SELECT teta.term_id FROM '.$tableTe. ' AS main_table '.
            ' JOIN '.$tableTeta.' AS teta ON main_table.term_id = teta.term_id'.
            ' WHERE slug="'.$child.'" AND taxonomy="category" LIMIT 1';
        $result = $read->fetchOne($query);
        if($result) {
            $query = "UPDATE {$tableTeta} SET parent='{$educationCategoryId}' WHERE ".
                " term_id='{$result}'";
        }
        try{
            $read->query($query);
        }
        catch(Exception $e) {
            throw new Exception($e);
        }

    }
}

/* setup blog page*/
Mage::getModel('core/config')->saveConfig('wordpress/integration/route','blog');
Mage::getModel('core/config')->saveConfig('wwordpress/toplink/label','Blog');

Mage::getModel('wordpress/option')->loadByName('home')->setOptionValue($baseUrl.'blog')->save();
Mage::getModel('wordpress/option')->loadByName('blogname')->setOptionValue('Blog')->save();


/* setup menu */
$groupId = 6;
$menuLearning= Mage::getModel('megamenu/menuitems')->getCollection()
    ->addFieldToFilter('title','Learning')
    ->addFieldToFilter('group_id',$groupId)
    ->addFieldToFilter('depth','1');
if(count($menuLearning) == 1) {
    $menuLearning = $menuLearning->getFirstItem();

    $menuLearning->setDataType($baseUrl.'educational-guides')->save();
    $menuLearningId = $menuLearning->getId();

    $itemId = $menuLearningId;
    $data = $menuLearning->getData();
    $lft = intval($data['rgt']);
    $rgt = intval($data['rgt'])+1;
    $depth =  intval($data['depth'])+1;
    $nametable = Mage::getModel('megamenu/menuitems')->getCollection()->getTable('menuitems');

    $menuChild = array('Video'=>'extras','Blog'=>'blog','Educational Guides'=>'educational-guides',);
    foreach($menuChild as $titleMenu => $urlMenu) {
        $menu = Mage::getModel('megamenu/menuitems')->getCollection()
            ->addFieldToFilter('title',$titleMenu)
            ->addFieldToFilter('group_id',$groupId)
            ->addFieldToFilter('depth',$depth);
        if(count($menu) == 0) {
            $menu = Mage::getModel('megamenu/menuitems')
                ->setData(array(
                    'title' => $titleMenu,
                    'show_title' => 1,
                    'status' => 1,
                    'align' => 1,
                    'show_as_group' => 1,
                    'parent_id' => $menuLearningId,
                    'depth' => $depth,
                    'group_id' => $groupId,
                    'cols_nb' => 12,
                    'target' => 3,
                    'type' => 2,
                    'data_type' => $baseUrl . $urlMenu,
                    'rgt' => $rgt,
                    'lft' => $lft,
                ));
            $menu->save();
            Mage::helper('megamenu')->updateRSide($menu->getId(), $groupId, $nametable, $menu->getLft());
        }
    }
}

$installer->endSetup();