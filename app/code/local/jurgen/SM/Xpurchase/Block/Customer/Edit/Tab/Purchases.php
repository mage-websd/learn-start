<?php
class SM_Xpurchase_Block_Customer_Edit_Tab_Purchases extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_purchases_grid');
        $this->setDefaultSort('`sales/order`.created_at', 'desc');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        //TODO: add full name logic
        $collection = Mage::getResourceModel('sales/order_item_collection')
            ->join('sales/order','order_id=entity_id')
            ->addFieldToFilter('customer_id', Mage::registry('current_customer')->getEntityId())
        ;
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('increment_id', array(
            'header'    => Mage::helper('customer')->__('Order #'),
            'width'     => '100',
            'index'     => 'increment_id',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('customer')->__('Purchase On'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('customer')->__('Sku'),
            'index'     => 'sku',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('customer')->__('Product'),
            'index'     => 'name',
        ));
        $this->addColumn('qty_ordered', array(
            'header'    => Mage::helper('customer')->__('Quantity'),
            'index'     => 'qty_ordered',
            'type'      => 'number',
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('customer')->__('Price'),
            'index'     => 'price',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
        ));

        $this->addColumn('grand_total', array(
            'header'    => Mage::helper('customer')->__('Total'),
            'index'     => 'grand_total',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => Mage::helper('customer')->__('Bought From'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view' => true
            ));
        }

		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('customer')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getOrderId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('customer')->__('View order'),
						'url'       => array('base'=> 'admin/sales_order/view'),
						'field'     => 'order_id'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('admin/catalog_product/edit', array('id' => $row->getProductId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/purchases', array('_current' => true));
    }

}