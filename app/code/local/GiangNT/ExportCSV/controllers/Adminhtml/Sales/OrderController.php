<?php
require_once Mage::getModuleDir('controllers','Mage_Adminhtml').'/Sales/OrderController.php';

class GiangNT_ExportCSV_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{

    /**
     * Export order grid to CSVi format
     */
    public function exportCsvEnhancedAction()
    {
        $fileName = 'orders-' . gmdate('YmdHis') . '.csv';
        $grid = $this->getLayout()->createBlock('adminhtml/sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFileEnhanced());
    }


}