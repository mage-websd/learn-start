<?php

class SM_Xmaincategory_Block_Adminhtml_Xmaincategory_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('xmaincategory_form', array('legend'=>Mage::helper('xmaincategory')->__('Main Category information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('xmaincategory')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
/*
      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('xmaincategory')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));*/
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('xmaincategory')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('xmaincategory')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('xmaincategory')->__('Disabled'),
              ),
          ),
      ));
   /*  
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('xmaincategory')->__('Content'),
          'title'     => Mage::helper('xmaincategory')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     */
      
    /**
     * Add Multiselect for main category
     * By Tung TH
     * SmartOSC Begin 
     */
      //TODO: Complex between store ID.
     $subCategories = array();    
     $main_collection = Mage::getModel('xmaincategory/xmaincategory')->getCollection()
                            ->addFieldToFilter('store_id',Mage::getSingleton('core/session')->getXStoreID());
     $myStrings = $main_collection->getColumnValues('sub_id');
     $arrSubIds[] = array();
     
     if(Mage::registry('xmaincategory_data'))
          $xmainCateData = Mage::registry('xmaincategory_data');
     
     $mySubId = Mage::getModel('xmaincategory/xmaincategory')->load($xmainCateData->getData('xmaincategory_id'))
              ->getData('sub_id');
     
     for($i=0;$i<count($myStrings);$i++){
         if($mySubId !=  $myStrings[$i]){
            $arrSubIds[$i] = explode('[,]', $myStrings[$i]);
        }}
        
     $categories = Mage::getModel('catalog/category')->getCollection()
             ->addAttributeToSelect('*')
             ->addAttributeToFilter('level',2)
             ->addAttributeToFilter('parent_id',2);
     

		foreach ($categories as $category) {
                    $checkSetData = true;
                    foreach($arrSubIds as $arrSubId){
                        foreach ($arrSubId as $arr) { 
                            if($category->getId() == (int)trim($arr)){
                                $checkSetData = false;
                                break;
                            }     
                        }
                    }
                    if($checkSetData)
                    {
                        $cate = array('label' => $category->getName(), 'value' => $category->getId());
                        $subCategories[] = $cate;
                    }
		}
      
      $fieldset->addField('sub_id', 'multiselect', array(
          'label'     => Mage::helper('xmaincategory')->__('Sub Categories'),
          'name'      => 'sub_id[]',
          'values'    => $subCategories,
              ));
       
//      if(Mage::getSingleton('adminhtml/session')->getXMainCategoryData())
//          $xmainCateData = Mage::getSingleton('adminhtml/session')->getXMainCategoryData();
      
      $myString = Mage::getModel('xmaincategory/xmaincategory')->load($xmainCateData->getData('xmaincategory_id'))
              ->getData('sub_id');
            
      $arrSubId = array();
      $arrSubId = explode(',', $myString);
      $xmainCateData->setSubId($arrSubId);
      
      /**
       * SmartOSC End
       */
      
//      if ( Mage::getSingleton('adminhtml/session')->getXMainCategoryData() )
//      {
//          $form->setValues(Mage::getSingleton('adminhtml/session')->getXMainCategoryData());
//          Mage::getSingleton('adminhtml/session')->setXMainCategoryData(null);
//      } elseif ( Mage::registry('xmaincategory_data') ) {
//          $form->setValues(Mage::registry('xmaincategory_data')->getData());
//      }
      //Mage::log($xmainCateData->getData('sub_id'));
      $form->setValues($xmainCateData->getData());
      
      return parent::_prepareForm();
  }
}