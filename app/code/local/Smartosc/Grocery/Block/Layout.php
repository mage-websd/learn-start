<?php

class Smartosc_Grocery_Block_Layout extends Mage_Core_Block_Template
{
    private $_titlePage = null;
    private $_levelMenuMax = 1;

    public function getCategoryAll()
    {
        $singleton = Mage::getSingleton('catalog/category');
        $rootcatID = Mage::app()->getStore()->getRootCategoryId();
        return $this->getAllSubCate($singleton, $rootcatID);

    }

    public function setTitlePage($title)
    {
        $this->_titlePage = $title;
    }

    public function getTitlePage()
    {
        return $this->_titlePage;
    }

    public function getSkinDes()
    {
        return Mage::getBaseUrl('skin') . 'frontend/grocery/default/';
    }

    public function getLevelMenuMax()
    {
        /*$product = Mage::getModel('catalog/category')->getCollection();
 
        
            $product = $product
            ->addAttributeToSelect(array('name'))
            ->addFieldToFilter(
                'name',array('gt'=>'a')
            )
            ->getSelect()
            ->columns('level')
            
        
        foreach ($product as $key => $value) {
            var_dump($value);
        }*/
        //return $this->_levelMenuMax;


    }

    private function getAllSubCate($singleton, $id)
    {
        $str = '';
        $sub = $singleton->load($id);

        if ($sub->getData('level') > 1) {
            $maxlevel = $sub->getData('level');
            $option_taga = $option_tagli = '';
            if ($sub->getData('children_count') > 0) {
                $option_taga = ($sub->getData('level') == 2) ? ' data-toggle="dropdown" class="dropdown-toggle"' : '';
                $option_tagli = ' class="dropdown"';
            }
            $str .= '<li' . $option_tagli . '><a href="' . Mage::getBaseUrl() . $sub->getData('url_path') . '" ' . $option_taga . '>'
                . $sub->getData('name') . '</a>
                    ';
        }
        if ($sub->getData('children_count') > 0) {
            $option_submenu = ($sub->getData('level') >= 3) ? ' sub-menu sub-menu-' . ($sub->getData('level') - 2) : '';
            if ($sub->getData('level') > 1)
                $str .= '<ul class="dropdown-menu' . $option_submenu . '">
                    ';

            foreach (explode(',', $sub->getChildren()) as $idChild) {
                $str .= $this->getAllSubCate($singleton, $idChild);

            }
            if ($sub->getData('level') > 1)
                $str .= '</ul>
                ';
        }
        $str .= '</li>
                ';
        return $str;
    }


}