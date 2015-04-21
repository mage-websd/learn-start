<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */
class SM_Xticket_Block_Adminhtml_Rep_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('repGrid');
      $this->setDefaultSort('ID');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }


  protected function _prepareCollection()
  {
  	  $users = Mage::getModel("admin/user")->getCollection();
  	  if ($users)
      	$this->setCollection($users);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
  	
  	  $this->addColumn('username', array(
          'header'    => Mage::helper('xticket')->__('Username'),
          'align'     =>'left',
          'index'     => 'username',
      ));
      
      $this->addColumn('firstname', array(
          'header'    => Mage::helper('xticket')->__('First Name'),
          'align'     =>'left',
          'index'     => 'firstname',
      ));
      
      $this->addColumn('lastname', array(
          'header'    => Mage::helper('xticket')->__('Last Name'),
          'align'     =>'left',
          'index'     => 'lastname',
      ));
      
      $this->addColumn('email', array(
          'header'    => Mage::helper('xticket')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
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
                        'field'     => 'id',
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

 		
  public function getRowUrl($row)
  {
  		$user=Mage::getSingleton('admin/session')->getUser();
  		$userId=$user->getUserId();
  		if (Mage::helper('xticket')->isAdmin() || $row->getId() == $userId )
      		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
      	return "javascript:alert('".Mage::helper('xticket')->__('Not enough rights')."');";
  }

}