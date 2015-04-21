<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 10/30/2014
 * Time: 2:38 PM
 */

class SM_Youtube_Model_Resource_Youtube extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('sm_youtube/youtube','entity_id');
    }
} 