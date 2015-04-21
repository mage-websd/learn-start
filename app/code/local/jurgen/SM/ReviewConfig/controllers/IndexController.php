<?php
/**
 * Created by PhpStorm.
 * User: BuiManhHa
 * Date: 9/15/14
 * Time: 10:01 AM
 * show reviews on new store Proteinedieet (same locale nl_NL with old stores)
 * condition : products exist on new store and stores nl_NL
 */
class SM_ReviewConfig_IndexController extends Mage_Core_Controller_Front_Action
{
    // show reviews on new store Proteinedieet
    public function indexAction()
    {
        // list id of old Dutch stores
        $idOldStores = Mage::getModel('core/store')->getCollection()
                       ->addFieldToSelect('store_id')
                       ->addFieldToFilter('code',array('in'=>array('default','proteinedieet_nl','pro10_view')))
                       ->getColumnValues('store_id');
        // id new store Proteinedieet
        $idNewStore = Mage::getModel('core/store')->load('proteinedieet')->getStoreId();

        // add reviews for new store Proteinedieet
        $reviews = Mage::getModel('review/review')->getCollection(); // list all reviews
        if(count($reviews) > 0)
        {
            foreach($reviews as $item)
            {
                $item = Mage::getModel('review/review')->load($item->getData('review_id'));
                // get product id of this review
                $idProductOfReview = $item->getEntityPkValue();
                // get list store have this product
                $idStoresOfProduct = Mage::getModel('catalog/product')
                                     ->load($idProductOfReview)
                                     ->getStoreIds();

                if(in_array($idNewStore, $idStoresOfProduct))
                {
                    // product exists on old stores (locale is nl_NL) and new store Proteinedieet
                    $idVisibleStores = $item->getStores();
                    $checkStore = array_intersect($idOldStores, $idVisibleStores);
                    if(count($checkStore) > 0)
                    {
                        // update store visible of this review for new store Proteinedieet
                        array_push($idVisibleStores, $idNewStore);
                        $item->setStores($idVisibleStores)
                             ->save();
                        $item->aggregate();
                    }
                }
            }
            echo "Success: added product reviews for new store"."<br/>Please, check again in admin page";
        }
    }

    // revert reviews (in case error)
    public function deleteAction()
    {
        // id new store Proteinedieet
        $idstoreProteinedieet = Mage::getModel('core/store')->load("proteinedieet")->getStoreId();
        $reviews = Mage::getModel('review/review')->getCollection(); // list all reviews in all store
        if(count($reviews) > 0)
        {
            foreach ($reviews as $item)
            {
                $item = $item->load();
                $idVisibleStores = $item->getStores();
                if (in_array($idstoreProteinedieet, $idVisibleStores))
                {
                    $key = array_search($idstoreProteinedieet, $idVisibleStores);
                    unset($idVisibleStores[$key]);
                    $item->setStores($idVisibleStores)
                         ->save();
                }
            }
            echo "Reverted product reviews";
        }
    }
}