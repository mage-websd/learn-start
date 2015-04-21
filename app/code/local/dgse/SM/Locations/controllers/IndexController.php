<?php

class SM_Locations_IndexController extends Mage_Core_Controller_Front_Action
{
    function sendMailAction()
    {
        $data = array();
        $post = $this->getRequest()->getPost();
        $_location = Mage::getModel("sm_locations/locations")->load($post["location"]);
        Mage::getSingleton('core/session')->setTransferLocation($post["location"]);
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerInfo = Mage::getSingleton('customer/session')->getCustomer();
            $cusAddress = Mage::getModel('customer/address')->load($customerInfo->getEntityId());
            $post["customer_first"] = $customerInfo->getFirstname();
            $post["customer_email"] = $customerInfo->getEmail();
            $post["customer_street"] = $cusAddress->getStreet();
            $post["customer_street"] = $post["customer_street"][0];
            $post["customer_telephone"] = $cusAddress->getTelephone();
            $post["customer_city"] = $cusAddress->getCity();
        }
        $post["tran_location"] = $_location->getLocationTitle();
        $post['email'] = $_location->getLocationEmail();
        $data['telephone'] = $_location->getTelephone();
        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);
        try {
            if ($post) {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $mailTemplate = Mage::getModel('core/email_template');
                $mailTemplate->setTemplateSubject('Location');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                        'locations_email_template',
                        'custom2',
                        $post['email'],
                        null,
                        array('data' => $postObject)
                    );


                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }

                $translate->setTranslateInline(true);
                $data["status"] = true;
                $data["message"] = 'Thank you for contacting us. We will be in touch with you shortly.';
                echo json_encode($data);
            }
        } catch (Exception $e) {
            $data["status"] = false;
            $data["message"] = 'Error sending mail';
            echo json_encode($post);
        }

    }

    function sendMailLocationAction()
    {
        $post = $this->getRequest()->getPost();
        $urlBack = Mage::getModel('core/session')->getPrevPage() ? Mage::getModel('core/session')->getPrevPage() : '/';

        if (!$post) {
            $this->_redirectUrl($urlBack);
            return;
        }
        $_location = Mage::getModel("sm_locations/locations")->load($post["location_id"]);
        if ($_location->getLocationId()) {
            $post['location_email'] = $_location->getLocationEmail();
            $post["location_name"] = $_location->getLocationTitle();
        } else {
            $post['location_email'] = Mage::getStoreConfig('contacts/email/recipient_email');
            $post["location_name"] = Mage::getStoreConfig('contacts/email/sender_email_identity');
        }
        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);
        try {
            $postObject = new Varien_Object();
            $postObject->setData($post);

            $mailTemplate = Mage::getModel('core/email_template');
            $mailTemplate->setTemplateSubject('Location');
            /* @var $mailTemplate Mage_Core_Model_Email_Template */
            $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                ->setReplyTo($post['email'])
                ->sendTransactional(
                    'location_email_home',
                    'custom2',
                    $post['location_email'],
                    null,
                    array('data' => $postObject)
                );


            if (!$mailTemplate->getSentSuccess()) {
                throw new Exception();
            }

            $translate->setTranslateInline(true);
            Mage::getSingleton('core/session')->addSuccess('Thank you for contacting us. We will be in touch with you shortly.');
            if($_location->getLocationPage()) {
                $this->_redirect($_location->getLocationPage());
            }
            else {
                $this->_redirectUrl($urlBack);
            }
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Error sending mail ' . $e->getMessage());
            $this->_redirect($_location->getLocationPage());
        }
    }
}