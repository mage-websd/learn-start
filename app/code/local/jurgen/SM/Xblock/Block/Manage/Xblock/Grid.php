<?php

class SM_Xblock_Block_Manage_Xblock_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
        parent::__construct();
        $this->setId('xblockGrid');
        $this->setDefaultSort('creation_time');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('xblock/xblock')->getCollection();
        $store = $this->_getStore();
        if ($store->getId()) {
            $collection->addStoreFilter($store);
        }
        if (!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('block_id', array(
                'header'    => Mage::helper('xblock')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'block_id',
        ));

        $this->addColumn('title', array(
                'header'    => Mage::helper('xblock')->__('Title'),
                'align'     =>'left',
                'index'     => 'title',
        ));


        $this->addColumn('creation_time', array(
                'header'    => Mage::helper('xblock')->__('Created'),
                'align'     => 'left',
                'width'     => '120px',
                'type'      => 'date',
                'default'   => '--',
                'index'     => 'creation_time',
        ));

        $this->addColumn('update_time', array(
                'header'    => Mage::helper('xblock')->__('Updated'),
                'align'     => 'left',
                'width'     => '120px',
                'type'      => 'date',
                'default'   => '--',
                'index'     => 'update_time',
        ));

        $this->addColumn('is_active', array(
                'header'    => Mage::helper('xblock')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                        1 => Mage::helper('xblock')->__('Enabled'),
                        2 => Mage::helper('xblock')->__('Disabled'),
                        //3 => Mage::helper('xblock')->__('Hidden'),
                ),
        ));

        $this->addColumn('action',
                array(
                'header'    =>  Mage::helper('xblock')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption'   => Mage::helper('xblock')->__('Edit'),
                                'url'       => array('base'=> '*/*/edit'),
                                'field'     => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
