<?php
require Mage::getModuleDir('controllers','Fishpig_Wordpress').'/Post/CategoryController.php';
class SM_Wp_CategoryController extends Fishpig_Wordpress_Post_CategoryController
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
        if($params['typeItem'] == 'category') {
            $category = Mage::registry('wordpress_category');
                Mage::register('wordpress_category_educational',1);
            $this->_addCustomLayoutHandles(array(
                'wordpress_post_category_view',
                'wordpress_category_'.$category->getId(),
                'wordpress_post_list',
                'wordpress_term',
            ));

            $this->_initLayout();

            $this->_rootTemplates[] = 'post_list';

            $tree = array($category);
            $buffer = $category;

            while(($buffer = $buffer->getParentCategory()) !== false) {
                array_unshift($tree, $buffer);
            }

            while(($branch = array_shift($tree)) !== null) {
                $this->addCrumb('category_' . $branch->getId(), array(
                        'link' => ($tree ? Mage::helper('sm_wp')->getUrlCategoryConvertFlag($branch->getUrl()) : null),
                        'label' => $branch->getName())
                );

                $this->_title($branch->getName());
            }

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
    protected function _initPostCategory()
    {
        if (($category = Mage::registry('wordpress_category')) !== null) {
            return $category;
        }
        $category = Mage::getModel('wordpress/post_category')->load($this->getRequest()->getParam('idItem'));
        if ($category->getId()) {
            Mage::register('wordpress_category', $category);
            return $category;
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
}