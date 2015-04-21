<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
require_once 'Fishpig/Wordpress/controllers/PostController.php';
class SM_Rewrite_Wordpress_PostController extends Fishpig_Wordpress_PostController
{
	public function viewAction()
	{
		$post = Mage::registry('wordpress_post');

		$this->_rootTemplates[] = 'post_view';

		$this->_addCustomLayoutHandles(array(
			'wordpress_post_view',
			'wordpress_post_view_' . strtoupper($post->getPostType()),
			'wordpress_post_view_' . $post->getId(),
		));

		$this->_initLayout();

		$this->_title(strip_tags($post->getPostTitle()));

		if (($headBlock = $this->getLayout()->getBlock('head')) !== false) {
			$feedTitle = sprintf('%s %s %s Comments Feed', Mage::helper('wordpress')->getWpOption('blogname'), '&raquo;', $post->getPostTitle());

			$headBlock->addItem('link_rel',
				$post->getCommentFeedUrl(),
				'rel="alternate" type="application/rss+xml" title="' . $feedTitle . '"'
			);

			$headBlock->setDescription($post->getMetaDescription());

			$canPing = Mage::helper('wordpress')->getWpOption('default_ping_status') === 'open';

			if ($canPing && $post->getPingStatus() == 'open') {
				$headBlock->addItem('link_rel', Mage::helper('wordpress')->getBaseUrl() . 'xmlrpc.php', 'rel="pingback"');
			}
		}

		if ($post->hasParentCategory()) {
			$categories = array();
			$category = $post->getParentCategory();
            if($category->getSlug() == 'press') {
                $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml')->unsetChild('breadcrumbs');
            }
			while($category) {
				array_unshift($categories, $category);
				$category = $category->getParentTerm();
			}

			foreach($categories as $category) {
				$this->addCrumb('post_category_' . $category->getId(), array('label' => $category->getName(), 'link' => $category->getUrl()));
			}
		}

		$this->addCrumb('post', array('label' => $post->getPostTitle()));

		$this->renderLayout();
	}
}
