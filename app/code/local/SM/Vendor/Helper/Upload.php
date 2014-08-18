<?php
class SM_Vendor_Helper_Upload extends Mage_Core_Helper_Abstract
{
    /**
     * upload image
     *
     * @param $fileInputName: input name
     * @param $path: path to save image upload
     * @param $newNameFile: new file name upload
     *
     * @return string: new file name upload
     */
    public  function uploadImage($fileInputName,$path,$newNameFile)
    {
        if(isset($_FILES[$fileInputName]['name']) and (file_exists($_FILES[$fileInputName]['tmp_name']))) {
            try {
                $uploader = new Varien_File_Uploader($fileInputName);
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything

                $uploader->setAllowRenameFiles(true);

                $uploader->setFilesDispersion(false);

                $uploader->save($path, $newNameFile . '.'.$uploader->getFileExtension());
                return $uploader->getUploadedFileName();

            }catch(Exception $e) {

            }
        }
        return 'default_vendor.png';
    }
}