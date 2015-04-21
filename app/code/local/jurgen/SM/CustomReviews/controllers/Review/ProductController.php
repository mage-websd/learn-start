<?php

/**
 * Custom Review module
 *
 * @category    Mage
 * @package     Review
 * @author      SMARTOSC
 */
require_once "Mage/Review/controllers/ProductController.php";

class SM_CustomReviews_Review_ProductController extends Mage_Review_ProductController
{

    public function postAction()
    {
        // list id of old Dutch stores
        $idOldStores = Mage::getModel('core/store')->getCollection()
            ->addFieldToSelect('store_id')
            ->addFieldToFilter('code',array('in'=>array('default','proteinedieet_nl','pro10_view')))
            ->getColumnValues('store_id');
        // id new store Proteinedieet
        $idNewStore = Mage::getModel('core/store')->load('proteinedieet')->getStoreId();

        $idStoreCurrent = Mage::app()->getStore()->getStoreId();

        if ($data = Mage::getSingleton('review/session')->getFormData(true)) {
            $rating = array();
            if (isset($data['ratings']) && is_array($data['ratings'])) {
                $rating = $data['ratings'];
            }
        } else {
            $data   = $this->getRequest()->getPost();
            $rating = $this->getRequest()->getParam('ratings', array());
        }

        if (($product = $this->_initProduct()) && !empty($data)) {
            $session    = Mage::getSingleton('core/session');
            /* @var $session Mage_Core_Model_Session */
            $review     = Mage::getModel('review/review')->setData($data);
            /* @var $review Mage_Review_Model_Review */

            $validate = $review->validate();
            if ($validate === true)
            {
                try
                {
                    $idVisibleStores = array($idStoreCurrent);
                    $idStoresOfProduct = Mage::getModel('catalog/product')
                                       ->load($product->getId())
                                       ->getStoreIds();

                    if(in_array($idNewStore, $idStoresOfProduct))
                    {
                        if(in_array($idStoreCurrent, $idOldStores))
                        {
                            array_push($idVisibleStores, $idNewStore);
                        }
                    }

                    $review->setEntityId(Mage_Review_Model_Review::ENTITY_PRODUCT)
                        ->setEntityPkValue($product->getId())
//                        ->setStatusId(Mage_Review_Model_Review::STATUS_PENDING) /*ORIGION CODE*/
						/*
						 * SMARTOSC CHANGE: STATUS_PENDING -> STATUS_APPROVED
						 * Our customer want every reviews will be approved after the submit.
						 */
                        ->setStatusId(Mage_Review_Model_Review::STATUS_APPROVED)
                        /* SMARTOSC END */
                        ->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId())
                        ->setStoreId($idStoreCurrent)
                        ->setStores($idVisibleStores)
                        ->save();

                    foreach ($rating as $ratingId => $optionId)
                    {
                        Mage::getModel('rating/rating')
                    	   ->setRatingId($ratingId)
                    	   ->setReviewId($review->getId())
                    	   ->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId())
                    	   ->addOptionVote($optionId, $product->getId());
                    }

                    $review->aggregate();
                    $session->addSuccess($this->__('Your review has been accepted for moderation'));
                }
                catch (Exception $e)
                {
                    $session->setFormData($data);
                    $session->addError($this->__('Unable to post review. Please, try again later.'));
                }
            }
            else {
                $session->setFormData($data);
                if (is_array($validate)) {
                    foreach ($validate as $errorMessage) {
                        $session->addError($errorMessage);
                    }
                }
                else {
                    $session->addError($this->__('Unable to post review. Please, try again later.'));
                }
            }
        }

        if ($redirectUrl = Mage::getSingleton('review/session')->getRedirectUrl(true)) {
            $this->_redirectUrl($redirectUrl);
            return;
        }
        $this->_redirectReferer();
    }
	
    
}
