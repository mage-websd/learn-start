<?php
class Threemauto_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('news_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('news/news')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('news')->__('ID'),
            'type'=>'number',
            'align' => 'right',
            'width' => '10px',
            'index' => 'id',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('news')->__('Title'),
            'align' => 'left',
            'index' => 'title',
            'width' => '50px',
        ));


        $this->addColumn('description', array(
            'header' => Mage::helper('news')->__('Description'),
            'width' => '150px',
            'index' => 'description',
        ));

        /*$this->addColumn('tag', array(
            'header' => Mage::helper('news')->__('Tag'),
            'width' => '150px',
            'index' => 'tag',
        ));


        $this->addColumn('date', array(
            'header' => Mage::helper('news')->__('Posted On'),
            'width' => '150px',
            'index' => 'date',
        ));*/

        return parent::_prepareColumns();
    }


    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}