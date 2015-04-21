<?php

class SM_WP_Block_Listhome extends Fishpig_Wordpress_Block_Post_List
{
    protected $_limit = 2;
    protected $_numberCut = 200;
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('wp/listhome.phtml');
    }
    protected function _getPostCollection()
    {
        $postIdsParam = trim($this->getData('post_ids_to'),',');
        $collection = Mage::getModel('wordpress/post')->getCollection();
        if($postIdsParam) {
            $postIds = explode(',',$postIdsParam);
            $collection->addFieldToFilter('ID',array('in'=>$postIds))
                ->setOrder('ID');
        }
        $collection->setPageSize($this->_limit)
            ->setCurPage(1);
        return $collection;
    }


    /**
     * Cut content post wp
     *
     * @param $string
     * @return string
     */
    public function cutContent($string)
    {
        if(strlen($string) < $this->_numberCut) {
            return $string;
        }
        $pos = strpos($string,'.',$this->_numberCut);
        if($pos > ($this->_numberCut + 100)) {
            $pos = strpos($string,'?',$this->_numberCut);
            if($pos > ($this->_numberCut+100)) {
                $pos = $this->_numberCut;
            }
        }
        if($pos) {
            $result = substr($string,0,($pos+1));
        }
        else {
            $result = substr($string,0,$this->_numberCut);
        }
        return $result;
    }

    public function removeBTag($string)
    {
        $result = str_replace('<b>','',$string);
        $result = str_replace('</b>','',$result);
        return $result;
    }
}