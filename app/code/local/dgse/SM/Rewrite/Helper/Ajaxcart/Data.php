<?php
/**
 * Created by PhpStorm.
 * User: Ms Trang
 * Date: 1/21/15
 * Time: 6:41 PM
 */ 
class SM_Rewrite_Helper_Ajaxcart_Data extends Sns_Ajaxcart_Helper_Data {
    public function renderWishlist(){
        $wishlist = Mage::getModel('wishlist/wishlist')
            ->loadByCustomer(Mage::getSingleton('customer/session')->getCustomer(), true);
        if(Mage::registry('wishlist')){
            Mage::unregister('wishlist');
        }
        Mage::register('wishlist', $wishlist);
        $block=Mage::getSingleton('core/layout');

        if(version_compare(Mage::getVersion(),'1.7.0.0','>')){
            $items = $block    ->createBlock('wishlist/customer_wishlist_items','items')
                ->setTemplate('wishlist/item/list.phtml');
            $item_image = $block->createBlock('wishlist/customer_wishlist_item_column_image')
                ->setTemplate('wishlist/item/column/image.phtml');
            $item_info = $block->createBlock('wishlist/customer_wishlist_item_column_comment')
                ->setTemplate('wishlist/item/column/info.phtml')
                ->setTitle(Mage::helper('ajaxcart')->__('Product Details and Comment'));
            $item_cart = $block    ->createBlock('wishlist/customer_wishlist_item_column_cart')
                ->setTemplate('wishlist/item/column/cart.phtml')
                ->setTitle(Mage::helper('ajaxcart')->__('Add to Cart'));
            $item_options = $block->createBlock('wishlist/customer_wishlist_item_options', 'customer.wishlist.item.options');
            $item_cart->append($item_options);
            $item_remove = $block->createBlock('wishlist/customer_wishlist_item_column_remove')
                ->setTemplate('wishlist/item/column/remove.phtml');
            $items->append($item_image)
                ->append($item_info)
                ->append($item_cart)
                ->append($item_remove);
            $buttons = $block->createBlock('core/text_list','control_buttons')
                ->setTemplate('wishlist/item/list.phtml');
            $btn_share = $block->createBlock('wishlist/customer_wishlist_button')
                ->setTemplate('wishlist/button/share.phtml');
            $btn_tocart = $block->createBlock('wishlist/customer_wishlist_button')
                ->setTemplate('wishlist/button/tocart.phtml');
            $btn_update = $block->createBlock('wishlist/customer_wishlist_button')
                ->setTemplate('wishlist/button/update.phtml');
            $buttons->append($btn_share)
                ->append($btn_tocart)
                ->append($btn_update);
            $wishlist =    $block->createBlock('wishlist/customer_wishlist')
                ->setTemplate('wishlist/view.phtml')
                ->append($items)
                ->append($buttons)
                ->setTitle(Mage::helper('ajaxcart')->__('My Wish List'));
        }else{
            $wishitem= $block->createBlock('"wishlist/customer_wishlist_item_options','item_options');
            $wishlist=    $block->createBlock('wishlist/customer_wishlist')
                ->setTemplate('wishlist/view.phtml')
                ->append($wishitem);
        }
        return $wishlist->renderView();
    }

    public function renderCartTitle(){
        $count = Mage::helper('checkout/cart')->getSummaryCount();
        if( $count == 1 ) {
            $text = Mage::helper('ajaxcart')->__('My Bag (%s item)', $count);
        } elseif( $count > 0 ) {
            $text = Mage::helper('ajaxcart')->__('My Bag (%s items)', $count);
        } else {
            $text = Mage::helper('ajaxcart')->__('My Bag');
        }
        return $text;
    }

    public function renderWishlistTitle(){
        $count = Mage::helper('wishlist')->getItemCount();
        if( $count == 1 ) {
            $text = Mage::helper('ajaxcart')->__('My Wish List (%s item)', $count);
        } elseif( $count > 0 ) {
            $text = Mage::helper('ajaxcart')->__('My Wish List (%s items)', $count);
        } else {
            $text = Mage::helper('ajaxcart')->__('My Wish List');
        }
        return $text;
    }
}