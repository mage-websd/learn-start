<?php
/**
 * Created by PhpStorm.
 * User: SnguyenPC
 * Date: 01/12/2014
 * Time: 13:39
 */

class SM_ProductTop_Block_ProductTop extends Mage_Catalog_Block_Product_List
{
    /**
     *
     * Check result return after call collection
     *
     */
    protected $_dataCollection = null;

    /**
     * Number get number inventory
     *
     */
    protected $_numberInventory = 30;

    /**
     *  Funtion get new 30 inventory product magento
     *
     * return: object have all product with condition
     *
     */

    function getProductNews(){
        $_productNews = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributetoSelect('*')
            ->joinField('qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left')
            ->addAttributeToFilter('visibility', array('neq' => 1))
            ->addAttributeToFilter('status', 1)
            ->addAttributeToSort('entity_id', 'desc')
            ->addAttributeToFilter('qty', array("gt" => 0))
            ->setPageSize($this->_numberInventory)
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
        $data = array();
        if(count($_productNews) >0){
            foreach($_productNews as $_productNew){
                $data[] = $_productNew->getEntityId();
            }
        }
        return $data;
    }

    public function _getProductCollection()
    {
        $_productnews = $this->getProductNews();
        if(empty($this->_productCollection)) {
            $this->_productCollection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributetoSelect('*')
                ->addAttributeToFilter('visibility', array('neq' => 1))
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('entity_id',array('in'=>$_productnews))
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

} 