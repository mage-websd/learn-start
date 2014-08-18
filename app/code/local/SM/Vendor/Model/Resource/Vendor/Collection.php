<?php
class SM_Vendor_Model_Resource_Vendor_Collection extends
    Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('sm_vendor/vendor');
        parent::_construct();
    }

    /**
     * getList: get Data All record
     * @return array
     */
    public function getList()
    {
        return $this->getData();
    }

    /**
     * existsEmail: check email vendor exists
     *
     * @param $email
     * @return bool
     */
    public function existsEmail($email)
    {
        $result = $this->getVendorFromEmail($email);
        if(count($result) > 0)
            return true;
        return false;
    }

    /**
     * getVendorFromEmail: get vendor from email
     * @param $email
     * @return mixed
     */
    public function getVendorFromEmail($email)
    {
        return $this->addFieldToFilter('email',array('eq'=>$email))->getFirstItem()->getData();
    }

    /**
     * getAllEmail: get all email vendor
     * @return array
     */
    public function getAllEmail()
    {
        return $this->addFieldToSelect('email')->getData();
    }
}