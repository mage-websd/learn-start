<?php

/**
 * Class SM_Sell_IndexController
 */
class SM_Sell_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * @return Mage_Core_Controller_Varien_Action
     *
     * exec post sell form
     */
    public function postAction()
    {
        if ($this->getRequest()->isPost()) {
            $params = $this->getRequest()->getParams();
            if ($params['email'] && $params['name']) {
                $templateTransaction = Mage::getModel('core/email_template')
                    ->getCollection()
                    ->addFieldToSelect('template_id')
                    ->addFieldToFilter('template_code', 'Sell email template')
                    ->getFirstItem(); //get template email
                if ($templateTransaction->getTemplateId()) {
                    $templateId = $templateTransaction->getTemplateId();
                    $mailTo = Mage::getStoreConfig('trans_email/ident_custom1/email');
                    $nameTo = Mage::getStoreConfig('trans_email/ident_custom1/name');
                    $sender = array(
                        'name' => $params['name'],
                        'email' => $mailTo,
                    );
                    $storeId = Mage::app()->getStore()->getId();

                    // Set variables that can be used in email template sell
                    $vars = array(
                        'email_sell' => $params['email'],
                        'name_sell' => $params['name'],
                        'message_sell' => $params['message'],
                        'phone_sell' => $params['phone'],
                    );
                    $translate = Mage::getSingleton('core/translate'); //translate template email
                    $mailTransactional = Mage::getModel('core/email_template');
                    //image attachment
                    if (isset($_FILES['img'])) {
                        //MAX file size
                        if (($_FILES['img']['error'] == 1 || $_FILES['img']['error'] == 2)) {
                            Mage::getSingleton('core/session')->addError($this->__('File size must less than 2MB, please again!'));
                            return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
                        }
                        //error upload file
                        if ($_FILES['img']['name'] && $_FILES['img']['error'] !== 0) {
                            Mage::getSingleton('core/session')->addError($this->__('Error upload file, please again!'));
                            return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
                        }
                        //upload img success
                        if (file_exists($_FILES['img']['tmp_name'])) {
                            $fileInfo = $_FILES['img'];
                            $allowFile = array('image/jpeg', 'image/png', 'image/gif');
                            if (($fileInfo['size'] / 1e6) > 2) {
                                Mage::getSingleton('core/session')->addNotice($this->__('File size must less than 2MB, please again!'));
                                return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
                            } else if (!in_array($fileInfo['type'], $allowFile)) {
                                Mage::getSingleton('core/session')->addNotice($this->__('Only allow image type: png, jpeg, gif, please again!'));
                                return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
                            }

                            $at = $mailTransactional->getMail()
                                ->createAttachment(file_get_contents($fileInfo['tmp_name']));
                            $at->type = $fileInfo['type'];
                            $at->disposition = Zend_Mime::DISPOSITION_INLINE;
                            $at->encoding = Zend_Mime::ENCODING_BASE64;
                            $at->filename = $fileInfo['name'];
                        }
                    }
                    try {
                        $mailTransactional  //send email to admin sell
                            ->sendTransactional($templateId, $sender, $mailTo, $nameTo, $vars, $storeId);
                        /* send mail cofirm */
                        $mailConfirm = Mage::getModel('core/email');
                        $logoUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).Mage_Adminhtml_Model_System_Config_Backend_Email_Logo::UPLOAD_DIR.'/'. Mage::getStoreConfig(Mage_Core_Model_Email_Template::XML_PATH_DESIGN_EMAIL_LOGO, $storeId);
                        $bodyConfirm = '<a href="{{store url=""}}"><img src="'.$logoUrl.'" alt="'.Mage::getStoreConfig('design/header/logo_alt', $storeId).'" style="margin-bottom:10px;" border="0"/></a><br/>'
                            . 'Hi <b>'.$params['name'].'</b>,<br/>'
                            . 'Thank you for submitting a request to appraise your item. Our experts will review your email and respond to you very soon.<br/>'
                            . 'DGSE Customer Service';
                        $subjectConfirm = 'DGSE: Confirm for your items appraised';
                        $mailConfirm
                            ->setType('html')
                            ->setBody($bodyConfirm)
                            ->setFromEmail($mailTo)
                            ->setFromName($nameTo)
                            ->setToEmail($params['email'])
                            ->setToName($params['name'])
                            ->setSubject($subjectConfirm)
                            ->send();

                        $translate->setTranslateInline(true);
                        Mage::getSingleton('core/session')->addSuccess($this->__("Thank you for sending us your item for appraisal. We will be in touch with you shortly."));
                    } catch (Exception $e) {
                        Mage::getSingleton('core/session')->addError($e->getMessage());
                        return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
                    }
                }
            } else { //not exists template email
                Mage::getSingleton('core/session')->addError('Error System, not exists template, please again!');
                return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
            }

        }
        return Mage::app()->getResponse()->setRedirect(Mage::helper('sm_sell')->getSellUrl());
    }
}