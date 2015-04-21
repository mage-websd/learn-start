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
 * @package     Mage_Review
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Review resource model
 *
 * @category    Mage
 * @package     Mage_Review
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_XAskExpert_Model_Review_Mysql4_Review extends Mage_Review_Model_Mysql4_Review
{
    public function getTotalReviews($entityPkValue, $approvedOnly=false, $storeId=0)
    {
        $select = $this->_getReadAdapter()->select()
            ->from($this->_reviewTable, "COUNT(*)")
            ->where("{$this->_reviewTable}.entity_pk_value = ?", $entityPkValue)
            
            /**
             * SMARTOSC ADD: Filter only Reviews with parrent_id IS NULL. 
             * This will be affected when approving the reviews in back-end
             */
            ->where("{$this->_reviewTable}.parent_id IS NULL") //SMARTOSC ADD: 
            /* SMARTOSC END */
            ;
            
        if($storeId > 0) {
            $select->join(array('store'=>$this->_reviewStoreTable),
                $this->_reviewTable.'.review_id=store.review_id AND store.store_id=' . (int)$storeId, array());
        }
        if( $approvedOnly ) {
            $select->where("{$this->_reviewTable}.status_id = ?", 1);
        }
        return $this->_getReadAdapter()->fetchOne($select);
    }
}