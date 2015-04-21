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
 * SmartOSC XFacebook Model Observer
 *
 * @category  Magento 
 * @package   SM_XFacebook 
 * @author    Hien Mai Van <hienmv@smartosc.com>
 * @copyright 2010-2011 SmartOSC Magento Group
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 * @version   Release: @package_version@ 
 */
class SM_XFacebook_Model_Observer 
{

   /**
    * Get Facebook API Session .
    * 
    * @return SM_Facebook
    */
    protected function _getSession() 
    {
        return Mage::getSingleton('xfacebook/session');           
    }
    
    /**     
     * Publish Message to Wall after order placed .
     * 
     * @param object $observer
     * @return SM_XFacebook_Model_Checkout_Observer
     */
    public function afterSaveOrder($observer) 
    {
        
        if(Mage::getStoreConfig('xfacebook/api/enabled')) {
            try {
                // Publish new message to Customer's wall
                if(Mage::getStoreConfig('xfacebook/customer_wall/after_order_enabled')) {
                    $this->_getSession()->publishStream('me',Mage::getStoreConfig('xfacebook/customer_wall/after_order'));
                }
                // Publish new message to Store's wall
                if(Mage::getStoreConfig('xfacebook/store_wall/after_order_enabled')) {            
                    $this->_getSession()->publishStream($this->_getSession()->getAppId(),Mage::getStoreConfig('xfacebook/store_wall/after_order'));
                }
            }
            catch(Exception $e) {
                Mage::logException($e);
            }
        }
        return $this;
    }
    /**     
     * License Check
     * 
     * @param object $observer     * 
     * @return SM_XFacebook_Model_Checkout_Observer
     */
    public function checkLicense($observer)
    {        
        if(Mage::getStoreConfig('xfacebook/api/enabled')) { 
            $licenseKey = trim(Mage::getStoreConfig('xfacebook/license/key'));
            $domainName = $_SERVER['SERVER_NAME'];
			if(strstr($domainName,"www.")) $domainName = str_replace("www.","",$domainName);
            $licenseSalt = 'smartosc_xfacebook';
            if(sha1($licenseSalt.$domainName) != $licenseKey)    {
                $layout = Mage::app()->getLayout();
                $root = $layout->getBlock('root');
                $left = $layout->getBlock('top.menu');
                $block = $layout->createBlock('core/template')->setTemplate('sm/xfacebook/license.phtml');
                $left->insert($block);
            }
        }
        return $this;
    }    
}