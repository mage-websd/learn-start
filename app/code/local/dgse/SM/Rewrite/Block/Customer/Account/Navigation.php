<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DucThang
 * Date: 1/16/15
 * Time: 2:53 PM
 */
class SM_Rewrite_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    public function removeLinkByName($name)
    {
        unset($this->_links[$name]);
        return $this;
    }
}