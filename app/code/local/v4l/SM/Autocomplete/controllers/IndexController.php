<?php
class SM_Autocomplete_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        $keyword = $this->getRequest()->getParam('term');
        $blogs = Mage::helper('sm_autocomplete')->getPostCollection($keyword);

        if(count($blogs) > 0) {
            foreach($blogs as $blog) {
               $title = $blog->getPostTitle();
               $url = $blog->getUrl();
               $array[] = array('blog_url' => $url, 'blog_title' => $title);
            }
        } else {
             $array[] = array('blog_url' => '#', 'blog_title' => 'No results');
        }
        $resultJson = Mage::helper('core')->jsonEncode($array);
        $this->getResponse()->setHttpResponseCode(200);
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody($resultJson);
    }
}