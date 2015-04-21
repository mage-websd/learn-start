<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * SM_XAdvertising Helper: 
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_IndexController extends Mage_Core_Controller_Front_Action
{
  public function indexAction()
  {
    $this->loadLayout()
			->_addContent($this->getLayout()->createBlock("xadvertising/info"))
			->renderLayout();
  }
   /**
     * @return SM_XAdvertising_IndexController
     */
    protected function _addContent($block)
    {
        $this->getLayout()->getBlock('content')->append($block);
        return $this;
    }
}
