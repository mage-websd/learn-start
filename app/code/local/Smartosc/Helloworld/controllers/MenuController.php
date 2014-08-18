<?php
class Smartosc_Helloworld_MenuController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $singleton = Mage::getSingleton('catalog/category');
        $rootcatID = Mage::app()->getStore()->getRootCategoryId();
        return $this->menuAll($singleton, $rootcatID);
    }
    private function menuAll($singleton, $id)
    {
        $str = '';
        $sub = $singleton->load($id);

        if ($sub->getData('level') > 1) {
            //$maxlevel = $sub->getData('level');
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