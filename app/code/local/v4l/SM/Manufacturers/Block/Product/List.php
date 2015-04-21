<?php
class SM_Manufacturers_Block_Product_List extends FME_Manufacturers_Block_Product_List {

    protected function _beforeToHtml() {
        parent::_beforeToHtml();
//
//        $toolbar = $this->getToolbarBlock();
//        if ($sort = $this->getSortBy()) {
//            $toolbar->setDefaultOrder($sort);
//        } else {
//            $toolbar->setDefaultOrder('position');
//        }
//
//        if ($dir = $this->getDefaultDirection()) {
//            $toolbar->setDefaultDirection($dir);
//        } else {
//            $toolbar->setDefaultDirection('asc');
//            var_dump($this->getDefaultDirection());die;
//        }
//        if ($modes = $this->getModes()) {
//            $toolbar->setModes($modes);
//        }
        return $this;
    }

    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $id  = $this->getRequest()->getParam('id');
            $collection = Mage::getResourceModel('catalog/product_collection');
            $attributes = Mage::getSingleton('catalog/config')
                ->getProductAttributes();
            $collection->addAttributeToSelect($attributes)
                ->addMinimalPrice()
                ->addFinalPrice()
                ->addTaxPercents()
                ->addStoreFilter();

            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

            // join with related tables
            $resource = Mage::getSingleton('core/resource');
            $collection->getSelect()
                ->join(array('manual' => $resource->getTableName('manufacturers_products')),
                    'manual.product_id = e.entity_id AND manual.manufacturers_id = '.$id,
                    array('manufacturers_position' => 'manual.position'));

            $this->_productCollection = $collection;
        }

        // get order type
        $orderType = $this->getRequest()->getParam('order');
        $dir = $this->getRequest()->getParam('dir');
        if (!$dir) $dir = ' ASC';

        if ($orderType == 'position' || $orderType == null) {
            $this->_productCollection->getSelect()->order(array('manufacturers_position ASC'));
        }

        return $this->_productCollection;
    }

}