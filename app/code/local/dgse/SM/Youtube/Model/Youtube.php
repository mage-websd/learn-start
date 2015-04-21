<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 10/30/2014
 * Time: 2:29 PM
 */

class SM_Youtube_Model_Youtube extends Mage_Core_Model_Abstract
{
    /**
     *
     * Maps to the array key Setup.php::getDefaultEntities()
     *
     */

    public function _construct()
    {
        parent::_construct();
        $this->_init('sm_youtube/youtube');
    }

} 