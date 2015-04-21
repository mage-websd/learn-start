<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DucThang
 * Date: 12/31/14
 * Time: 3:10 PM
 */ 
class SM_Rewrite_Model_Api_Server_V2_Adapter_Soap extends Mage_Api_Model_Server_V2_Adapter_Soap {
    /**
     * Run webservice
     *
     * @param Mage_Api_Controller_Action $controller
     * @return Mage_Api_Model_Server_Adapter_Soap
     */
    public function run()
    {
        $apiConfigCharset = Mage::getStoreConfig("api/config/charset");

        if ($this->getController()->getRequest()->getParam('wsdl') !== null) {
            $wsdlConfig = Mage::getModel('api/wsdl_config');
            $wsdlConfig->setHandler($this->getHandler())
                ->init();
            $this->getController()->getResponse()
                ->clearHeaders()
                ->setHeader('Content-Type','text/xml; charset='.$apiConfigCharset)
                ->setBody(
                preg_replace(
                    '/<\?xml version="([^\"]+)"([^\>]+)>/i',
                    '<?xml version="$1" encoding="'.$apiConfigCharset.'"?>',
                    $wsdlConfig->getWsdlContent()
                )
            );
        } else {
            try {
                $this->_instantiateServer();

                $content = str_replace(
                    '><',
                    "><",
                    preg_replace(
                        '/<\?xml version="([^\"]+)"([^\>]+)>/i',
                        '<?xml version="$1" encoding="' . $apiConfigCharset . '"?>',
                        $this->_soap->handle()
                    )
                );
                $this->getController()->getResponse()
                    ->clearHeaders()
                    ->setHeader('Content-Type', 'text/xml; charset=' . $apiConfigCharset)
                    ->setHeader('Content-Length', strlen($content), true)
                    ->setBody($content);
            } catch( Zend_Soap_Server_Exception $e ) {
                $this->fault( $e->getCode(), $e->getMessage() );
            } catch( Exception $e ) {
                $this->fault( $e->getCode(), $e->getMessage() );
            }
        }

        return $this;
    }
}