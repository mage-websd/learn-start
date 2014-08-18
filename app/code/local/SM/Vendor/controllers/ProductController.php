<?php
class SM_Vendor_ProductController extends Mage_Core_Controller_Front_Action
{
    private $_vendor;

    /**
     * check loggedin
     *
     * @return Mage_Core_Controller_Front_Action|void
     */
    public function preDispatch()
    {
        parent::preDispatch();
        $session = Mage::getSingleton('customer/session');
        if(!$session->isLoggedIn()) {
            $this->_redirect('customer/account');
            return;
        }
        $customer = Mage::getModel('customer/customer')->load($session->getData('id'));
        if($customer->getData('customer_type')!='vendor') {
            $this->_redirect('customer/account');
            return;
        }
        $this->_vendor = $customer;
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function addAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function addPostAction()
    {
        if($this->getRequest()->isPost()) {
            $parmas = $this->getRequest()->getParams();

            $product = $this->setDefaultValueProduct();
            //215
            $product->setData('name',$parmas['name']);
            $product->setData('price',$parmas['price']);
            $product->setData('description',$parmas['description']);
            $product->setData('of_vendor',$this->_vendor->getData('entity_id'));

            $path = Mage::getBaseDir('media') .'/sm/vendor/images/products';
            $image = Mage::helper('sm_vendor/upload')->uploadImage('image',$path,$parmas['name']);
            $image = 'media/sm/vendor/images/products/'.$image;

            $product->setData('image',$image);

            $product->save();
            $this->_redirect('vendor/product/add');
        }
        $this->_redirect('vendor/product/add');
    }

    /**
     * set dafault value for product
     *
     * @return false|Mage_Core_Model_Abstract
     */
    private  function setDefaultValueProduct()
    {
        $product = Mage::getModel('catalog/product');
        $product
        ->setWebsiteIds(array(1)) //website ID the product is assigned to, as an array
        ->setStoreId(1)
        ->setAttributeSetId(4) //ID of a attribute set named 'default'
        ->setTypeId('simple') //product type
        ->setCreatedAt(strtotime('now')) //product creation time
//    ->setUpdatedAt(strtotime('now')) //product update time
        ->setSku(time()) //SKU
        //->setName('test product21') //product name
        ->setWeight(4.0000)
        ->setStatus(1) //product status (1 - enabled, 2 - disabled)
        ->setTaxClassId(0) //tax class (0 - none, 1 - default, 2 - taxable, 4 - shipping)
        ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH) //catalog and search visibility
        ->setManufacturer(28) //manufacturer id
        //->setColor(24)
        ->setNewsFromDate('06/26/2014') //product set as new from
        ->setNewsToDate('06/30/2014') //product set as new to
        ->setCountryOfManufacture('AF') //country of manufacture (2-letter country code)
        //->setPrice(11.22) //price in form 11.22
        ->setCost(22.33) //price in form 11.22
        ->setSpecialPrice(00.44) //special price in form 11.22
        ->setSpecialFromDate('06/1/2014') //special price from (MM-DD-YYYY)
        ->setSpecialToDate('06/30/2014') //special price to (MM-DD-YYYY)
        ->setMsrpEnabled(1) //enable MAP
        ->setMsrpDisplayActualPriceType(1) //display actual price (1 - on gesture, 2 - in cart, 3 - before order confirmation, 4 - use config)
        ->setMsrp(99.99) //Manufacturer's Suggested Retail Price
        ->setMetaTitle('test meta title 2')
        ->setMetaKeyword('test meta keyword 2')
        ->setMetaDescription('test meta description 2')
        ->setDescription('This is a long description')
        ->setShortDescription('This is a short description')
        ->setMediaGallery (array('images'=>array (), 'values'=>array ())) //media gallery initialization
        //->addImageToMediaGallery('media/catalog/product/1/0/10243-1.png', array('image','thumbnail','small_image'), false, false) //assigning image, thumb and small image to media gallery
        ->setStockData(array(
                'use_config_manage_stock' => 0, //'Use config settings' checkbox
                'manage_stock'=>1, //manage stock
                'min_sale_qty'=>1, //Minimum Qty Allowed in Shopping Cart
                'max_sale_qty'=>2, //Maximum Qty Allowed in Shopping Cart
                'is_in_stock' => 1, //Stock Availability
                'qty' => 999 //qty
            )
        );
        //->setCategoryIds(array(4)); //assign product to categories
        return $product;
    }
}