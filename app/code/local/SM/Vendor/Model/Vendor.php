<?php
class SM_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('sm_vendor/vendor');
        parent::_construct();
    }

    /**
     * addVendor: add new vendor
     * @param $name
     * @param $email
     * @param $phone
     * @param $paypal_account
     * @return $this
     */
    public function addVendor($name, $email, $phone, $paypal_account, $logo)
    {
        $this->setData('name',$name);
        $this->setData('email',$email);
        $this->setData('phone',$phone);
        $this->setData('paypal_account',$paypal_account);
        $this->setData('logo',$logo);
        $this->save();
        return $this;
    }
}