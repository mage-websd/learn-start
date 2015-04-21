<?php
/**
 * SM_XAdvertising Extension
 *
 * @category    Local
 * @package     SM_XAdvertising
 * @author      thuanlq (thuanlq@smartosc.com)
 * @copyright   Copyright(c) 2010 SmartOsc Inc. (http://www.smartosc.com)
 *
 */

/**
 * XAdvertising admin grid advertising
 *
 * @category   Local
 * @package    SM_XAdvertising
 * @author     thuanlq <thuanlq@smartosc.com>
 */
class SM_XAdvertising_Block_Admin_Xadvertising_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
  	
      parent::__construct();
      $this->setId('xadvertisingGrid');
      $this->setDefaultSort('unique_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }
   protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }
	
  protected function _prepareCollection()
  {
      $collection = Mage::getModel('xadvertising/xadvertising')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }
   public function _toHtml()
   {
   	 return parent::_toHtml();
   }
  protected function _prepareColumns()
  {
      $this->addColumn('unique_id', array(
          'header'    => Mage::helper('xadvertising')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'unique_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('xadvertising')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

      $this->addColumn('link', array(
			'header'    => Mage::helper('xadvertising')->__('Item Link'),
			'width'     => '350px',
			'index'     => 'link',
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('xadvertising')->__('Status'),
          'align'     => 'left',
          'width'     => '50px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('xadvertising')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('xadvertising')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('xadvertising')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('xadvertising')->__('XML'));
	  
      return $this;
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('news_id');
        $this->getMassactionBlock()->setFormFieldName('xadvertising');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('xadvertising')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('xadvertising')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('xadvertising/status')->getOptionArray();
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('xadvertising')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('xadvertising')->__('Status'),
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