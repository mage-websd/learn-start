<?php
class SM_Xticket_Element_Thread extends Varien_Data_Form_Element_Abstract
{
    public function __construct($data)
    {
        parent::__construct($data);
        $this->setType('thread');
    }

    public function getElementHtml()
    {
        $html_li = '';
		$pathupload = Mage::getStoreConfig('xticket/advanced/pathupload');
		$link = Mage::getBaseUrl('media').$pathupload;
		//echo $link; die;
		//print"<pre>"; print_r($this->getContent()); die;
		foreach($this->getContent() as $key => $value) {
			if(!empty($value['filename'])) {
                            $filename = '<p class="attachment">Attachment: <a href="'. $link.$value['filename'].'" onclick="this.target=\'_blank\'">'.$value['filename'].'</a></p>';
                        } else {
                            $filename = '';
                        }
                        $html_li .= '
					<ul class="note-list">
					  <li class="xticket-message">
						<h5>'.$value['represantative'].' <span class="separator">|</span> '.$value['timestamp'].'</h5>
						<p class="do-quote"> <a onClick="insQuot(this)" href="#content">Quote
						<textarea class="no-display">&gt;'.$value['timestamp'].'</textarea>
						</a> </p>
						<small style="display: block;"> '.$value['message'].'<br></small>	
						'.$filename.'
 						</li>
					</ul>										
						';	
		}
        $html = '
					
						'.$html_li.' 	
				';
        return $html;
    }
    public function getDefaultHtml()
    {
        $html = $this->getData('default_html');
        if (is_null($html)) {
            $html = ( $this->getNoSpan() === true ) ? '' : '<span class="field-row">'."\n";
            $html.= $this->getElementHtml();
            $html.= ( $this->getNoSpan() === true ) ? '' : '</span>'."\n";
        }
        return $html;
    }
    public function getHtml()
    {
		$html = $this->getDefaultHtml();
        return $html;
    }
}

?>
