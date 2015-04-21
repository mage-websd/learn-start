<?php

/**
 * Class SM_CatalogSearch_Block_Result
 *
 * override class Mage_CatalogSearch_Block_Result to change breadcrumbs
 */
class SM_CatalogSearch_Block_Result extends Mage_CatalogSearch_Block_Result
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        // add Home breadcrumb
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb('search', array(
                'label' => 'Search',
                'title' => 'Search'
            ));
        }
    }
}