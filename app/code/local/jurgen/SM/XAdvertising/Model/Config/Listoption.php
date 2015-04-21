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
 * SM_XBrand list option: 
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_Model_Config_Listoption{
    
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options) {
            $nodes = array();
			$nodes[] = array("id"=>1,"label"=>"New");
			$nodes[] = array("id"=>2,"label"=>"Random");
			$nodes[] = array("id"=>5,"label"=>"Configurable");
			foreach ($nodes as $item) {
				$this->_options[] = array(
				   'value'=>(string)$item["id"],
				   'label'=>(string)$item["label"]
				);
			}
			
		}
        return $this->_options;
    }
}

