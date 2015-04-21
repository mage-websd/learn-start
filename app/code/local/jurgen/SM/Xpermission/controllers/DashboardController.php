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
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2009 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Dashboard admin controller
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
require_once('Mage' .DS. 'Adminhtml' .DS. 'controllers' .DS. 'DashboardController.php');

class SM_Xpermission_DashboardController extends Mage_Adminhtml_DashboardController {
    public function preDispatch() {
        parent::preDispatch();

        $_website = $this->getRequest()->getParam('website');
        if (is_null($_website) || empty($_website)) {
            $_user = Mage::getSingleton('admin/session');
            if ($_user->isLoggedIn() and !$_user->getUser()->isRoot()) {
                $_websiteId = $_user->getUser()->getWebsiteId();
                $_code = Mage::getModel('core/website')->load($_websiteId)->getCode();
                $this->_redirect('*/*/', array('website'=>$_code));
                return false;
            }
        }

        return $this;
    }
}