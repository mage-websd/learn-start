<?php
/**
 * Adminhtml reviews by products report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Review_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    
    public function __construct() {
        parent::__construct();
        $this->setId('gridProducts');
        $this->setDefaultSort('review_cnt');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('reports/review_product_collection')
                ->joinReview();
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
                'index'     =>'entity_id'
        ));

        $this->addColumn('name', array(
                'header'    => Mage::helper('reports')->__('Product Name'),
                'index'     => 'name'
        ));

        $this->addColumn('review_cnt', array(
                'header'    =>Mage::helper('reports')->__('Number of Reviews'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'review_cnt'
        ));

        $this->addColumn('avg_rating', array(
                'header'    =>Mage::helper('reports')->__('Avg. rating'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'avg_rating'
        ));

        $this->addColumn('avg_rating_approved', array(
                'header'    =>Mage::helper('reports')->__('Avg. approved rating'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'avg_rating_approved'
        ));

        $this->addColumn('last_created', array(
                'header'    =>Mage::helper('reports')->__('Last Review'),
                'width'     =>'150px',
                'index'     =>'last_created',
                'type'      =>'datetime'
        ));

        $this->addColumn('action', array(
                'header'    => Mage::helper('reports')->__('Action'),
                'width'     => '100px',
                'align'     => 'center',
                'filter'    => false,
                'sortable'  => false,
                'renderer'  => 'adminhtml/report_grid_column_renderer_product'
        ));

        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportProductCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportProductExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/catalog_product_review/', array('productId' => $row->getId()));
    }
}