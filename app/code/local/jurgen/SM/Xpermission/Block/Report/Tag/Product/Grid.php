<?php
/**
 * Adminhtml tags by products report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Tag_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('gridProducts');
    }

    protected function _prepareCollection() {

        $collection = Mage::getResourceModel('reports/tag_product_collection');

        $collection->addUniqueTagedCount()
                ->addAllTagedCount()
                ->addStatusFilter(Mage::getModel('tag/tag')->getApprovedStatus())
                ->addGroupByProduct();
        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilterReports(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
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

        $this->addColumn('utaged', array(
                'header'    =>Mage::helper('reports')->__('Number of Unique Tags'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'utaged'
        ));

        $this->addColumn('taged', array(
                'header'    =>Mage::helper('reports')->__('Number of Total Tags'),
                'width'     =>'50px',
                'align'     =>'right',
                'index'     =>'taged'
        ));

        $this->addColumn('action',
                array(
                'header'    => Mage::helper('catalog')->__('Action'),
                'width'     => '100%',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption' => Mage::helper('catalog')->__('Show Tags'),
                                'url'     => array(
                                        'base'=>'*/*/productDetail'
                                ),
                                'field'   => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
        ));

        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportProductCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportProductExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/productDetail', array('id'=>$row->getId()));
    }

}
