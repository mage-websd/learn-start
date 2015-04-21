<?php
/**
 * Adminhtml search report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Search_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    /**
     * Initialize Grid Properties
     *
     */
    public function __construct() {
        parent::__construct();
        $this->setId('searchReportGrid');
        $this->setDefaultSort('query_id');
        $this->setDefaultDir('desc');
    }

    /**
     * Prepare Search Report collection for grid
     *
     * @return Mage_Adminhtml_Block_Report_Search_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('catalogsearch/query_collection');
        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Report_Search_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('query_id', array(
                'header'    =>Mage::helper('reports')->__('ID'),
                'width'     =>'50px',
                'filter'    =>false,
                'index'     =>'query_id',
                'type'      =>'number'
        ));

        $this->addColumn('query_text', array(
                'header'    =>__('Search Query'),
                'filter'    =>false,
                'index'     =>'query_text'
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                    'header'        => Mage::helper('catalog')->__('Store'),
                    'index'         => 'store_id',
                    'type'          => 'store',
                    'store_view'    => true,
                    'sortable'      => false
            ));
        }

        $this->addColumn('num_results', array(
                'header'    =>Mage::helper('reports')->__('Results'),
                'width'     =>'50px',
                'align'     =>'right',
                'type'      =>'number',
                'index'     =>'num_results'
        ));

        $this->addColumn('popularity', array(
                'header'    =>Mage::helper('reports')->__('Hits'),
                'width'     =>'50px',
                'align'     =>'right',
                'type'      =>'number',
                'index'     =>'popularity'
        ));

        $this->addExportType('*/*/exportSearchCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportSearchExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    /**
     * Retrieve Row Click callback URL
     *
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/catalog_search/edit', array('id' => $row->getId()));
    }
}

