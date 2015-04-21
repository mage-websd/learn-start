<?php
/**
 * Created by PhpStorm.
 * User: Hà
 * Date: 24/12/2014
 * Time: 11:04 PM
 */

class SM_CustomProductQuestion2_Block_CountQuestion extends AW_Pquestion2_Block_Question_List
{
    public function getQuestionsPage()
    {
        $questionPageUrl = Mage::getBaseUrl();
        return $questionPageUrl.'pquestion2/add/index/product_id/'.Mage::registry('current_product')->getId();
    }
} 