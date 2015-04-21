<?php
/**
 * Created by PhpStorm.
 * User: SnguyenOne
 * Date: 11/4/2014
 * Time: 6:30 AM
 */

class SM_Youtube_Block_Youtube extends Mage_Core_Block_Template
{
    /**
     * $this->_data = information load block
     *
     */

    protected $_collection = null;



    /**
     * Return all information blog post
     *
     */
    public function loadBlog($limit = '', $start = '')
    {
        if(empty($this->_collection)) {
            $this->_collection = Mage::getModel('sm_youtube/youtube')->getCollection();
        }
        return  $this->_collection->load();
    }


} 