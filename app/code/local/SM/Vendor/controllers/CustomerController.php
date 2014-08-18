<?php
//require file app/code/core/Mage/Customer/controllers/AccountController.php
//      AccountController.php: manage account customer
require_once Mage::getModuleDir('controllers', 'Mage_Customer') . '/AccountController.php';

class SM_Vendor_CustomerController extends Mage_Customer_AccountController
{
    public function indexAction()
    {
        $this->_redirect('customer/account/');
    }

    /**
     * createAction: redirect customer/account/create - action createAction
     */
    public function createAction()
    {
        $this->_redirect('customer/account/create');
    }


    /**
     * Create customer account action, copy of core
     */
    public function createPostAction()
    {
        /** @var $session Mage_Customer_Model_Session */
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if (!$this->getRequest()->isPost()) {
            $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            $this->_redirectError($errUrl);
            return;
        }

        $customer = $this->_getCustomer();

        try {
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {

                // add attribute create customer, code more than core
                $params = $this->getRequest()->getParams();
                $customer->setData('customer_type', $params['customer_type']);
                //if customer is vendor, add paypal and logo
                if ($params['customer_type'] == 'vendor') {
                    $customer->setData('paypal_account', $params['paypal_account']);

                    $path = Mage::getBaseDir('media') . '/sm/vendor/images';
                    $image = Mage::helper('sm_vendor/upload')
                        ->uploadImage('logo', $path, $params['firstname'] . '_' . $params['lastname']);
                    $image = 'media/sm/vendor/images/' . $image;

                    $customer->setData('logo', $image);
                }
                // end add attribute create customer

                $customer->save();
                $this->_dispatchRegisterSuccess($customer);
                $this->_successProcessRegistration($customer);

                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = $this->_getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                $session->setEscapeMessages(false);
            } else {
                $message = $e->getMessage();
            }
            $session->addError($message);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost())
                ->addException($e, $this->__('Cannot save the customer.'));
        }
        $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
        $this->_redirectError($errUrl);
    }

    public function editPostAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('customer/account/edit');
        }

        if ($this->getRequest()->isPost()) {
            /** @var $customer Mage_Customer_Model_Customer */
            $customer = $this->_getSession()->getCustomer();

            /** @var $customerForm Mage_Customer_Model_Form */
            $customerForm = $this->_getModel('customer/form');
            $customerForm->setFormCode('customer_account_edit')
                ->setEntity($customer);

            $customerData = $customerForm->extractData($this->getRequest());

            $errors = array();
            $customerErrors = $customerForm->validateData($customerData);
            if ($customerErrors !== true) {
                $errors = array_merge($customerErrors, $errors);
            } else {
                $customerForm->compactData($customerData);
                $errors = array();

                // If password change was requested then add it to common validation scheme
                if ($this->getRequest()->getParam('change_password')) {
                    $currPass = $this->getRequest()->getPost('current_password');
                    $newPass = $this->getRequest()->getPost('password');
                    $confPass = $this->getRequest()->getPost('confirmation');

                    $oldPass = $this->_getSession()->getCustomer()->getPasswordHash();
                    if ($this->_getHelper('core/string')->strpos($oldPass, ':')) {
                        list($_salt, $salt) = explode(':', $oldPass);
                    } else {
                        $salt = false;
                    }

                    if ($customer->hashPassword($currPass, $salt) == $oldPass) {
                        if (strlen($newPass)) {
                            /**
                             * Set entered password and its confirmation - they
                             * will be validated later to match each other and be of right length
                             */
                            $customer->setPassword($newPass);
                            $customer->setConfirmation($confPass);
                        } else {
                            $errors[] = $this->__('New password field cannot be empty.');
                        }
                    } else {
                        $errors[] = $this->__('Invalid current password');
                    }
                }

                // Validate account and compose list of errors if any
                $customerErrors = $customer->validate();
                if (is_array($customerErrors)) {
                    $errors = array_merge($errors, $customerErrors);
                }
            }

            if (!empty($errors)) {
                $this->_getSession()->setCustomerFormData($this->getRequest()->getPost());
                foreach ($errors as $message) {
                    $this->_getSession()->addError($message);
                }
                $this->_redirect('customer/account/edit');
                return $this;
            }

            try {
                $customer->setConfirmation(null);


                // customer if is vendor, add logo, paypalaccount, code more than core
                if ($customer->getData('customer_type') == 'vendor') {
                    $params = $this->getRequest()->getParams();
                    $customer->setData('paypal_account', $params['paypal_account']);

                    if (isset($_FILES['logo']) && $_FILES['logo']['name']) {
                        $path = Mage::getBaseDir('media') . '/sm/vendor/images';
                        $image = Mage::helper('sm_vendor/upload')
                            ->uploadImage('logo', $path, $params['firstname'] . '_' . $params['lastname']);

                        if ($image)
                            $customer->setData('logo', 'media/sm/vendor/images/' . $image);
                    }
                }
                // end customer if is vendor, add logo, paypalaccount, code more than core

                $customer->save();
                $this->_getSession()->setCustomer($customer)
                    ->addSuccess($this->__('The account information has been saved.'));

                $this->_redirect('customer/account');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->setCustomerFormData($this->getRequest()->getPost())
                    ->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->setCustomerFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Cannot save the customer.'));
            }
        }

        $this->_redirect('customer/account/edit');
        return;
    }
}