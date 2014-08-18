<?php

class Smartosc_Helloworld_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        //$this->_redirect('helloworld/index/re',array('data'=>'123'));
        /* $this->loadLayout();
         $this->renderLayout();*/

        /*$store = Mage::getModel('core/store')->load(5);
        var_dump($store->getData());*/
        $this->loadLayout();
        $this->renderLayout();

    }

    public function reAction()
    {
        var_dump($data);
        echo 'a';
    }

    public function datatestAction()
    {
        $dataTest = Mage::getSingleton('helloworld/datatest')->getCollection();
        $dataTest = $dataTest->addFieldToFilter('name', 'user3');
        var_dump((string)$dataTest->getSelect());
//        foreach($dataTest as $data) {
//            var_dump($data->getData());
//        }

    }

    public function whereAction()
    {
        $dataTest = Mage::getModel('helloworld/datatest')->getCollection();
        $dataTest
            //->getSelect()
            ->addFieldToSelect('id')
            ->getSelect()->where('id > 3');
        //->columns('main_table.id')
//            ->join(
//                array('qaz'=>$dataTest->getTable('helloworld/data')),
//                'qaz.datatest_id = main_table.id'
//            )
//            ->where('main_table.id < 20')
//            ->order('main_table.id desc')
//            ->limit(10)
        //->getColumnValues('id');

        var_dump($dataTest->load(1)->getData());
    }

    public function testLayoutAction()
    {
        $this->loadLayout('default_helloworld');
        var_dump($this->getLayout()->getUpdate()->getHandles());
        return;

    }

    public function viewmoduleAction()
    {
        echo 'Module: ' . Mage::app()->getRequest()->getModuleName();
        echo '<br/><br/>';

        echo 'ControllerKey: ' . Mage::app()->getRequest()->getControllerKey();
        echo '<br/>ControllerModule: ' . Mage::app()->getRequest()->getControllerModule();
        echo '<br/>ControllerName: ' . Mage::app()->getRequest()->getControllerName();
        echo '<br/>ControllerRequestdName: ' . Mage::app()->getRequest()->getRequestedControllerName();
        echo '<br/><br/>';

        echo 'ActionKey: ' . Mage::app()->getRequest()->getActionKey();
        echo '<br/>ActionName: ' . Mage::app()->getRequest()->getActionName();
        echo '<br/>ActionRequestedName: ' . Mage::app()->getRequest()->getRequestedActionName();
        echo '<br/><br/>';

        echo '<br/>Front: ' . Mage::app()->getRequest();

    }

    public function geoipAction()
    {
        $geoIP = Mage::getSingleton('geoip/country');
        if($geoIP->getCountry() == 'AU') {
            Mage::http_redirect('http://mock.local');
        }
        else {
            Mage::http_redirect('http://giangnt.mock.local');
        }
    }
}
