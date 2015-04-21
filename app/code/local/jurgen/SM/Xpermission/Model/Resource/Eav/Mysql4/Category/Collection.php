<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Category resource collection
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Resource_Eav_Mysql4_Category_Collection extends Mage_Catalog_Model_Resource_Eav_Mysql4_Category_Collection
{
	protected $_categoryWebsiteTable = 'sm_xpermission_category_wesbite';

    public function addWebsiteFilter($IDList)
    {
		$_entityList = array();
		$select = $this->getConnection()->select()->distinct(true)
			->from(array('category_website'=>$this->_categoryWebsiteTable), array('category_id'))
			->where($this->getConnection()
				->quoteInto('category_website.website_id IN(?)', $IDList)
			)
			->where('category_website.website_id>0');
		$result = $this->getConnection()->fetchAll($select);
		foreach ($result as $row) {
			$_entityList[] = $row['category_id'];
		}
		$this->getSelect()->where('entity_id in (?)', $_entityList);

        return $this;
    }
}