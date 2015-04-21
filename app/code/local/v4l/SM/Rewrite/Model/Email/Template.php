<?php
class SM_Rewrite_Model_Email_Template extends Mage_Core_Model_Email_Template
{
    /**
     * rewrite email template
     *   -- not set queue email template
     *
     * @return int
     */
    public function hasQueue()
    {
        return 0;
    }
}