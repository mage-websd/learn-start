<?php
class SM_AdminCustomerOverride_Block_Customercart extends Mage_Adminhtml_Block_Customer_Edit_Tab_Cart
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setId('customer_cart_grid' . $this->getWebsiteId()); // added code
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/carts', array('_current'=>true, 'website_id' => $this->getWebsiteId()));
    }
}