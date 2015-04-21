<?php
class SM_Xblock_Block_Xblock_Content_Top extends SM_Xblock_Block_Xblock
{
	public function getCollection() {
		return $this->_getCollection('content-top');
	}
}