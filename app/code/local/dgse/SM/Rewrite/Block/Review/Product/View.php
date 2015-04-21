<?php
/**
 * Created by PhpStorm.
 * User: tuanlv
 * Date: 11/21/14
 * Time: 2:55 PM
 */ 
class SM_Rewrite_Block_Review_Product_View extends Mage_Review_Block_Product_View {
    public function canEmailToFriend()
    {
        return true;
    }
}