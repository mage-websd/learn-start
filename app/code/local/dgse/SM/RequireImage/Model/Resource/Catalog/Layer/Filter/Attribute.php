<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 2/3/15
 * Time: 10:48 AM
 */ 
class SM_RequireImage_Model_Resource_Catalog_Layer_Filter_Attribute extends Mage_Catalog_Model_Resource_Layer_Filter_Attribute {
    public function getCount($filter)
    {
        // clone select from collection with filters
        $imageFilter = array(
        array(
            'attribute' => 'image',
            'neq'       => 'no_selection',
        ),
        array(
            'attribute' => 'require_img',
            'eq'       => '1',
        ),
    );
        $select = clone $filter
            ->getLayer()
            ->getProductCollection()
            ->addAttributeToFilter($imageFilter)
            ->addAttributeToFilter(array(
                array(
                    'attribute' => 'price',
                    'gt'       => 0,
                )
            ))
            ->getSelect();

        // reset columns, order and limitation conditions
        $select->reset(Zend_Db_Select::COLUMNS);
        $select->reset(Zend_Db_Select::ORDER);
        $select->reset(Zend_Db_Select::LIMIT_COUNT);
        $select->reset(Zend_Db_Select::LIMIT_OFFSET);

        $connection = $this->_getReadAdapter();
        $attribute  = $filter->getAttributeModel();
        $tableAlias = sprintf('%s_idx', $attribute->getAttributeCode());
        $conditions = array(
            "{$tableAlias}.entity_id = e.entity_id",
            $connection->quoteInto("{$tableAlias}.attribute_id = ?", $attribute->getAttributeId()),
            $connection->quoteInto("{$tableAlias}.store_id = ?", $filter->getStoreId()),
        );

        $select
            ->join(
                array($tableAlias => $this->getMainTable()),
                join(' AND ', $conditions),
                array('value', 'count' => new Zend_Db_Expr("COUNT({$tableAlias}.entity_id)")))
            ->group("{$tableAlias}.value");

        return $connection->fetchPairs($select);
    }
}