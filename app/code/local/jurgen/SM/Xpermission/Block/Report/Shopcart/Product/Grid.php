<?php
/**
 * Adminhtml products in carts report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Shopcart_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('gridProducts');
    }

    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('reports/product_collection')
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('price')
                ->setStoreId('')
                ->addCartsCount()
                ->addOrdersCount()
                ->setSelectCountSqlType(Mage_Reports_Model_Mysql4_Product_Collection::SELECT_COUNT_SQL_TYPE_CART);
        /* @var $collection Mage_Reports_Model_Mysql4_Product_Collection */
        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('entity_id', array(
                'header'    =>Mage::helper('reports')->__('ID'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'entity_id'
        ));

        $this->addColumn('name', array(
                'header'    =>Mage::helper('reports')->__('Product Name'),
                'index'     =>'name'
        ));

        $this->addColumn('price', array(
                'header'    =>Mage::helper('reports')->__('Price'),
                'width'     =>'80px',
                'type'      =>'currency',
                'currency_code' => $this->getCurrentCurrencyCode(),
                'index'     =>'price',
                'renderer'  =>'adminhtml/report_grid_column_renderer_currency'
        ));

        $this->addColumn('carts', array(
                'header'    =>Mage::helper('reports')->__('Carts'),
                'width'     =>'80px',
                'align'     =>'right',
                'index'     =>'carts'
        ));

        $this->addColumn('orders', array(
                'header'    =>Mage::helper('reports')->__('Orders'),
                'width'     =>'80px',
                'align'     =>'right',
                'index'     =>'orders'
        ));

        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportProductCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportProductExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }
}

