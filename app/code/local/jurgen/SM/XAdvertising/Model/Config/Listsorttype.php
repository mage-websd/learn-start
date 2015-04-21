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
 * SM_XBrand list sort type: 
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      Thuanlq <thuanlq@Smartosc.com>
 */
class SM_XAdvertising_Model_Config_Listsorttype{
    
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options) {
            $nodes = array();
			$nodes[] = array("id"=>"ASC","label"=>"ASC");
			$nodes[] = array("id"=>"DESC","label"=>"DESC");
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

