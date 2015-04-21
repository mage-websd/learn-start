<?php

class SM_Sticker_Model_Product extends Mage_Catalog_Model_Product
{
	public function isNew($date=null)
    {
        if($date==null) {
            $date = $this->getResource()->formatDate(time());
        }
        
        if(!$this->getData('news_from_date')) {
            return false;
        }
        
        $current_date = new DateTime($date); // compare date
        $from_date = new DateTime($this->getData('news_from_date')); // begin date
        $to_date = new DateTime($this->getData('news_to_date')); // end date
        
        $return = ($current_date >= $from_date && $current_date <= $to_date);
        
        return $return;
    } 	
	
	public function isSpecial($date=null)
    {
        if($date==null) {
            $date = $this->getResource()->formatDate(time());
        }
        
//        if(!$this->getData('special_from_date')) {
//            return false;
//        }
        if(!$this->getData('special_price')) {
            return false;
        }

        $current_date = new DateTime($date); // compare date
        $from_date = new DateTime($this->getData('special_from_date')); // begin date
        $to_date = new DateTime($this->getData('special_to_date')); // end date
        
        $return = ($current_date >= $from_date && $current_date <= $to_date);        
        return $return;
    } 
	
}
