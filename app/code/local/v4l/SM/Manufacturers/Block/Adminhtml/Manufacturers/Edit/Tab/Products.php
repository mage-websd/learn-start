<?php
class SM_Manufacturers_Block_Adminhtml_Manufacturers_Edit_Tab_Products extends FME_Manufacturers_Block_Adminhtml_Manufacturers_Edit_Tab_Products {

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection() {

        // get collection
        $collection = Mage::getModel('catalog/product')->getCollection();

        // join with related tables
        $resource = Mage::getSingleton('core/resource');
        $collection->getSelect()
            ->join(array('manual' => $resource->getTableName('manufacturers_products')), 'manual.product_id = e.entity_id', array('position' => 'position'));

        $collection->addAttributeToSelect('*');

        $productIds = $this->_getSelectedProducts();
        if (empty($productIds)) {
            $productIds = array(0);
        }

        $collection->addFieldToFilter('entity_id', array('in'=>$productIds));

        $this->setCollection($collection);
        $gridBlock = $this->getLayout()->createBlock('adminhtml/widget_grid');

        return $gridBlock::_prepareCollection();
    }

    /**
     * Add columns to grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        if (!$this->isReadonly()) {
            $this->addColumn('in_products', array(
                'header_css_class'  => 'a-center',
                'type'              => 'checkbox',
                'name'              => 'in_products',
                'values'            => $this->_getSelectedProducts(),
                'align'             => 'center',
                'index'             => 'entity_id'
            ));
        }

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('catalog')->__('ID'),
            'sortable'  => true,
            'width'     => 60,
            'index'     => 'entity_id'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('catalog')->__('Name'),
            'index'     => 'name'
        ));

        $this->addColumn('type', array(
            'header'    => Mage::helper('catalog')->__('Type'),
            'width'     => 100,
            'index'     => 'type_id',
            'type'      => 'options',
            'options'   => Mage::getSingleton('catalog/product_type')->getOptionArray(),
        ));

        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
            ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
            ->load()
            ->toOptionHash();

        $this->addColumn('set_name', array(
            'header'    => Mage::helper('catalog')->__('Attrib. Set Name'),
            'width'     => 130,
            'index'     => 'attribute_set_id',
            'type'      => 'options',
            'options'   => $sets,
        ));

        $this->addColumn('status_product', array(
            'header'    => Mage::helper('catalog')->__('Status'),
            'width'     => 90,
            'index'     => 'status',
            'type'      => 'options',
            'options'   => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));

        $this->addColumn('visibility', array(
            'header'    => Mage::helper('catalog')->__('Visibility'),
            'width'     => 90,
            'index'     => 'visibility',
            'type'      => 'options',
            'options'   => Mage::getSingleton('catalog/product_visibility')->getOptionArray(),
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('catalog')->__('SKU'),
            'width'     => 80,
            'index'     => 'sku'
        ));

        $this->addColumn('price', array(
            'header'        => Mage::helper('catalog')->__('Price'),
            'type'          => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index'         => 'price'
        ));
        
        $this->addColumn('position[]', array(
            'header'    => Mage::helper('catalog')->__('Position'),
            'width'     => '1',
            'type'      => 'number',
            'index'     => 'position',
            'align'     => 'right',
            'editable'  => true,
            'renderer'  => 'SM_Manufacturers_Block_Adminhtml_Manufacturers_Edit_Tab_Renderer_Position',
        ));

        $this->sortColumnsByOrder();
        return $this;
    }

    /**
     * Retrieve selected related products
     *
     * @return array
     */
    public function _getSelectedProducts()
    {
        $products = $this->getManufacturerProductsRelated();
        if (!is_array($products)) {
            $products = array_keys($this->getManufacturerProducts());
        }
        return $products;
    }

    /**
     * Retrieve related products
     *
     * @return array
     */
    public function getManufacturerProducts()
    {

        $id = $this->getRequest()->getParam('id');
        $productsArr = array();
        foreach (Mage::registry('current_manufacturer_products')->getManufacturerRelatedProducts($id) as $products) {
            $productsArr[$products["product_id"]] = array('position' => $products['position']);
        }
        return $productsArr;

    }

}