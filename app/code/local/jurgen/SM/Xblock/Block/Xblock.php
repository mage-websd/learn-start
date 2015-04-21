<?php

class SM_Xblock_Block_Xblock extends Mage_Core_Block_Template
{
	protected function _getCollection($position) {
		$blockId = Mage::getResourceModel('xblock/xblock')->getBlockId($position);
                $dataBlock = Mage::getResourceModel('xblock/xblock')->getDataById($blockId);
                $storeId = Mage::app()->getStore()->getId();
		//print"<pre>"; print_r($dataBlock); die;
                $collection = Mage::getModel('xblock/item')
			->getCollection()
			->addItemFilter($blockId)
                        ->addStoreFilter($storeId);
                if ($dataBlock['mode'] == 'show_random') {
                    return $collection->addRandom($blockId);
                } else {
                    return $collection;
                }
	}

	protected function _getCollectionCategory($position) {
		$blockId = Mage::getResourceModel('xblock/xblock')->getBlockCategoryId($position);
		return Mage::getModel('xblock/item')
			->getCollection()
			->addItemFilter($blockId);
	}

}
