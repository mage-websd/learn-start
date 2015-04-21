<?php
/*
 * Add the store prefix for order
 * extends Mage_Eav_Model_Entity_Increment_Numeric
 * Dev: TueBm
 * Date: 24/06/2011
 */

class SM_XOrderNumber_Model_Numeric extends Mage_Eav_Model_Entity_Increment_Numeric
{
//    public function _construct()
//    {
//        parent::_construct();
//        $this->_init('xordernumber/numeric');
//    }
 
    /*public function getNextId()
    {
        $last = $this->getLastId();
        
        if (strpos($last, $this->getPrefix())===0) {
            $last = (int)substr($last, strlen($this->getPrefix()));
        } else {
            $last = (int)$last;
        }
        
        $next = $last+1;
        
        return $this->format($next);
    }*/
 
    public function getNextId()
    {
        $last = $this->getLastId();
		//echo $this->getPrefix().'--'.$this->getLastId(); //die;
        if($this->getPrefix() != 2){
			$last = (int)substr($last, strlen($this->getPrefix()) + 1); // for both orders start with 33xxxx and 3xxxxx
		} else {
			$last = (int)$last;
			//$last = (int)substr($last, strlen($this->getPrefix())+5);
		}
		
        //echo '-last:'.$last; //die;
        //$next = $last+1;
        //echo $this->formatNextId($next); die;
        $store_prefix = Mage::getStoreConfig('sm_xordernumber/general/store_prefix', $this->getPrefix());
		//return $this->formatNextId($next);
		if($last >= $store_prefix) {
			$next = $last+1;        
		} else {
			$next = $store_prefix+1;
		}
		//echo '-Prefix:'.$store_prefix.'-next:'.$next.'-format:'.$this->format($next); die;
		if($store_prefix == 3201600){
				return $next; 
		} else {
			$next = $last+1;
			//echo $this->formatNextId($next); die;		
			return $this->formatNextId($next);
			//return $this->format($next);
		}
		
    }
    
    public function formatNextId($id){
        $store_prefix = Mage::getStoreConfig('sm_xordernumber/general/store_prefix', $this->getPrefix());
		$next = $id + $store_prefix;

        return $next;
    }
}
?>
