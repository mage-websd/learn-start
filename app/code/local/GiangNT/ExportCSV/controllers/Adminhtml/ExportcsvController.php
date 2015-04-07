<?php
class GiangNT_ExportCSV_Adminhtml_ExportcsvController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function postAction()
    {
        $params = $this->getRequest()->getParams();
        $path = Mage::getBaseDir('var') . DS . 'export' . DS;
        $fileName = 'orders-' . $params['from_date'] . '__' . $params['to_date'] . '.csv';
        $file = $path . $fileName;
        $collection = Mage::getResourceModel('catalog/category_collection');
        $content = Mage::helper('giangnt_exportcsv/export')->generateMlnList($collection,$file,$path);
        $this->_prepareDownloadResponse($fileName, $content);
    }
}