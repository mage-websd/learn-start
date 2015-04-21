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
 * Product Reviews Page
 *
 * @category   Mage
 * @package    Mage_Review
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class SM_XAskExpert_Block_Review_Product_View_List extends Mage_Review_Block_Product_View_List
{
    protected function _prepareLayout()
    {
    	/**
    	 * SMARTOSC ADD: Set Ask the Expert toolbar
    	 */
        if ($toolbar = $this->getLayout()->getBlock('product_review_list.toolbar')) {
            $toolbar->setCollection($this->getQuestionsCollection());
            $this->setChild('reviewstoolbar', $toolbar);
        }
        /* SMARTOSC END */

        return $this;
    }
    
	public function getReviewsCollection()
	{
		if (null === $this->_reviewsCollection) {
			$this->_reviewsCollection = Mage::getModel('review/review')->getCollection()
			->addStoreFilter(Mage::app()->getStore()->getId())
                ->addStatusFilter('approved')
                ->addEntityFilter('product', $this->getProduct()->getId())
                ->addFieldToFilter('`main_table`.`parent_id`', array("null"=>'')) //SMARTOSC ADD HERE: parent_id is NULL is the reviews
                ->setDateOrder();
        }
        
        return $this->_reviewsCollection;
    }
    

    
    /**
     * Get questions collection
     * 
     * @author SMARTOSC
     */
    public function getQuestionsCollection()
    {
    	$this->_answersCollection = Mage::getModel('review/review')->getCollection()
	        ->addStoreFilter(Mage::app()->getStore()->getId())
	        ->addStatusFilter('approved')
	        ->addEntityFilter('product', $this->getProduct()->getId())
	        ->addFieldToFilter('`main_table`.`parent_id`', array('eq' => '0')) //parent_id = 0 is the questions
	        ->setDateOrder();
        
        return $this->_answersCollection;
    }
    
    /**
     * Get answers by review_id
     * 
     * @author SMARTOSC
     * @param int $reviewId
     */
    public function getAnswersByReview($reviewId=0)
    {
    	$this->_answersCollection = Mage::getModel('review/review')->getCollection()
	        ->addStoreFilter(Mage::app()->getStore()->getId())
	        ->addStatusFilter('approved')
	        ->addEntityFilter('product', $this->getProduct()->getId())
	        ->addFieldToFilter('`main_table`.`parent_id`', array('eq' => "$reviewId")) //parent_id > 0 is the ansers
	        ->setDateOrder();
        
        return $this->_answersCollection;
    }
    
}
