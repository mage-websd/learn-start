<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 12/12/14
 * Time: 3:56 PM
 */
class SM_RequireImage_Block_Catalog_Product_List extends Mage_Catalog_Block_Product_List {
    protected function _beforeToHtml()
    {
        $toolbar = $this->getToolbarBlock();

        // called prepare sortable parameters
        $collection = $this->_getProductCollection();

        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        if ($modes = $this->getModes()) {
            $toolbar->setModes($modes);
        }

        $collection->addAttributeToFilter(array(
            array(
                'attribute' => 'image',
                'neq'       => 'no_selection',
            ),
            array(
                'attribute' => 'require_img',
                'eq'       => '1',
            ),
        ))
            ->addAttributeToFilter('price',array('gt' => 0));
        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);

        $this->setChild('toolbar', $toolbar);
        Mage::dispatchEvent('catalog_block_product_list_collection', array(
            'collection' => $this->_getProductCollection()
        ));

        $this->_getProductCollection()->load();

        return parent::_beforeToHtml();
    }
}