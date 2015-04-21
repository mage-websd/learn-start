<?php
require_once Mage::getModuleDir('controllers', 'Mage_Checkout').DS.'CartController.php';
class SM_Cartsmart_CartController extends Mage_Checkout_CartController
{
    /**
     * Initialize coupon
     */
    public function couponPostAction()
    {

        // $model = Mage::getModel('salesrule/rule')
        // ->getCollection()
            // ->addFieldToFilter('name', array('eq'=>sprintf('AUTO_GENERATION CUSTOMER_%s - 30%% Summer discount', Mage::getSingleton('customer/session')->getCustomerId())))
            // ->getFirstItem()
       // ;
        //$couponCode = $model->getCouponCode();
        // echo count($model); die;
        // foreach ($model as $key => $value) {
        //         echo $value->to_date;
        // }
    
        // die();
         //var_dump($model); die();
        // Using dropdow in sales admin. 

        //echo Mage::getStoreConfig("sales/coupon/onoffcoupon"); die; // 0: No; 1: Yes
        /**
         * No reason continue with empty shopping cart
         */
        if (!$this->_getCart()->getQuote()->getItemsCount()) {
            $this->_goBack();
            return;
        }

        $couponCode = (string) $this->getRequest()->getParam('coupon_code');
        
        if ($this->getRequest()->getParam('remove') == 1) {
            $couponCode = '';
        }
        $oldCouponCode = $this->_getQuote()->getCouponCode();

        if (!strlen($couponCode) && !strlen($oldCouponCode)) {
            $this->_goBack();
            return;
        }

        try {
            $this->_getQuote()->getShippingAddress()->setCollectShippingRates(true);
            $this->_getQuote()->setCouponCode(strlen($couponCode) ? $couponCode : '')
                ->collectTotals()
                ->save();

            if (strlen($couponCode)) {
                if ($couponCode == $this->_getQuote()->getCouponCode()) {
                    $this->_getSession()->addSuccess(
                        $this->__('Coupon code "%s" was applied.', Mage::helper('core')->htmlEscape($couponCode))
                    );
                }
                else {
                    $this->_getSession()->addError(
                        $this->__('Coupon code "%s" is not valid.', Mage::helper('core')->htmlEscape($couponCode))
                    );
                }
            } else {
                $this->_getSession()->addSuccess($this->__('Coupon code was canceled.'));
            }

        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addError($this->__('Cannot apply the coupon code.'));
            Mage::logException($e);
        }

        $this->_goBack();
    }
}