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
class SM_XFacebook_Model_Session extends Facebook
{
    /**
    * Constructors
    * 
    * @param array $config
    * @return SM_XFacebook_Model_Session
    */
    public function __construct($config=array()) {
        if(empty($config['appId'])) $config['appId'] = Mage::getStoreConfig('xfacebook/api/id');
        if(empty($config['secret'])) $config['secret'] = Mage::getStoreConfig('xfacebook/api/secret');
        if(empty($config['cookie'])) $config['cookie'] = true;
        parent::__construct($config);
    }
    
    /**
    * Publish the message to wall
    * 
    * @param mixed $uid
    * @param mixed $message
    * @return object SM_XFacebook_Model_Session
    */
    public function publishStream($uid,$message="") {
        $this->api('/'.$uid.'/feed', 'POST', array(
            'message' => $this->getFilteredMessage($message) ,
            'actions' => '{"name":"' . sprintf("View on %s", $this->getFrontendName()) . '","link":"' . $this->getBaseUrl() . '"}'
        ));
        return $this;
    }
    /**
    * Get Store's Frontend Name
    * 
    * @return string
    */
    public function getFrontendName() {
        return Mage::app()->getStore()->getFrontendName();
    }
    /**
    * Get Store's Base Url
    * 
    * @param mixed $type
    * @param mixed $secure
    * @return string
    */
    public function getBaseUrl($type='link', $secure=null) {
        return Mage::app()->getStore()->getBaseUrl($type,$secure);
    }

    /**
    * Get Filtered Message for Publishing
    * 
    * @param string $message
    * @return string
    */
    public function getFilteredMessage($message="") {
        // Check Message for Filter
        if(!is_string($message) || empty($message) || !preg_match('/{{var (.*)}}/iUs',$message)) return $message;
        // Define Filter Processor
        $processor = Mage::getModel('core/email_template_filter')
            ->setUseSessionInUrl(false);
            
        // Define variables for Template Processing
        $variables = array();        
        $variables['this'] = $this;
        if(strstr($message,"{{var customer")) $variables['customer'] = Mage::getSingleton('customer/customer');
        if(strstr($message,"{{var store")) $variables['store'] = Mage::app()->getStore();
        if(strstr($message,"{{var order")) $variables['order'] = Mage::getSingleton('sales/order');        
        $processor->setVariables($variables);
        
        // Processing Template
        return $processor->filter($message);
    }
}  
?>