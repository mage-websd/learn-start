<?php
/**
 * SmartOSC X-Facebook Extension
 *
 * PHP versions 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Magento 
 * @package   SM_XFacebook 
 * @author    Hien Mai Van <hienmv@smartosc.com>
 * @copyright 2010-2011 SmartOSC Magento Group
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 * @version   CVS: $Id:$ 
 */

/**
 * SmartOSC XFacebook Index Controller
 *
 * @category  Magento 
 * @package   SM_XFacebook 
 * @author    Hien Mai Van <hienmv@smartosc.com>
 * @copyright 2010-2011 SmartOSC Magento Group
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 * @version   Release: @package_version@ 
 */
class SM_XFacebook_IndexController extends Mage_Core_Controller_Front_Action
{  
    /**
     * Get customer session model object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }
    
    /**
     * Get facebook session model object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('xfacebook/session');
    }
        
    /**
     * Action Connect for Facebook
     * 
     */
    public function connectAction()    {        
        // Session Check
        try {
            if ($this->_getSession()->getUser()) {
                $_facebookUser = $this->_getSession()->api('/me');
                $_customer = Mage::getModel('customer/customer')
                    ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                    ->loadByEmail($_facebookUser['email']);
                    
                // If Customer's did not exist in database than Create new account and email it
                if ($_customer->hasData() === false) {
                    //Generate Random Password for new User
                    $_customerPassword = $_customer->generatePassword(8);
                    
                    //Set Required Customer Information
                    $_customer
                        ->setId(null)
                        ->setSkipConfirmationIfEmail($_facebookUser['email'])
                        ->setFirstname($_facebookUser['first_name'])
                        ->setLastname($_facebookUser['last_name'])
                        ->setEmail($_facebookUser['email'])
                        ->setPassword($_customerPassword)
                        ->setConfirmation($_customerPassword);
          
                    // Validate Required Information
                    $validateCustomer = $_customer->validate();
                    if ($validateCustomer === true) {
                        try {
                            // Publish new message to Customer's wall
                            if (Mage::getStoreConfig('xfacebook/customer_wall/after_connect_enabled')) {                            
                                $this->_getSession()->publishStream('me',Mage::getStoreConfig('xfacebook/customer_wall/after_connect'));
                            }
                            // Publish new message to Store App's wall
                            if (Mage::getStoreConfig('xfacebook/store_wall/after_connect_enabled')) {                            
                                $this->_getSession()->publishStream($this->_getSession()->getAppId(),Mage::getStoreConfig('xfacebook/store_wall/after_connect'));
                            }
                        }
                        catch(FacebookApiException $msg) {
                            Mage::logException($msg);
                        }
                        try {
                            $_successMessage  = $this->__('Thank you for registering with %s', Mage::app()->getStore()->getFrontendName()) . '. ';
                            $_successMessage .= $this->__('The welcome message with your account information was sent to %s', $_customer->getEmail());
                            $this->_getCustomerSession()->addSuccess($_successMessage);
                            $_customer->save();
                            $_customer->sendNewAccountEmail();
                        }
                        catch(Exception $msg) {
                            Mage::logException($msg);
                        }
                    } else {
                        foreach ($validateCustomer as $errorMessage) {
                            $this->_getCustomerSession()->addError($errorMessage);
                        }
                    }
                }
                // Create new session for current customer , identified by customer's email
                if ($_customer->getEntityId()) {
                    Mage::getSingleton('customer/session')->loginById($_customer->getEntityId());
                    return $this->_redirect('*/*/connectSuccess',array('_secure'=>Mage::app()->getStore()->isCurrentlySecure()));
                }
            }
            else{
                $this->_redirect($this->_getSession()->getLoginUrl());
            }
        }
        catch(Exception $msg) {
            Mage::logException($msg);
        }            
		catch(FacebookApiException $msg) {
			Mage::logException($msg);
		}
        $this->_redirect('*/*/connectError',array('_secure'=>Mage::app()->getStore()->isCurrentlySecure()));
    }
    /**
     * Action to Display Connect Success Page
     *
     */
    public function connectSuccessAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    /**
     * Action to Display Connect Error Page
     *
     */
    public function connectErrorAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
?>
