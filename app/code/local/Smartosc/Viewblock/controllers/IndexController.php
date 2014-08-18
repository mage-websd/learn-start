<?php
class Smartosc_Viewblock_IndexController extends
    Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
//        $layout = $this->getLayout();
//        $blockLogo = $layout->createBlock('smartosc_viewblock/layout','logo')
//            ->setTemplate('smartosc/viewblock/layout/logo.phtml');
//        $blockHead = $layout->createBlock('smartosc_viewblock/layout','head')
//            ->setTemplate('smartosc/viewblock/layout/head.phtml');
//        $blockHeader = $layout->createBlock('smartosc_viewblock/layout','header')
//            ->setTemplate('smartosc/viewblock/layout/header.phtml')
//            ->append($blockLogo,'logo');;
//        $blockC = $layout->createBlock('smartosc_viewblock/layout','block.c')
//            ->setTemplate('smartosc/viewblock/index/c.phtml')
//        $blockLeft = $layout->createBlock('smartosc_viewblock/layout','left')
//                        ->setTemplate('smartosc/viewblock/layout/left.phtml')
//                        ->append($blockC,'block.c');
//        $blockD = $layout->createBlock('smartosc_viewblock/layout','block.c')
//            ->setTemplate('smartosc/viewblock/index/c.phtml')
//        $blockRight = $layout->createBlock('smartosc_viewblock/layout','right')
//            ->setTemplate('smartosc/viewblock/layout/right.phtml');
//        $blockFooter = $layout->createBlock('smartosc_viewblock/layout','footer')
//            ->setTemplate('smartosc/viewblock/layout/footer.phtml');
//
//        $blockContent = $layout->createBlock('smartosc_viewblock/layout','contain')
//            ->setTemplate('smartosc/viewblock/index/index.phtml');
//
//
//        $block = $layout->createBlock('smartosc_viewblock/layout')
//                        ->setTemplate('smartosc/viewblock/layout/layout.phtml')
//                        ->append($blockHead,'head')
//                        ->append($blockHeader,'header')
//                        ->append($blockLeft,'left')
//                        ->append($blockRight,'right')
//                        ->append($blockContent,'content')
//                        ->append($blockFooter,'footer');
        $blockHead = $this->createBlock('layout/');

        echo $block->toHtml();
    }

    private function createBlock($template,$alias='',$type='smartosc_viewblock/layout',$append=array())
    {
        $layout = $this->getLayout();
        $block = $layout->createBlock($type,$alias)
            ->setTemplate("smartosc/viewblock/{$template}.phtml");
        if(count($append)>0) {
            foreach($append as $blockChild => $aliasChild) {
                $block->append($blockChild,$aliasChild);
            }
        }
        return $block;
    }
}