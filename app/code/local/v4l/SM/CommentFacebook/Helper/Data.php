<?php
/**
 * SM_CommentFacebook_Helper_Data
 */
class SM_CommentFacebook_Helper_Data extends Mage_Core_Helper_Abstract {
    public function enable()
    {
        if(Mage::getStoreConfig('wordpress/fcomment/enabled') &&
            !Mage::getStoreConfig('advanced/modules_disable_output/SM_CommentFacebook')) {
            return true;
        }
        return false;
    }
    public function getAppId()
    {
        return Mage::getStoreConfig('facebookapp/faceconnect/facebook_app_id');
    }
    public function getColor()
    {
        return Mage::getStoreConfig('wordpress/fcomment/colorscheme');
    }
    public function getWidth()
    {
        /*$width = Mage::getStoreConfig('wordpress/fcomment/width');
        if($width && is_numeric($width) && $width > 0) {
            return $width;
        }*/
        return '';
    }
    public function getNumber()
    {
        $number = Mage::getStoreConfig('wordpress/fcomment/num_posts');
        if($number && (is_int($number) || ctype_digit($number)) && $number > 0) {
            return $number;
        }
        return 10;
    }
    public function getOrder()
    {
        return Mage::getStoreConfig('wordpress/fcomment/order_by');
    }

    public function getHtml($url)
    {
        $number = $this->getNumber();
        $order = $this->getOrder();
        $width = $this->getWidth();
        $color = $this->getColor();
        $html = <<<EOD
            <div class="fb-comments"
                data-href="$url"
                data-numposts="$number"
                data-colorscheme="$color"
                data-width="$width"
                data-order-by="$order"
            >
            </div>
EOD;
        return $html;
    }
    public function getUrlCmt()
    {
        return 'fb-cmt/blog/view/id/';
    }
}
