<?php
require Mage::getModuleDir('controllers','Fishpig_Wordpress').'/PostController.php';
class SM_Wp_PostController extends Fishpig_Wordpress_PostController
{
    public function indexAction()
    {
        $this->_forward('noRoute');
    }

    /**
     * post view
     */
    public function viewAction()
    {
        $params = $this->getRequest()->getParams();
        if($params['typeItem'] == 'post') {
            $post = Mage::registry('wordpress_post');
            Mage::register('wordpress_category_educational',1);
            $postId = $this->getRequest()->getParam('idItem');
            $this->_rootTemplates[] = 'post_view';

            $this->_addCustomLayoutHandles(array(
                'wordpress_post_view',
                'wordpress_post_view_' . strtoupper($post->getPostType()),
                'wordpress_post_view_' . $post->getId(),
            ));

            $this->_initLayout();

            $this->_title(strip_tags($post->getPostTitle()));

            if ($headBlock = $this->getLayout()->getBlock('head')) {
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
            if($breadCrumb = $this->getLayout()->getBlock('breadcrumbs')) {

            }

            if ($post->hasParentCategory()) {
                $categories = array();
                $category = $post->getParentCategory();

                while($category) {
                    array_unshift($categories, $category);
                    $category = $category->getParentTerm();
                }

                foreach($categories as $category) {
                    $this->addCrumb('post_category_' . $category->getId(),
                        array(
                            'label' => $category->getName(),
                            'link' => Mage::helper('sm_wp')->getUrlCategoryFlag($category),
                            )
                    )   ;
                }
            }

            $this->addCrumb('post', array('label' => $post->getPostTitle()));
            $this->renderLayout();
            return;
        }
        $this->_forward('noRoute');
    }

    /**
     * custom of wordpress module
     *
     * @return bool|Mage_Core_Model_Abstract|mixed
     */
    protected function _initPost()
    {
        if (($post = Mage::registry('wordpress_post')) !== null) {
            return $post;
        }
        if($postId = $this->getRequest()->getParam('idItem')) {
            $post = Mage::getModel('wordpress/post')->load($postId);
            if ($post->getId() && $post->canBeViewed()) {
                Mage::register('wordpress_post', $post);
                return $post;
            }
        }
        return false;
    }

    protected function _initLayout()
    {
        if (!$this->_isLayoutLoaded) {
            $this->loadLayout();
        }
        $this->_title();
        $this->addCrumb('home', array('link' => Mage::getUrl(), 'label' => $this->__('Home')));
        if ($rootBlock = $this->getLayout()->getBlock('root')) {
            $rootBlock->addBodyClass('is-blog');
        }
        Mage::dispatchEvent('wordpress_init_layout_after', array('object' => $this->getEntityObject()));
        Mage::dispatchEvent($this->getFullActionName() . '_init_layout_after', array('object' => $this->getEntityObject()));
        return $this;
    }

    protected function _handlePostedComment()
    {
        $commentId = $this->getRequest()->getParam('comment');

        if ($commentId && $this->getRequest()->getActionName() === 'view') {
            $comment = Mage::getModel('wordpress/post_comment')->load($commentId);

            if ($comment->getId() && $comment->getPost()->getId() === $this->getEntityObject()->getId()) {
                if ($comment->isApproved()) {
                    $urlCurrent =  Mage::helper('core/url')->getCurrentUrl();
                    $urlRedirect = $urlCurrent;
                    if($pos = strpos($urlCurrent,'?')) {
                        $urlRedirect = substr($urlCurrent,0,60);
                    }
                    header('Location: ' . $urlRedirect);
                    exit;
                }
                else {
                    Mage::getSingleton('core/session')->addSuccess($this->__('Your comment is awaiting moderation.'));
                }
            }
        }
        return $this;
    }
}