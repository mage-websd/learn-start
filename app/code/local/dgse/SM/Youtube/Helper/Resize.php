<?php

class SM_Youtube_Helper_Resize extends Mage_Core_Helper_Abstract
{
   /**
    * Hàm thực hiện resize image for module
    * param: string : là đường dẫn tới thư mục file trong thư mục media
    * param: string : là độ weight cần resize
    * param: string : là độ height cần resize
    *
    * Return : string is path tới thư mục resized chứa image đã resize
    */
    public function resizeImg($fileName, $width, $height = '')
    {
        $folderURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $imageURL  = $folderURL . $fileName;
        // Path là đường dẫn tới thư mục chứa ảnh image cũ
        $basePath  = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/' . $fileName;
        // Path là đường dẫn tới thư mục chứa ảnh image resized
        $newPath   = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/' . "resized" . '/' . $fileName;
        // If width empty then return original size image's URL
        if ($width != '')
        {
            // If image has already resized then just return URL
            if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath))
            {
                $imageObj = new Varien_Image($basePath);
                $imageObj->constrainOnly(TRUE);
                $imageObj->keepAspectRatio(FALSE);
                $imageObj->keepFrame(FALSE);
                $imageObj->resize($width, $height);
                $imageObj->save($newPath);
            }
            $resizeURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "resized/" . $fileName;
        } else {
            $resizeURL = $imageURL;
        }

        return $resizeURL;
    }
}