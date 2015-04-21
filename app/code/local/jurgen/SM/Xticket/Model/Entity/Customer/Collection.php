<?php

class SM_Xticket_Model_Entity_Customer_Collection extends Mage_Customer_Model_Entity_Customer_Collection
{
    public function addEmailFillter($email)
    {
        $this->getSelect()
            ->where("email like '%".$email."%'");
		return $this;
    } 
}