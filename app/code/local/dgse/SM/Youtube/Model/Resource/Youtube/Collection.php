<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 10/30/2014
 * Time: 2:49 PM
 */

class SM_Youtube_Model_Resource_Youtube_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sm_youtube/youtube');
    }
} 