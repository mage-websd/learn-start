<?php
class Smartosc_Viewblock_TwoController extends
    Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout();
        $blockLogo = $layout->createBlock('smartosc_viewblock/layout','logo')
            ->setTemplate('smartosc/viewblock/layouttwo/logo.phtml');
        $blockHead = $layout->createBlock('smartosc_viewblock/layout','head')
            ->setTemplate('smartosc/viewblock/layouttwo/head.phtml');
        $blockHeader = $layout->createBlock('smartosc_viewblock/layout','header')
            ->setTemplate('smartosc/viewblock/layouttwo/header.phtml')
            ->append($blockLogo,'logo');;
        $blockLeft = $layout->createBlock('smartosc_viewblock/layout','left')
            ->setTemplate('smartosc/viewblock/layouttwo/left.phtml');
        $blockLeft = $layout->createBlock('smartosc_viewblock/layout','left')
            ->setTemplate('smartosc/viewblock/layouttwo/left.phtml');
        $blockFooter = $layout->createBlock('smartosc_viewblock/layout','footer')
            ->setTemplate('smartosc/viewblock/layouttwo/footer.phtml');

        $blockContent = $layout->createBlock('smartosc_viewblock/layout','contain')
            ->setTemplate('smartosc/viewblock/two/index.phtml');


        $block = $layout->createBlock('smartosc_viewblock/layout')
            ->setTemplate('smartosc/viewblock/layouttwo/layout.phtml')
            ->append($blockHead,'head')
            ->append($blockHeader,'header')
            ->append($blockLeft,'left')
            ->append($blockContent,'content')
            ->append($blockFooter,'footer');

        echo $block->toHtml();
    }
}