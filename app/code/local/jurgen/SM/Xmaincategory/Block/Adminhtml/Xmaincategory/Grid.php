<?php

class SM_Xmaincategory_Block_Adminhtml_Xmaincategory_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{

    public function __construct() 
    {
        parent::__construct();
        $this->setId('xmaincategoryGrid');
        $this->setDefaultSort('xmaincategory_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    public function _prepareLayout() 
    {
        $block = $this->getLayout()->createBlock(
                'Mage_Adminhtml_Block_Store_Switcher', 'store_xmaincategory', array('template' => 'store/xswitcher.phtml')
        );
        $this->getLayout()->getBlock('content')->append($block);

        return parent::_prepareLayout();
    }

    protected function _prepareCollection() 
    {
        if ($this->getRequest()->getParam('store')) {
            $storeIds = array($this->getParam('store'));
            Mage::getSingleton('core/session')->setXStoreID($storeIds[0]);
            $collection = Mage::getModel('xmaincategory/xmaincategory')->getCollection()
                        ->addFieldToFilter('store_id',$storeIds[0]);
                        }
        else{
        Mage::getSingleton('core/session')->setXStoreID("1");
        $collection = Mage::getModel('xmaincategory/xmaincategory')->getCollection()
                ->addFieldToFilter('store_id',"1");}
                
        $this->setCollection($collection);
        
        $storeIds = array();
        
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() 
    {
        $this->addColumn('xmaincategory_id', array(
            'header' => Mage::helper('xmaincategory')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'xmaincategory_id',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('xmaincategory')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        /*
          $this->addColumn('content', array(
          'header'    => Mage::helper('xmaincategory')->__('Item Content'),
          'width'     => '150px',
          'index'     => 'content',
          ));
         */

        $this->addColumn('status', array(
            'header' => Mage::helper('xmaincategory')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('xmaincategory')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('xmaincategory')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        //$this->addExportType('*/*/exportCsv', Mage::helper('xmaincategory')->__('CSV'));
        //$this->addExportType('*/*/exportXml', Mage::helper('xmaincategory')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('xmaincategory_id');
        $this->getMassactionBlock()->setFormFieldName('xmaincategory');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('xmaincategory')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('xmaincategory')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('xmaincategory/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('xmaincategory')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('xmaincategory')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) 
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}