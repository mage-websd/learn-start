<?php
Mage::app()->setCurrentStore($result);

$cart = Mage::getSingleton('checkout/cart'); //->getItemsCount();

$ajtem=$_POST['item'];    // THIS IS THE ITEM ID
$items = $cart->getItems();
foreach ($items as $item) {   // LOOP
    if($item->getId()==$ajtem){  // IS THIS THE ITEM WE ARE CHANGING? IF IT IS:
        $item->setQty($_POST['qty']); // UPDATE ONLY THE QTY, NOTHING ELSE!
        $cart->save();  // SAVE
        Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
        break;
    }

}