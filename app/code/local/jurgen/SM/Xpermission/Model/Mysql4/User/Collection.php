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

class SM_Xpermission_Model_Mysql4_User_Collection extends Mage_Admin_Model_Mysql4_User_Collection {
    public function addWebsiteToResult() {
        $_websiteList = array();
        $_itemWebsiteList = array();
        foreach ($this as $item) {
            $_itemWebsiteList[$item->getId()] = array();
        }

        if (sizeof($_itemWebsiteList) > 0) {
            $select = $this->getConnection()->select()
                    ->from(array('user_website'=>$this->getTable('xpermission/user_website')))
                    ->join(
                    array('website'=>$this->getResource()->getTable('core/website')),
                    'website.website_id=user_website.website_id',
                    array('name'))
                    ->where($this->getConnection()->quoteInto(
                    'user_website.user_id IN (?)',
                    array_keys($_itemWebsiteList))
                    )
                    ->where('website.website_id>0');

            $data = $this->getConnection()->fetchAll($select);
            foreach ($data as $row) {
                $_itemWebsiteList[$row['user_id']][] = $row['website_id'];
            }
        }

        foreach ($this as $item) {
            if (isset($_itemWebsiteList[$item->getId()])) {
                $item->setData('website_id', $_itemWebsiteList[$item->getId()]);
            }
        }
        return $this;
    }
    public function addWebsiteFilter($ID) {
        $_userList = array();
        $select = $this->getConnection()->select()->distinct(true)
                ->from(
                        array('user_website'=>$this->getTable('xpermission/user_website')), array('user_id'))
                ->join(
                        array('user_root' => $this->getTable('xpermission/root')),
                        'user_website.user_id = user_root.user_id')
                ->where('user_website.website_id = ?', $ID)
                ->where('user_website.website_id>0')
                ->where('user_root.is_root = 0');
        $result = $this->getConnection()->fetchAll($select);
        foreach ($result as $row) {
            $_userList[] = $row['user_id'];
        }
        $this->getSelect()->where('user_id in (?)', $_userList);

        return $this;
    }
}
