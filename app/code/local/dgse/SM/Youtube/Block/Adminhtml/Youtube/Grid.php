<?php

class SM_Youtube_Block_Adminhtml_Youtube_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('youtubeGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sm_youtube/youtube')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('sm_youtube')->__('ID'),
            'width'     => '30px',
            'index'     => 'entity_id',
            'type'      => 'number'
        ));
//        $this->addColumn('image', array(
//            'header'    => Mage::helper('sm_youtube')->__('Image'),
//            'index'     => 'image',
//            'width'     => '150px',
//            'height'    => '80px',
//
//            'filter'    => false
//        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('sm_youtube')->__('Title'),
            'index'     => 'title',
            'width'     => '350px'
        ));

        $this->addColumn('link', array(
            'header'    => Mage::helper('sm_youtube')->__('Link'),
            'width'     => '150',
            'index'     => 'link'
        ));


        $this->addColumn('active', array(
            'header'    => Mage::helper('sm_youtube')->__('Active'),
            'width'     => '100',
            'index'     => 'active',
            'type'      => 'options',
            'options'   => array(
                '1' => Mage::helper('sm_youtube')->__('Enable'),
                '0' => Mage::helper('sm_youtube')->__('Disable'),
            )
        ));


        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('sm_youtube')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sm_youtube')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('sm_youtube')->__('CSV'));
        $this->addExportType('*/*/exportCsv', Mage::helper('sm_youtube')->__('Excel File'));
        $this->addExportType('*/*/exportXml', Mage::helper('sm_youtube')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    /**
     * Hàm thực hiện call hàm delete or change status khi selected action
     *
     */

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('sm_youtube')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('sm_youtube')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('sm_youtube/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('sm_youtube')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('sm_youtube')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    /**
     * Hàm thực hiện call hàm edit khi cho việc thục hiện edit cate
     *
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

    /**
     * Hàm for call script used grid of module
     *
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}
