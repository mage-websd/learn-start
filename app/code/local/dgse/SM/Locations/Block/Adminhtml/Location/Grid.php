<?php

class SM_Locations_Block_Adminhtml_Location_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('sm_locations_location_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sm_locations/locations')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('location_id',
            array(
                'header' => $this->__('location ID'),
                'align' =>'right',
                'width' => '70px',
                'index' => 'location_id'
            )
        );

        $this->addColumn('location_title',
            array(
                'header' => $this->__('location Title'),
                'index' => 'location_title'
            )
        );
        $this->addColumn('location_page',
            array(
                'header' => $this->__('location page'),
                'index' => 'location_page'
            )
        );

        $this->addColumn('location_email',
            array(
                'header' => $this->__('location Email'),
                'index' => 'location_email'
            )
        );
        $this->addColumn('telephone',
            array(
                'header' => $this->__('Telephone'),
                'index' => 'telephone'
            )
        );

        $this->addColumn('location_content',
            array(
                'header' => $this->__('location Content'),
                'index' => 'location_content'
            )
        );

        $this->addColumn('action',
            array(
                'header' => $this->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('catalog')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit',
                            'params'=>array('store'=>$this->getRequest()->getParam('store'))
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
            )
        );


        return parent::_prepareColumns();

    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}