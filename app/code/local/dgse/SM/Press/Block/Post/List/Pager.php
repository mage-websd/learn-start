<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class SM_Press_Block_Post_List_Pager extends Mage_Page_Block_Html_Pager
{
	/**
	 * Construct the pager and set the limits
	 *
	 */
	protected function _construct()
	{
		parent::_construct();	

		$this->setPageVarName('page');

		$baseLimit = $this->helper('wordpress')->getWpOption('posts_per_page', 10);

		$this->setDefaultLimit($baseLimit);
		$this->setLimit($baseLimit);
		
		$this->setAvailableLimit(array(
			$baseLimit => $baseLimit,
		));
		
		$this->setFrameLength(5);
	}
}
