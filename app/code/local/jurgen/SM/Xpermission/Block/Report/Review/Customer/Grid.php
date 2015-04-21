<?php
/**
 * Adminhtml reviews by customers report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Review_Customer_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('customers_grid');
        $this->setDefaultSort('review_cnt');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('reports/review_customer_collection')
            ->joinCustomers();

        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('customer_name', array(
            'header'    => Mage::helper('reports')->__('Customer Name'),
            'index'     => 'customer_name',
            'default'   => Mage::helper('reports')->__('Guest'),
        ));

        $this->addColumn('review_cnt', array(
            'header'    => Mage::helper('reports')->__('Number Of Reviews'),
            'width'     => '40px',
            'align'     => 'right',
            'index'     => 'review_cnt'
        ));

        $this->addColumn('action', array(
            'header'    => Mage::helper('reports')->__('Action'),
            'width'     => '100px',
            'align'     => 'center',
            'filter'    => false,
            'sortable'  => false,
            'renderer'  => 'adminhtml/report_grid_column_renderer_customer'
        ));

        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportCustomerCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportCustomerExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/catalog_product_review', array('customerId' => $row->getCustomerId()));
    }
}
