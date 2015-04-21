<?php

class SM_Invoice_Model_Sales_Order_Invoice extends Mage_Sales_Model_Order_Invoice {

    /**
     * Before object save manipulations
     *
     * @return Mage_Sales_Model_Order_Shipment
     */
    protected function _beforeSave()
    {
        Mage_Sales_Model_Abstract::_beforeSave();

        if (!$this->getOrderId() && $this->getOrder()) {
            $this->setOrderId($this->getOrder()->getId());
            $this->setBillingAddressId($this->getOrder()->getBillingAddress()->getId());
        }

        /**
         * Get the resource model
         */
        $resource = Mage::getSingleton('core/resource');

        /**
         * Retrieve the read connection
         */
        $readConnection = $resource->getConnection('core_read');

        $query = 'SELECT increment_id FROM ' . $resource->getTableName('sales/invoice') .' ORDER BY increment_id DESC limit 1';

        /**
         * Execute the query and store the results in $results
         */
        $results = (int)($readConnection->fetchOne($query))+1;
        $this->setIncrementId($results);
        return $this;
    }

}