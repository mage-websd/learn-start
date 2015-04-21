<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
class SM_Press_TagController extends Mage_Core_Controller_Front_Action
{
	public function viewAction()
	{
        $this->loadLayout();
        $tag = $this->getRequest()->getParams();
        if(isset($tag["tag"]) && $tag["tag"] != null) {
            $tag = $tag["tag"];
        }
        else {
            $tag = '';
        }
        /* set title */
        $title = $this->__('Press filter');
        if($tag) {
            $title .= ' by year '. $tag;
        }
        $this->getLayout()->getBlock('head')->setTitle($title);
        /* set breadcrumb */
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $nameBreadFilter = '';
            if($tag)
                $nameBreadFilter = " by year {$tag}";
            $breadcrumbs
                ->addCrumb('home', array(
                    'label' => $this->__('Home'),
                    'title' => $this->__('Go to Home Page'),
                    'link' => Mage::getBaseUrl()
                ))
                ->addCrumb('press', array(
                    'label' => $this->__('Press'),
                    'title' => $this->__('Press'),
                    'link' => Mage::getBaseUrl().Mage::helper('sm_press')->getNameCategoryPress(),
                ))
                ->addCrumb('filter', array(
                    'label' => $this->__('Filter '.$nameBreadFilter),
                    'title' => $this->__('Filter '.$nameBreadFilter),
                ));
        }

        $postTag = Mage::getModel('wordpress/post_tag')->load($tag, 'slug');
        $this->getLayout()->getBlock('press_tag_view')->setTag($postTag);
		$this->renderLayout();
	}
}
