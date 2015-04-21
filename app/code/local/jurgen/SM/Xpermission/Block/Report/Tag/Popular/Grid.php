<?php
/**
 * Adminhtml popular tags report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Tag_Popular_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('grid');
    }

    protected function _prepareCollection() {

        if ($this->getRequest()->getParam('website')) {
            $storeId = Mage::app()->getWebsite($this->getRequest()->getParam('website'))->getStoreIds();
        } else if ($this->getRequest()->getParam('group')) {
            $storeId = Mage::app()->getGroup($this->getRequest()->getParam('group'))->getStoreIds();
        } else if ($this->getRequest()->getParam('store')) {
            $storeId = (int)$this->getRequest()->getParam('store');
        } else {
            $storeId = '';
        }

        $collection = Mage::getResourceModel('reports/tag_collection')
                ->addSummary($storeId)
                ->addStatusFilter(Mage::getModel('tag/tag')->getApprovedStatus());

        if($storeId != '') {
            $collection->addStoreFilter($storeId);
        }
        //filter by website
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('name', array(
                'header'    =>Mage::helper('reports')->__('Tag Name'),
                'sortable'  =>false,
                'index'     =>'name'
        ));

        $this->addColumn('taged', array(
                'header'    =>Mage::helper('reports')->__('Popularity'),
                'width'     =>'50px',
                'align'     =>'right',
                'sortable'  =>false,
                'index'     =>'popularity'
        ));

        $this->addColumn('uses', array(
                'header'    =>Mage::helper('reports')->__('Number Of Uses'),
                'width'     =>'50px',
                'align'     =>'right',
                'sortable'  =>false,
                'index'     =>'uses'
        ));

        $this->addColumn('historical_uses', array(
                'header'    =>Mage::helper('reports')->__('Number Of Historical Uses'),
                'width'     =>'50px',
                'align'     =>'right',
                'sortable'  =>false,
                'index'     =>'historical_uses'
        ));

        $this->addColumn('action',
                array(
                'header'    => Mage::helper('catalog')->__('Action'),
                'width'     => '100%',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption' => Mage::helper('catalog')->__('Show Details'),
                                'url'     => array(
                                        'base'=>'*/*/tagDetail'
                                ),
                                'field'   => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
        ));
        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportPopularCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportPopularExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/tagDetail', array('id'=>$row->getTagId()));
    }

}
