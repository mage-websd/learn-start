<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 12/1/14
 * Time: 4:14 PM
 */
require_once 'Mage/Checkout/controllers/OnepageController.php';


class SM_PickupCheckout_OnepageController extends Mage_Checkout_OnepageController {
    protected function _getPickupHtml()
    {
        $layout = $this->getLayout();
        $update = $layout->getUpdate();
        $update->load('checkout_onepage_pickup');
        $layout->generateXml();
        $layout->generateBlocks();
        $output = $layout->getOutput();
        return $output;
    }

    public function saveBillingAction()
    {
        Mage::getSingleton('core/session')->unsPickupLocation();
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );

                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
                    $result['goto_section'] = 'shipping_method';
                    $result['update_section'] = array(
                        'name' => 'shipping-method',
                        'html' => $this->_getShippingMethodsHtml()
                    );

                    $result['allow_sections'] = array('shipping');
                    $result['duplicateBillingInfo'] = 'true';
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 2) {
                    $result['goto_section'] = 'shipping';
                    $result['update_section'] = array(
                        'name' => 'shipping',
                        'html' => $this->_getPickupHtml()
                    );
                } else {
                    $result['goto_section'] = 'shipping';
                    $result['update_section'] = array(
                        'name' => 'shipping',
                        'html' => $this->_getPickupHtml()
                    );
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }

    public function saveShippingAction(){
        $option = $this->getRequest()->getParam('shipping_option', false);
        if($option!=2) {
            Mage::getSingleton('core/session')->unsPickupLocation();
        }
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            if ($data) {
                $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
                $result = $this->getOnepage()->saveShipping($data, $customerAddressId);
            } else {
                $data = $this->getRequest()->getPost('location');
                $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
                $result = $this->getOnepage()->saveShipping($data, $customerAddressId,1);
            }

            if (!isset($result['error'])) {
                $result['goto_section'] = 'shipping_method';
                $result['update_section'] = array(
                    'name' => 'shipping-method',
                    'html' => $this->_getShippingMethodsHtml()
                );
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }

    public function progressAction()
    {
        // previous step should never be null. We always start with billing and go forward
        $prevStep = $this->getRequest()->getParam('prevStep', false);
        $pickupLocation = Mage::getSingleton('core/session')->getPickupLocation();
        if ($prevStep == 'shipping' && $pickupLocation) {
            $locationName = Mage::getModel('sm_locations/locations')->load($pickupLocation)->getLocationTitle();
            $output = '<dt class="complete">Shipping Address</dt>
                        <dd class="complete">
                            <address>Pickup from <b>'.$locationName.'</b></address>
                        </dd>';
            $this->getResponse()->setBody($output);
            return $output;
        } elseif($prevStep == 'shipping_method' && $pickupLocation) {
            $locationName = Mage::getModel('sm_locations/locations')->load($pickupLocation)->getLocationTitle();
            $output = '<dt class="complete">Shipping Method</dt>
                        <dd class="complete">N/A</dd>';
            $this->getResponse()->setBody($output);
            return $output;
        } else {
        parent::progressAction();
    }


    }

}