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
 * @package    Mage_Admin
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class SM_Xpermission_Model_Mysql4_Roles_User_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected $_userWebsiteTable = 'sm_xpermission_user_wesbite';

    protected function _construct()
    {
        $this->_init('admin/user');
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->where("user_id > 0");
    }

    public function addWebsiteFilter($IDList)
    {
		$_userList = array();
		$select = $this->getConnection()->select()->distinct(true)
			->from(array('user_website'=>$this->_userWebsiteTable), array('user_id'))
			->where($this->getConnection()
				->quoteInto('user_website.website_id IN(?)', $IDList)
			)
			->where('user_website.website_id>0');
		$result = $this->getConnection()->fetchAll($select);
		foreach ($result as $row) {
			$_userList[] = $row['user_id'];
		}
		$this->getSelect()->where('user_id in (?)', $_userList);

        return $this;
    }
}