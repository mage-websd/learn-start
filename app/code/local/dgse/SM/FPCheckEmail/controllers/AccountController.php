<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 12/10/14
 * Time: 6:06 PM
 */
require_once 'Mage/Customer/controllers/AccountController.php';


class SM_FPCheckEmail_AccountController extends Mage_Customer_AccountController {
    public function forgotPasswordPostAction()
    {
        $email = (string) $this->getRequest()->getPost('email');
        if ($email) {
            if (!Zend_Validate::is($email, 'EmailAddress')) {
                $this->_getSession()->setForgottenEmail($email);
                $this->_getSession()->addError($this->__('Invalid email address.'));
                $this->_redirect('*/*/forgotpassword');
                return;
            }

            /** @var $customer Mage_Customer_Model_Customer */
            $customer = $this->_getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByEmail($email);

            if ($customer->getId()) {
                try {
                    $newResetPasswordLinkToken =  $this->_getHelper('customer')->generateResetPasswordLinkToken();
                    $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
                    $customer->sendPasswordResetConfirmationEmail();
                    $this->_getSession()
                        ->addSuccess( $this->_getHelper('customer')
                            ->__('You will receive an email with a link to reset your password.',
                                $this->_getHelper('customer')->escapeHtml($email)));
                    $this->_redirect('*/*/');
                } catch (Exception $exception) {
                    $this->_getSession()->addError($exception->getMessage());
                    $this->_redirect('*/*/forgotpassword');
                    return;
                }
            } else {
                $this->_getSession()
                    ->addError( $this->_getHelper('customer')
                        ->__('Your email: %s, does not match any of our records. <a class="contact-link" href="'.Mage::getUrl('customer/account/create/').'">Please create a new account.</a>',
                            $this->_getHelper('customer')->escapeHtml($email)));
                $this->_redirect('*/*/forgotpassword');
            }

            return;
        } else {
            $this->_getSession()->addError($this->__('Please enter your email.'));
            $this->_redirect('*/*/forgotpassword');
            return;
        }
    }
}