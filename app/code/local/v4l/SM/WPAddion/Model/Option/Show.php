<?php
class SM_WPAddion_Model_Option_Show
{
    public function toOptionArray()
    {
        return array(
            array('label'=>'Category Level 1','value'=>'category_level_1'),
            array('label'=>'All Category','value'=>'category_all'),
        );

    }
}