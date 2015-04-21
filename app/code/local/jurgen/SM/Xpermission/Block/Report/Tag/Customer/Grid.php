<?php
/**
 * Adminhtml tags by customers report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Block_Report_Tag_Customer_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    
    public function __construct() {
        parent::__construct();
        $this->setId('grid');
    }

    protected function _prepareCollection() {

        $collection = Mage::getResourceModel('reports/tag_customer_collection');

        $collection->addStatusFilter(Mage::getModel('tag/tag')->getApprovedStatus())
                ->addGroupByCustomer()
                ->addTagedCount();
        if(!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn('entity_id', array(
                'header'    =>Mage::helper('reports')->__('ID'),
                'width'     => '50px',
                'align'     =>'right',
                'index'     =>'entity_id'
        ));

        $this->addColumn('firstname', array(
                'header'    =>Mage::helper('reports')->__('First Name'),
                'index'     =>'firstname'
        ));

        $this->addColumn('lastname', array(
                'header'    =>Mage::helper('reports')->__('Last Name'),
                'index'     =>'lastname'
        ));

        $this->addColumn('taged', array(
                'header'    =>Mage::helper('reports')->__('Total Tags'),
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
                                        'base'=>'*/*/customerDetail'
                                ),
                                'field'   => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
        ));

        $this->setFilterVisibility(false);

        $this->addExportType('*/*/exportCustomerCsv', Mage::helper('reports')->__('CSV'));
        $this->addExportType('*/*/exportCustomerExcel', Mage::helper('reports')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/customerDetail', array('id'=>$row->getId()));
    }

}

