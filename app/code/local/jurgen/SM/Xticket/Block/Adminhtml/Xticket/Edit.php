<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


class SM_Xticket_Block_Adminhtml_Xticket_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'xticket';
        $this->_controller = 'adminhtml_xticket';
        
        $this->_updateButton('delete', 'label', Mage::helper('xticket')->__('Delete Ticket'));
        
        if( $this->getId() )
        	$this->_updateButton('save', 'label', Mage::helper('xticket')->__('Reply to Message'));
        else 
        	$this->_updateButton('save', 'label', Mage::helper('xticket')->__('Save Ticket'));
        
//        if($this->getId() )
//		$this->_addButton('transfer_reps', array(
//            'label'     => Mage::helper('xticket')->__('Transfer Representative'),
//			'class'     => 'transfer_reps',
//		    'onclick'   => 'transferReps(\''. $this->getUrl('*/*/transrep', array("id" => $this->getRequest()->getParam("id"))) .'\')',
//            'level'     => -1
//			), 100);
//
//		if($this->getId() )
//		$this->_addButton('transfer_cats', array(
//            'label'     => Mage::helper('xticket')->__('Transfer Department'),
//			'class'     => 'transfer_cats',
//		    'onclick'   => 'transferCats(\''. $this->getUrl('*/*/transcat', array("id" => $this->getRequest()->getParam("id"))) .'\')',
//            'level'     => -1
//			), 100);
//
//		if($this->getId() )
//		$this->_addButton('newstat', array(
//            'label'     => Mage::helper('xticket')->__('Set New Status'),
//			'class'     => 'newstat',
//		    'onclick'   => 'newStatus(\''. $this->getUrl('*/*/setstat', array("id" => $this->getRequest()->getParam("id"))) .'\')',
//            'level'     => -1
//			), 100);


        
        $this->_formScripts[] = "
           
            
            function newStatus(url){
            	var newStatus= document.forms['edit_form'].new_status.value;
            	if (newStatus =='0'){
            		alert('". Mage::helper('xticket')->__('Please select a status'). "');
            	}else{
        			document.forms['edit_form'].action=url+'new_status/'+newStatus+'/';
            		document.forms['edit_form'].submit();
            	}
            }
            
            function transferReps(url){
            	var representative= document.forms['edit_form'].rep.value;
            	if (representative =='0'){
            		alert('". Mage::helper('xticket')->__('Please select a representative'). "');
            	}else{
        			document.forms['edit_form'].action=url+'reps/'+representative+'/';
            		document.forms['edit_form'].submit();
            	}
            }
            
            function transferCats(url){
            	var category= document.forms['edit_form'].cat.value;
            	var cats_message= document.forms['edit_form'].trans_msg.value;
            	var cat_alert= document.forms['edit_form'].cat_alert.value;
            	if (category =='0'){
            		alert('". Mage::helper('xticket')->__('Please select a department'). "');
            	}else{
        			document.forms['edit_form'].action=url+'cats/'+category+'/'+'message/'+ cats_message +'/cat_alert/'+cat_alert+'/';
            		document.forms['edit_form'].submit();
            	}
            }		
        ";
    }

    
	public function getId()
    {
        return (Mage::registry('xticket_data') && Mage::registry('xticket_data')->getId());
    }
    
    public function getHeaderText()
    {
        if( $this->getId() ) {
            return Mage::helper('xticket')->__("Edit Ticket '%s'", $this->htmlEscape(Mage::registry('xticket_data')->getCode()));
        } else {
            return Mage::helper('xticket')->__('New Ticket');
        }
    }
}