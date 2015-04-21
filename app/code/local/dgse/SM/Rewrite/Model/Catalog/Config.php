<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DucThang
 * Date: 12/12/14
 * Time: 2:32 PM
 */
class SM_Rewrite_Model_Catalog_Config extends Mage_Catalog_Model_Config
{

    /**
     * Retrieve Attributes Used for Sort by as array
     * key = code, value = name
     *
     * @return array
     */
    public function getAttributeUsedForSortByArray()
    {
        $options = array();
        foreach ($this->getAttributesUsedForSortBy() as $attribute) {
            /* @var $attribute Mage_Eav_Model_Entity_Attribute_Abstract */
            $options[$attribute->getAttributeCode()] = $attribute->getStoreLabel();
        }
        $newOptions = array();
        if (isset($options['price'])) {
            $newOptions['price'] = $options['price'];
            unset($options['price']);
        }
        $newOptions['rating_summary'] = Mage::helper('catalog')->__('Rating');
        if (isset($options['name'])) {
            $newOptions['name'] = $options['name'];
            unset($options['name']);
        }

        return array_merge($newOptions, $options);
    }
}