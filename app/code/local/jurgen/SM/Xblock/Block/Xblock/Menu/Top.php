<?php
class SM_Xblock_Block_Xblock_Menu_Top extends SM_Xblock_Block_Xblock
{
	public function getCollection() {
		return $this->_getCollection('menu-top');
	}
}