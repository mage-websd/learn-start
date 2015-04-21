<?php
/**
 * Created by PhpStorm.
 * User: GiangSoda
 * Date: 10/6/14
 * Time: 3:54 PM
 */ 
class SM_Sell_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * @return string: url of module sell process
     */
    public function getUrl()
    {
        return Mage::getUrl('sell_exec/');
    }

    /**
     * @return string: url exec post message
     */
    public function getPostUrl()
    {
        return Mage::getUrl('sell_exec/index/post/');
    }

    /**
     * @return string: url of sell page
     */
    public function getSellUrl()
    {
        return Mage::getUrl('sell');
    }
}