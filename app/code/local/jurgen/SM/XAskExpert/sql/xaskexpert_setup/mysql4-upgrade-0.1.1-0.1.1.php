<?php
/**
 * SMARTOSC
 *
 * NOTICE OF LICENSE
 *
 * Smartosc change this module (only in Catalog Product View section) to XAskExpert (Ask the Expert) module.
 * We need add new column parent_id to filer what is the question and what is the ansert.
 *
 * @category    Mage
 * @package     Mage_Review
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Review/Rating module upgrade. Both modules tables must be installed.
 * @see app/etc/modules/Mage_All.xml - Review comes after Rating
 */

$this->startSetup();

// add average approved percent
$this->run("
ALTER TABLE `{$this->getTable('review')}`
ADD COLUMN `parent_id` smallint(5) NULL default NULL;
");

$this->endSetup();
