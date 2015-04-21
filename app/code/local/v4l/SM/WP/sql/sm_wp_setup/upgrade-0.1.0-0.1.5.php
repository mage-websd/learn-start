<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 23/01/2015
 * Time: 09:12
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
/* change content list post in category product */

/*replace content*/
$content = array(
    'type="wordpress/post_list_recent"' => 'type="wp/listhome"',
    'template="wordpress/post/recent.phtml"' => 'template="wp/list_cate.phtml"',
);

$resource = Mage::getModel('core/resource');
$connect = $resource->getConnection('core_read');
$table = $resource->getTableName('cms/block');
$query = "select identifier from {$table} where identifier LIKE 'cat_bottom_vid%'";
$result = $connect->fetchAll($query);
foreach($result as $value) {
    $block = Mage::getModel('cms/block')->load($value['identifier']);
    if($block->getBlockId()) {
        $contentBlock = $block->getContent();
        foreach($content as $strReplace => $strReplaceBy) {
            $contentBlock = str_replace($strReplace,$strReplaceBy,$contentBlock);
            $block->setContent($contentBlock);
        }
        $block->save();
    }
}
$installer->endSetup();
