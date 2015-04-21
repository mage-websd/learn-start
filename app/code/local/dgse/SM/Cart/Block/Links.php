<?php
/**
 * Created by PhpStorm.
 * User: SnguyenPC
 * Date: 01/12/2014
 * Time: 10:56
 */

class SM_Cart_Block_Links extends Mage_Checkout_Block_Links
{
    /**
     * Add shopping cart link to parent block
     *
     * @return Mage_Checkout_Block_Links
     */
    public function addCartLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $count = $this->getSummaryQty() ? $this->getSummaryQty()
                : $this->helper('checkout/cart')->getSummaryCount();
            if ($count == 1) {
                $text = $this->__('My Bag (%s item)', $count);
            } elseif ($count > 0) {
                $text = $this->__('My Bag (%s items)', $count);
            } else {
                $text = $this->__('My Bag');
            }
//DGSE-295
            $parentBlock->removeLinkByUrl($this->getUrl('checkout/cart'));
            $parentBlock->addLink($text, 'checkout/bag', $text, true, array(), 50, null, 'class="top-link-cart"');
        }
        return $this;
    }
} 