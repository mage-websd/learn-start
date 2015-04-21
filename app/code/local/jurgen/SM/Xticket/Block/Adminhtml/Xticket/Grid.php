<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

class SM_Xticket_Block_Adminhtml_Xticket_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
        parent::__construct();
        $this->setId('xticketGrid');
        $this->setDefaultSort('timestamp');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('xticket/xticket')->getCollection();
        $store = $this->_getStore();
        if ($store->getId()) {
            $collection->addStoreFilter($store);
        }
		/*
        if (!Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $collection->addWebsiteFilter(Mage::getSingleton('admin/session')->getUser()->getWebsiteId());
        }*/
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }	  

    protected function _prepareColumns() {
        $this->addColumn('code', array(
                'header'    => Mage::helper('xticket')->__('ID'),
                'align'     =>'right',
                'width'     => '70px',
                'index'     => 'code',
        ));
        $this->addColumn('created_time', array(
                'header'    => Mage::helper('xticket')->__('Created'),
                'align'     =>'right',
                'width'     => '70px',
                'default'   => '--',
                'index'     => 'created_time',
        ));
        $this->addColumn('timestamp', array(
                'header'    => Mage::helper('xticket')->__('Last reply'),
                'align'     =>'right',
                'width'     => '70px',
                'index'     => 'timestamp',
        ));
//	      $this->addColumn('cat', array(
//	          'header'    => Mage::helper('xticket')->__('Department'),
//	          'align'     =>'right',
//	          'width'     => '70px',
//	          'index'     => 'cat',
//			  'filter_index' => 'main_table.cat',
//	      ));	
        $this->addColumn('name', array(
                'header'    => Mage::helper('xticket')->__('Name'),
                'align'     =>'left',
                'index'     => 'name',
                'width'     => '200px',
        ));

        $this->addColumn('email', array(
                'header'    => Mage::helper('xticket')->__('Email'),
                'width'     => '250px',
                'index'     => 'email',
        ));
        $this->addColumn('priority', array(
                'header'    => Mage::helper('xticket')->__('Priority'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'priority',
                'type'      => 'options',
                'options'	=> array(	'1' => Mage::helper('xticket')->__('Urgent'),
                        '2' => Mage::helper('xticket')->__('ASAP'),
                        '3' => Mage::helper('xticket')->__('To do'),
                        '4' => Mage::helper('xticket')->__('If time'),
                        '5' => Mage::helper('xticket')->__('Postponed')),
        ));
        $statuses= Mage::getSingleton('xticket/status')->getOptionArray();
        $this->addColumn('status', array(
                'header'    => Mage::helper('xticket')->__('Status'),
                'align'     => 'left',
                'width'     => '150px',
                'index'     => 'status',
                'type'      => 'options',
                'options'   => $statuses,
        ));

        $this->addColumn('Action',
                array(
                'header'    =>  Mage::helper('xticket')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption'   => Mage::helper('xticket')->__('Edit'),
                                'url'       => array('base'=> '*/*/edit'),
                                'field'     => 'id'
                        ),
                        array(
                                'caption'   => Mage::helper('xticket')->__('Put On Hold'),
                                'url'       => array('base'=> '*/*/onhold'),
                                'field'     => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('xticket')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('xticket')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('xticket_id');
        $this->getMassactionBlock()->setFormFieldName('xticket');


        $this->getMassactionBlock()->addItem('delete', array(
                'label'    => Mage::helper('xticket')->__('Delete'),
                'url'      => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('xticket')->__('Are you sure?')
        ));

        $status = Mage::getSingleton('xticket/status');
        $this->getMassactionBlock()->addItem('status', array(
                'label'=> Mage::helper('xticket')->__('Change status'),
                'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                        'visibility' => array(
                                'name' => 'status',
                                'type' => 'select',
                                'class' => 'required-entry',
                                'label' => Mage::helper('xticket')->__('Status'),
                                'values' => $status->getOptionArray(),
                        )
                )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}