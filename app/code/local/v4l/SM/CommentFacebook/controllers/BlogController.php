<?php
class SM_CommentFacebook_BlogController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($id) {
            $post = Mage::getModel('wordpress/post')->load($id);
            if($post->getData('ID')) {
                $url = $post->getUrl();
                $this->_redirectUrl($url);
            }
            else {
                return $this->_redirect('/');

            }
        }
        else {
            return $this->_redirect('/');
        }
    }
}