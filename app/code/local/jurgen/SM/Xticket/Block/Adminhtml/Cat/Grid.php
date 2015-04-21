<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Cat_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('catGrid');
      $this->setDefaultSort('name');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

    protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('xticket/cats')->getCollection();
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

  protected function _prepareColumns()
  {
      $this->addColumn('ID', array(
          'header'    => Mage::helper('xticket')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'ID',
      ));

		$this->addColumn('is_active', array(
		  'header'    => Mage::helper('xticket')->__('Active'),
		  'align'     => 'left',
		  'index'     => 'is_active',
		  'type'      => 'options',
		  'options'   => array(
			  1 => Mage::helper('xticket')->__('Yes'),
			  0 => Mage::helper('xticket')->__('No'),
		  ),
		));

      $this->addColumn('name', array(
          'header'    => Mage::helper('xticket')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));

		$this->addColumn('is_active', array(
		  'header'    => Mage::helper('xticket')->__('Active'),
		  'align'     => 'left',
		  'index'     => 'is_active',
		  'type'      => 'options',
		  'options'   => array(
			  1 => Mage::helper('xticket')->__('Yes'),
			  0 => Mage::helper('xticket')->__('No'),
		  ),
		));
	  
      $this->addColumn('email', array(
          'header'    => Mage::helper('xticket')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));
      
/*      $this->addColumn('signature', array(
          'header'    => Mage::helper('xticket')->__('Signature'),
          'align'     =>'left',
          'index'     => 'signature',
      ));*/
      
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

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('xticket_id');
        $this->getMassactionBlock()->setFormFieldName('xticket');


        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('xticket')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('xticket')->__('Are you sure?')
        ));

        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}