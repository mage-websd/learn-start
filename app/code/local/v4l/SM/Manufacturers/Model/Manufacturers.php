<?php
class SM_Manufacturers_Model_manufacturers extends FME_Manufacturers_Model_Manufacturers {

    public function updatePosition($productId, $value) {
        if ($productId > 0) {
            // get table name
            $resource = Mage::getSingleton('core/resource');
            $relatedTable = $resource->getTableName('manufacturers_products');

            // update value
            $write = Mage::getSingleton('core/resource')->getConnection('core_write');
            $query = 'UPDATE '. $relatedTable .' SET position = '. $value .' WHERE product_id = '. $productId;
            print $query . '<br>';
            $write->query($query);
        }
    }

}