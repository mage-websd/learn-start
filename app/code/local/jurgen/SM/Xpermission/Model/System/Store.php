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
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Adminhtml System Store Model
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_System_Store extends Mage_Adminhtml_Model_System_Store {
    public function getStoreValuesForForm($empty = false, $all = false)
    {
        $options = array();
        if ($empty) {
            $options[] = array(
                'label' => '',
                'value' => ''
            );
        }
        if ($all && $this->_isAdminScopeAllowed) {
            $options[] = array(
                'label' => Mage::helper('adminhtml')->__('All Store Views'),
                'value' => 0
            );
        }

        if (Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            foreach ($this->_websiteCollection as $website) {
                $websiteShow = false;
                foreach ($this->_groupCollection as $group) {
                    if ($website->getId() != $group->getWebsiteId()) {
                        continue;
                    }
                    $groupShow = false;
                    foreach ($this->_storeCollection as $store) {
                        if ($group->getId() != $store->getGroupId()) {
                            continue;
                        }
                        if (!$websiteShow) {
                            $options[] = array(
                                'label' => $website->getName(),
                                'value' => array()
                            );
                            $websiteShow = true;
                        }
                        if (!$groupShow) {
                            $groupShow = true;
                            $values    = array();
                        }
                        $values[] = array(
                            'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $store->getName(),
                            'value' => $store->getId()
                        );
                    }
                    if ($groupShow) {
                        $options[] = array(
                            'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $group->getName(),
                            'value' => $values
                        );
                    }
                }
            }
        } else {
            foreach ($this->_websiteCollection as $website) {
                if ($website->getId() == Mage::getSingleton('admin/session')->getUser()->getWebsiteId()) {
                    $websiteShow = false;
                    foreach ($this->_groupCollection as $group) {
                        if ($website->getId() != $group->getWebsiteId()) {
                            continue;
                        }
                        $groupShow = false;
                        foreach ($this->_storeCollection as $store) {
                            if ($group->getId() != $store->getGroupId()) {
                                continue;
                            }
                            if (!$websiteShow) {
                                $options[] = array(
                                    'label' => $website->getName(),
                                    'value' => array()
                                );
                                $websiteShow = true;
                            }
                            if (!$groupShow) {
                                $groupShow = true;
                                $values    = array();
                            }
                            $values[] = array(
                                'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $store->getName(),
                                'value' => $store->getId()
                            );
                        }
                        if ($groupShow) {
                            $options[] = array(
                                'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $group->getName(),
                                'value' => $values
                            );
                        }
                    }
                }
            }
        }
        return $options;
    }
    public function getStoreValuesForGrid($empty = false, $all = false)
    {
        $options = array();
        if ($empty) {
            $options[] = array(
                'label' => '',
                'value' => ''
            );
        }
        if ($all && $this->_isAdminScopeAllowed) {
            $options[] = array(
                'label' => Mage::helper('adminhtml')->__('All Store Views'),
                'value' => 0
            );
        }

        if (Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            foreach ($this->_websiteCollection as $website) {
                $websiteShow = false;
                foreach ($this->_groupCollection as $group) {
                    if ($website->getId() != $group->getWebsiteId()) {
                        continue;
                    }
                    $groupShow = false;
                    foreach ($this->_storeCollection as $store) {
                        if ($group->getId() != $store->getGroupId()) {
                            continue;
                        }
                        if (!$websiteShow) {
                            $options[] = array(
                                'label' => $website->getName(),
                                'value' => array()
                            );
                            $websiteShow = true;
                        }
                        if (!$groupShow) {
                            $groupShow = true;
                            $values    = array();
                        }
                        $values[] = array(
                            'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $store->getName(),
                            'value' => $store->getId()
                        );
                    }
                    if ($groupShow) {
                        $options[] = array(
                            'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $group->getName(),
                            'value' => $values
                        );
                    }
                }
            }
        } else {
            foreach ($this->_websiteCollection as $website) {
                if ($website->getId() == Mage::getSingleton('admin/session')->getUser()->getWebsiteId()) {
                    $websiteShow = false;
                    foreach ($this->_groupCollection as $group) {
                        if ($website->getId() != $group->getWebsiteId()) {
                            continue;
                        }
                        $groupShow = false;
                        foreach ($this->_storeCollection as $store) {
                            if ($group->getId() != $store->getGroupId()) {
                                continue;
                            }
                            if (!$websiteShow) {
                                $options[] = array(
                                    'label' => $website->getName(),
                                    'value' => array()
                                );
                                $websiteShow = true;
                            }
                            if (!$groupShow) {
                                $groupShow = true;
                                $values    = array();
                            }
                            $values[] = array(
                                'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $store->getName(),
                                'value' => $store->getId()
                            );
                        }
                        if ($groupShow) {
                            $options[] = array(
                                'label' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $group->getName(),
                                'value' => $values
                            );
                        }
                    }
                }
            }
        }
        return $options;
    }
}