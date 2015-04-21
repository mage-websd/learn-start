<?php

/**
 * Created by PhpStorm.
 * User: SCORPION
 * Date: 12/2/14
 * Time: 5:09 PM
 */
class SM_ProductUnder_Block_List extends Mage_Catalog_Block_Product_List
{
    /**
     * get items have price under $500
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $this->_productCollection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('price', array('lteq' => 500))
                ->addAttributeToFilter('visibility', array('neq' => 1))
                ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                ->addAttributeToFilter('qty', array("gt" => 0))
                ->addAttributeToFilter(array(
                    array(
                        'attribute' => 'image',
                        'neq'       => 'no_selection',
                    ),
                    array(
                        'attribute' => 'require_img',
                        'eq'       => '1',
                    ),
                ));
        }

        return $this->_productCollection;
    }


    /**
     * add title page and breadcrumb
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        // add title page
        $this->getLayout()->getBlock('head')->setTitle($this->__('Gifts Under $500'));
        // add Home breadcrumb
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb('home', array(
                'label' => $this->__('Home'),
                'title' => $this->__('Go to Home Page'),
                'link' => Mage::getBaseUrl()
            ))->addCrumb('Gifts Under $500', array(
                    'label' => 'Gifts Under $500',
                    'title' => 'Gifts Under $500'
                ));
        }
    }
}