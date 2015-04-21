<?php
require_once(Mage::getModuleDir('controllers','FME_Manufacturers').DS.'Adminhtml/ManufacturersController.php');

class SM_Manufacturers_Adminhtml_ManufacturersController extends FME_Manufacturers_Adminhtml_ManufacturersController {

    public function saveAction() {

        if ($data = $this->getRequest()->getPost()) {

            //Upload Logo
            $files = $this->uploadFiles( $_FILES );
            if( $files && is_array($files) ){
                for( $f=0; $f<count($files); $f++ ){
                    if( $files[$f] ){
                        $fieldname = str_replace('_uploader','',$files[$f]['fieldname']);
                        if( array_key_exists($fieldname, $data) ){
                            $data['m_logo'] = str_replace('\\', '/', $files[$f]['url']);
                        }
                    }
                }
            }

            //Set Related Products
            $links = $this->getRequest()->getPost('links');
            if (isset($links['related'])) {
                $productIds = Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['related']);
                $productString = "";

                // declare position array
                $positionArray = array();

                foreach ($productIds as $_product) {
                    $productString .= $_product.",";

                    // get positions value
                    $positionArray[$_product] = $this->getRequest()->getPost('position_'. $_product);
                }
                $_POST['productIds'] = $productString;

                // post position
                $_POST['positions'] = json_encode($positionArray);
            }

            $model = Mage::getModel('manufacturers/manufacturers');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('manufacturers')->__('Manufacturer was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('manufacturers')->__('Unable to find Manufacturer to save'));
        $this->_redirect('*/*/');
    }

}