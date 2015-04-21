<?php
/**
 * Observer model for catch events
 *
 * @category   Trangnt1pj1
 * @package    Trangnt1pj1_ShowAction
 * @author     TrangNT
 */
class SM_RedirectChoice_Model_Observer
{
    /**
     * Show full action name on every pages
     *
     * @param array $observer
     */
    public function saveCurrentUrl()
    {
        $session = Mage::getSingleton('core/session');
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();
        if (Mage::app()->getFrontController()->getAction()->getFullActionName() == 'cms_index_index') {
            if (strpos($session->getTruePrevPage(), 'customer/account') === false) {
                $session->unsPrevPage();
                if ($session->getProductUrl()) {
                    $session->setPrevPage($session->getProductUrl());
                } else {
                    $session->setPrevPage($currentUrl);
                }
            }
        } elseif (strpos($currentUrl, 'customer/account/login') === false &&
            strpos($currentUrl, 'customer/account/create') === false &&
            Mage::app()->getFrontController()->getAction()->getFullActionName() != 'cms_index_noRoute'
        ) {
            $session->unsPrevPage();
            if ($session->getProductUrl()) {
                $session->setPrevPage($session->getProductUrl());
            } else {
                $session->setPrevPage($currentUrl);
            }

        }
        $session->setTruePrevPage($currentUrl);
        if ($currentUrl != $session->getProductUrl()) {
            $session->unsProductUrl();
        }

    }

    public function loginMark()
    {
        $session = Mage::getSingleton('core/session');
        if (!$session->getJustRegister()) {
            $session->setJustLogin(1);
        }
    }

    public function registerMark()
    {
        $session = Mage::getSingleton('core/session');
        $session->setJustRegister(1);
    }

    public function popup()
    {
        $session = Mage::getSingleton('core/session');
        $justLogin = $session->getJustLogin();
        $justRegister = $session->getJustRegister();
        if ($justLogin) {
            $session->unsJustLogin();
            $message = 'You have logged in successfully!';
        } elseif ($justRegister) {
            $session->unsJustRegister();
            $message = 'You have registered successfully!';
        }

        if ($justLogin || $justRegister) {
            //<script src=' . Mage::getDesign()->getSkinUrl() . 'redirectchoice/js/popup.js></script>
            echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href=' . Mage::getDesign()->getSkinUrl() . 'redirectchoice/css/popup.css />
<input class="choiceModal-state" id="choiceModal-1" type="checkbox" />
<label class="choiceModal" for="choiceModal-1">
  <div class="choiceModal__inner">
    <h2>' . $message . '</h2>
    <label class="button" onclick="javascript:location.href=\'' . $session->getPrevPage() . '\'" >Back to Previous Page</label> <label class="button" onclick="javascript:location.href=\'' . Mage::getUrl('customer/account/') . '\'" >View Account</label>
  </div>
</label>
<script>
    jQuery("#choiceModal-1").click();
</script>';
        }
    }
}
