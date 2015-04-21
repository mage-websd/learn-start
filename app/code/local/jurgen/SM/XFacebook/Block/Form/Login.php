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
 * SmartOSC XFacebook Model Session
 *
 * @category  Magento 
 * @package   SM_XFacebook 
 * @author    Hien Mai Van <hienmv@smartosc.com>
 * @copyright 2010-2011 SmartOSC Magento Group
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 * @version   Release: @package_version@ 
 */
 
class SM_XFacebook_Block_Form_Login extends Mage_Core_Block_Template 
{
    /**
     * Assigned variables for Facebook Session
     *
     * @var SM_Facebook
     */
    protected $_facebookSession;
    
    /**
    * Internal constructor, that is called from real constructor
    * 
    */
    public function _construct() 
    {
        parent::_construct();
        $this->setAppId(Mage::getStoreConfig('xfacebook/api/id'));
        $this->setAppKey(Mage::getStoreConfig('xfacebook/api/key'));
        $this->setAppSecret(Mage::getStoreConfig('xfacebook/api/secret'));
    }    
    
    /**
    * Check Extension Status
    * return bool    
    */
    public function isEnabled() {
        if(Mage::getStoreConfig('xfacebook/api/enabled') && $this->getAppId() && $this->getAppKey() && $this->getAppSecret()) {
            return true;
        }
        return false;
    }

    /**
    * Check Valid License Key
    * return bool    
    */
    public function isValidLicenseKey() {
        $licenseKey = trim(Mage::getStoreConfig('xfacebook/license/key'));
        $domainName = $_SERVER['SERVER_NAME'];
        $licenseSalt = 'smartosc_xfacebook';
        if(strstr($domainName,"www.")) $domainName = str_replace("www.","",$domainName);
        if(sha1($licenseSalt.$domainName) == $licenseKey)    {
            return true;
        }
        return false;
    }
    
    /**
    * Get facebook session 
    * 
    * @return object SM_Facebook
    */
    public function getFacebookSession() 
    {
        if(empty($this->_facebookSession)) {
            $this->_facebookSession = new Facebook(array(
              'appId'  => $this->getAppId(),
              'secret' => $this->getAppSecret(),
              'cookie' => true
            ));
        }
        return $this->_facebookSession;
    }
    
    /**
    * Get api callback
    * 
    * @return string
    */
    public function getConnectUrl() 
    {
        return $this->getUrl('xfacebook/index/connect',array('_secure'=>Mage::app()->getStore()->isCurrentlySecure()));
    }
    
    /**
    * Get login url with api parameter
    * 
    * @var array $params
    * @return string
    */
    public function getLoginUrl($params=array()) 
    {
        return $this->getFacebookSession()->getLoginUrl(array_merge(array(
           // 'cancel_url' => $this->getConnectUrl(),
            'scope' => 'email',
            'display' => 'popup',
            'redirect_uri' => $this->getConnectUrl()
        ),$params));
    }
        
    /**
    * Get request permissions for api
    * 
    * @return string
    */
    public function getRequestPermissions() 
    {
        return 'publish_stream,email';
    }
}
