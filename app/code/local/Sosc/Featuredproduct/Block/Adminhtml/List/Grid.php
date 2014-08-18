<?php
class Sosc_Featuredproduct_Block_Adminhtml_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        /*$p = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('*');
        foreach($p as $pr) {
            var_dump($pr->getData());
            exit;
        }
        exit;*/
        parent::__construct(); # for grids, parent constructor should be called first

        $this->setId('list_Grid'); # not sure where the grid id gets used
        $this->setDefaultSort('name'); # sets the default sort column
        $this->setDefaultDir('asc'); # sets the default sort direction
        $this->setSaveParametersInSession(false); # this sets filters and sorts in the session, as opposed to using the url
    }

    /**
     * Prepare grid collection object
     *
     * @return Examples_AdminGridAndForm_Block_Adminhtml_Thing_Grid
     */
    /**
     * @get Data for grid
     */
    protected function _prepareCollection()
    {
        //entity_id, name, type, price, qty
        $limit = Mage::app()->getRequest()->getParam('limit');
        $page = Mage::app()->getRequest()->getParam('page');

        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('price');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Examples_AdminGridAndForm_Block_Adminhtml_Thing_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id', # the column id
            array(
                'type'     => 'number', # needed for using a ranged filter
                'header'   => Mage::helper('featuredproduct')->__('ID'),
                'width'    => '40px',
                'index'    => 'entity_id', # index is the name of the data in the entity
                'sortable' => true, # defaults to true so this is pointless, just using as an example, can be true or false
            )
        );
        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('featuredproduct')->__('Name'),
                'width'  => '400px',
                'index'  => 'name',
            )
        );
        $this->addColumn(
            'type',
            array(
                'width'    => '150px',
                'header' => Mage::helper('featuredproduct')->__('Type'),
                'index'  => 'type_id',
                'type' => 'options',
                'options' => Mage::getSingleton('catalog/product_type')->getOptionArray(),
            )
        );
        $this->addColumn(
            'price',
            array(
                'type'=>'price',
                'header' => Mage::helper('featuredproduct')->__('Price'),
                'index'  => 'price',
                'sortable'=>true,
            )
        );
        $this->addExportType('*/*/exportCsv', 'CSV');
        $this->addExportType('*/*/exportXml', 'XML');
        return parent::_prepareColumns();
    }

    /**
     * Return a URL to be used for each row
     *
     * If you don't wish rows to return a URL, simply omit this method
     *
     * @param Varien_Object $row The row for which to supply a URL
     *
     * @return string The row URL
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Prepare grid mass actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('thing_id');
        $this->getMassactionBlock()->setFormFieldName('thing');
        $this->getMassactionBlock()->addItem(
            'save',
            array(
                'label'   => 'Save Product Featured',
                'url'     => $this->getUrl('*/*/'),
                //'confirm' => Mage::helper('examples_admingridandform')->__('Are you sure?')
            )
        );
        return $this;
    }
}
