<?php
require 'SM/Xticket/Helper/Ticket.php'; 
class SM_Xticket_Model_Observer extends
    Mage_Core_Model_Abstract
{

    public function runScheduledXticket($observer)
    {
		$model = Mage::getResourceModel('xticket/cats');
		//print"<pre>"; print_r(get_class_methods($model->getDepartmentActive())); die;
		//print"<pre>"; print_r($model->getDepartmentActive()); die;
		foreach($model->getDepartmentActive() as $key => $value)
		{ 
			//print"<pre>"; print_r($value); die;
			$protocol = $value['protocol'];
			if($protocol == 'IMAP') 
			{
				$mail = new Zend_Mail_Storage_Imap(array('host'     => $value['pophost'],
														 'user'     =>  $value['popuser'],
														 'password' =>  $value['poppass'],
														 'port' =>  $value['popport'] /*'993'*/,
														 'ssl' =>  $value['ssl'] /*'SSL'*/ ));
				$count = $mail->countMessages();								
				$recordnumber = Mage::getStoreConfig('xticket/advanced/recordnumber');
				for($i = $count; $i > $count-$recordnumber; $i-- )
				{
					$message = $mail->getMessage($i);
					if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
						continue;
					}
					// mark recent/new mails				
					if ($message->hasFlag(Zend_Mail_Storage::FLAG_RECENT)) {
						echo '! ';
					} else {
						echo '  ';
					}
					// output first text/plain part
					$foundPart = null;
					foreach (new RecursiveIteratorIterator($message) as $part) {
					  try {
						  if (strtok($part->contentType, ';') == 'text/plain') {
							  $foundPart = $part;
							  break;
						  }
					  } catch (Zend_Mail_Exception $e) {
						  // ignore
					  }
					}
					
					
					//Code for checking if the message has attachment then write it to new file
					//$message = $mail->getMessage($msg);
					/*echo '<pre>';
					print_r($message);
					echo '</pre>';
					die;*/
					$attachement ="N";
					if(is_null($foundPart))
					{	
						$foundPart = $message->getContent();
						$contentMessage = $message->getContent();
						$email_sender = $message->getHeader('delivered-to');
					}		
					if($message->isMultipart()){
						$part = $message->getPart(2);
						$type = $part->getHeaders ();
						$type = $type['content-disposition'];
						$contentMessage = $foundPart->getContent(); 
						$email_sender =  $message->getHeader('delivered-to');
						if($type !="inline"){
													   
								$content = base64_decode($part->getContent());
								$cnt_typ = explode(";" , $part->contentType);
								$name = explode("=",$cnt_typ[1]);
								print"<pre>"; print_r($part->contentType);
								$filename = $name[1];//It is the file name of the attachement in browser
								//This for avoiding " from the file name when sent from yahoomail
								$filename = str_replace('"'," ",$filename);
								$filename = trim($filename);
								$attachement = $filename;//It is for add
						}
					}
				
					if($attachement != "N") {
						$myfile = Mage::getBaseDir() . DS.Mage::getStoreConfig('xticket/advanced/pathupload') . $filename;
						$fh = fopen($myfile,'w') or die("can't open file");
						fwrite($fh,$content);
						fclose($fh);
					} 					
					$dataDepartment = $model->getDepartmentByEmail($message->getHeader('delivered-to'));
					//print"<pre>"; print_r($message); die;
					//echo $i.'---'.$message->from.'<br>';
					$model = Mage::getModel('xticket/xticket');
					$model->setData('subject',$message->subject);
					//$model->setData('message', base64_decode($foundPart->getContent()));
					$model->setData('timestamp',now());					
					//$model->setData('name',$message->from);
					$model->setData('email',$email_sender);
					$model->setData('status','awaitingcustomer');
					$model->setData('cat',$dataDepartment);			
					$model->save();
					$ticket = new Ticket();
					$ticket->postAnswer($contentMessage, 0, '', $model->getID(), 'new');
					//echo $model->getID(); die;
					//unset($mail[$i]); // remove message from inbox mail on server
					$modelAttachment = Mage::getModel('xticket/attachments');
					$modelAttachment->setData('ticket',$model->getID());
					$modelAttachment->setData('filename',$filename);	
					$modelAttachment->save();		
				} 
			}
		}	
        
        return $this;
    }
}