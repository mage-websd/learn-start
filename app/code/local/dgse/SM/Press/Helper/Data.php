<?php
class SM_Press_Helper_Data extends Mage_Core_Helper_Abstract {
    /**
    * get name category press
     */
    public function getNameCategoryPress()
    {
        return 'press';
    }
    public function getUrlSearch()
    {
        return 'press/search/';
    }
}