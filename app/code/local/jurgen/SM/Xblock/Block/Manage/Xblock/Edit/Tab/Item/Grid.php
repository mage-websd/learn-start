<?php

class SM_Xblock_Block_Manage_Xblock_Edit_Tab_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
        parent::__construct();
        $this->setId('xblockItemGrid');
        $this->setDefaultSort('creation_time');
        $this->setDefaultDir('DESC');
        //$this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection() {
        $collection = Mage::getModel('xblock/item')->getCollection();
        $blockId = (int) Mage::app()->getRequest()->getParam('id', false);
        $collection->addItemFilter($blockId);
   
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $blockId = (int) Mage::app()->getRequest()->getParam('id', false);
        $this->setChild('add_new_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label'     => Mage::helper('xblock')->__('Add Item'),
                'onclick'	=>	"setLocation('". $this->getUrl('*/manage_item/new/', array('block_id' => $blockId))."')",
                'class'   => 'add'
                ))
        );
        $this->addColumn('title_item', array(
                'header'    => Mage::helper('xblock')->__('Title'),
                'align'     =>'left',
                'index'     => 'title_item',
        ));

        $this->addColumn('content', array(
                'header'    => Mage::helper('xblock')->__('Content'),
                'align'     =>'left',
                'index'     => 'content',
                'getter'    => 'getContent'
        ));

        $this->addColumn('sort_order', array(
                'header'    => Mage::helper('xblock')->__('Sort Order'),
                'align'     =>'left',
                'index'     => 'sort_order',
        ));

        $this->addColumn('is_active_item', array(
                'header'    => Mage::helper('xblock')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active_item',
                'type'      => 'options',
                'options'   => array(
                        1 => Mage::helper('xblock')->__('Enabled'),
                        0 => Mage::helper('xblock')->__('Disabled'),
                ),
        ));

        $this->addColumn('action',
                array(
                'header'    =>  Mage::helper('xblock')->__('Delete'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption'   => Mage::helper('xblock')->__('Delete'),
                                'url'       => array('base'=> '*/manage_item/delete/'),
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
        return $this->getUrl('*/manage_item/edit/', array('id' => $row->getId(), 'block_id' => $row->getBlockId()));
    }

    public function getHeaderText() {
        if( Mage::registry('xblock_data') && Mage::registry('xblock_data')->getId() ) {
            return Mage::helper('xblock')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('xblock_data')->getTitle()));
        } else {
            return Mage::helper('xblock')->__('Add Item');
        }
    }
}
