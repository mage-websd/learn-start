<?php
class Smartosc_Helloworld_CoreController extends
    Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        var_dump($this);
    }
    public function productAction()
    {
        $product = Mage::getModel('catalog/product');
        $product
            ->loadByAttribute('sku','msj005');
            //->addAttributeToSelect('sku');
            //->addAttributeToFilter('price', array('gt'=>'100'));

//        foreach($product as $d) {
//            var_dump($d->getSku());
//        }
        var_dump($product->getSku());

    }
    public function pageAction()
    {
        $page = Mage::getModel('cms/page')->getCollection()->load('Home page','title');
        var_dump($page->getData());
    }

    public function categoryAction()
    {
        $cat = Mage::getModel('catalog/category')->load(4);
        $subcats = $cat->getChildren();
        foreach(explode(',',$subcats) as $subCatid) {
            $_category = Mage::getModel('catalog/category')->load($subCatid);

            if($_category->getIsActive()) {
                echo '<ul><a href="'.$_category->getURL().'" title="View the products for the "'
                    .$_category->getName().'" category">'.$_category->getName().'</a>';
                $sub_cat = Mage::getModel('catalog/category')->load($_category->getId());
                $sub_subcats = $sub_cat->getChildren();
                foreach(explode(',',$sub_subcats) as $sub_subCatid) {
                    $_sub_category = Mage::getModel('catalog/category')->load($sub_subCatid);
                    if($_sub_category->getIsActive()) {
                        echo '<li class="sub_cat"><a href="'.$_sub_category->getURL().
                            '" title="View the products for the "'.$_sub_category->getName().'" category">'
                            .$_sub_category->getName().'</a></li>';
                        $sub_sub_cat = Mage::getModel('catalog/category')->load($sub_subCatid);
                        $sub_sub_subcats = $sub_sub_cat->getChildren();
                        foreach(explode(',',$sub_sub_subcats) as $sub_sub_subCatid)
                        {
                            $_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_subCatid);
                            if($_sub_sub_category->getIsActive()) {
                                echo '<li class="sub_cat"><a href="'.$_sub_sub_category->getURL().
                                    '" title="View the products for the "'.$_sub_sub_category->getName().
                                    '" category">'.$_sub_sub_category->getName().'</a></li>';
                            }
                        }
                    }
                }
                echo '</ul>';
            }
        }
    }
    public function categoryAllAction()
    {

        $categorySingletonAll = Mage::getSingleton('catalog/category');
//        $categoryConllectionAll = $categorySingletonAll->getCollection();
//        $arrayCategory = array();
//        //var_dump($categoryConllectionAll->getData());
//        $stt = 0;
//        foreach($categoryConllectionAll as $category ) {
//            $categoryId = $category->getId();
//            $categoryData = $categorySingletonAll->load($categoryId);
//            //var_dump($categoryData->getData());
//            if($categoryData->getData('name') == 'Root Catalog')
//                continue;
//            //var_dump($categoryData->getData('parent_id'));
//            //if($categoryData->getData('parent_id') == 1)
//            //    continue;
//            $arrayCategory[$stt]['id'] = $categoryId;
//            $arrayCategory[$stt]['name'] = $categoryData->getData('name');
//            $arrayCategory[$stt]['url'] = Mage::getBaseUrl().$categoryData->getData('url_path');
//            $arrayCategory[$stt]['parent'] = $categoryData->getData('parent_id');
//            $arrayCategory[$stt]['childCount'] = $categoryData->getData('children_count');
//            $arrayCategory[$stt]['active'] = $categoryData->getData('is_active');
//            $arrayCategory[$stt]['level'] = $categoryData->getData('level');
//            $stt++;
//        }
//        var_dump($arrayCategory);
//        $str = $this->showCategoryAll($arrayCategory,1);
//        echo $str;
        echo $this->getAllSubCate($categorySingletonAll,1);

    }
//    private function showCategoryAll($arrayCategory,$id)
//    {
//        $str = '';
//        $str .= '<ul>';
//        foreach($arrayCategory as $category) {
//            if($category['id'] == $id) {
//                $str .= '<li><a href="'.$category['url'].'">'.$category['name'].'</a></li>';
//            }
//        }
//        $str .= $this->showCategorySub($arrayCategory,$id);
//        $str .= '</ul>';
//        return $str;
//    }
//    private function showCategorySub($arrayCategory,$id)
//    {
//        $str = '<ul>';
//        foreach($arrayCategory as $category) {
//            if($category['active'] && $category['parent'] == $id) {
//                $str .= '<li><a href="'.$category['url'].'">'.$category['name'].'</a></li>';
//                if($category['childCount'] > 0) {
//                    $str .= $this->showCategorySub($arrayCategory,$category['id']);
//                }
//            }
//        }
//        $str .= '</ul>';
//        return $str;
//    }

    private function getAllSubCate($singleton,$id)
    {
        $str = '<ul>';
        $sub = $singleton->load($id);
        if($sub->getData('level') > 1)
            $str .= '<li><a href="'.Mage::getBaseUrl().$sub->getData('url_path').'">'
                .$sub->getData('name').'</a></li>';
        if($sub->getData('children_count') > 0) {
            foreach(explode(',',$sub->getChildren()) as $idChild) {
                $str .= $this->getAllSubCate($singleton,$idChild);
            }
        }
        $str .= '</ul>';
        return $str;
    }

    public function cateStoreAction()
    {
        $singleton = Mage::getSingleton('catalog/category');
        $rootcatID = Mage::app()->getStore()->getRootCategoryId();
        echo $this->getAllSubCate($singleton,$rootcatID);

    }
    public function productCateAction()
    {
        //$this->getCurrentCategory();
        $categoryId = 42; // a category id that you can get from admin
        $category = Mage::getModel('catalog/category')->load($categoryId);

        $products = Mage::getModel('catalog/product');
            //->getCollection()
            //->addCategoryFilter($category)
            //->load();

        //var_dump($products->getData());
        var_dump($products->getProductUrl());
        var_dump($products->getUrlInStore());
        var_dump($products->getUrlPath());
    }

}
