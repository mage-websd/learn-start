<?php
require 'SM/Xticket/Helper/Ticket.php';
class SM_Xticket_CronController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $model = Mage::getResourceModel('xticket/cats');
        //print"<pre>"; print_r(get_class_methods($model->getDepartmentActive())); die;
        $model_cat_store = Mage::getResourceModel('xticket/catstore')->getStoreById('9');
        //print"<pre>"; print_r(($model_cat_store)); die;
        $ticket = new Ticket();

        foreach($model->getDepartmentActive() as $key => $value) {
            print"<pre>"; print_r($value); die;
            $protocol = $value['protocol'];
            if($protocol == 'IMAP') {
                $mail = new Zend_Mail_Storage_Imap(array('host'     => $value['pophost'],
                                'user'     =>  $value['popuser'],
                                'password' =>  $value['poppass'],
                                'port' =>  $value['popport'] /*'993'*/,
                                'ssl' =>  $value['ssl'] /*'SSL'*/ ));
                $count = $mail->countMessages();

                $recordnumber = Mage::getStoreConfig('xticket/advanced/recordnumber');
                if($count-$recordnumber > 0) {
                    $cnt = $count-$recordnumber;
                } else {
                    $cnt=0;
                }

                for($i = $count; $i > $cnt; $i-- ) {
                    $message = $mail->getMessage($i);
                    $dataHeader = $message->getHeaders();
                    //print"<pre>"; print_r($ticket->getEmailByAuthenticationResults($dataHeader['authentication-results']));

                    //echo $received = $message->getHeader('received', 'string');
                    //print"<pre>"; print_r(get_class_methods($message));
                    //print"<pre>"; print_r($message); //die('trinh');
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
                    // print"<pre>"; print_r(get_class_methods($foundPart)); die;
                    //die;

                    //Code for checking if the message has attachment then write it to new file
                    //$message = $mail->getMessage($msg);
                    /*echo '<pre>';
					print_r($message);
					echo '</pre>';
					die;*/
                    $attachement ="N";
                    if(is_null($foundPart)) {
                        //echo ($message->getContent()); die;
                        $foundPart = $message->getContent();
                        $contentMessage = $dataHeader['subject']; //$message->getContent();
                        $email_sender = $dataHeader["to"];
                    }
                    if($message->isMultipart()) {
                        //print"<pre>"; print_r(get_class_methods($foundPart)); die('2');
                        $part = $message->getPart(2);
                        $type = $part->getHeaders ();
                        $type = $type['content-disposition'];
                        //print"<pre>"; print_r($part->getHeaders()); die;
                        $contentMessage = $foundPart->getContent();
                        $email_sender =  $ticket->getEmailByAuthenticationResults($dataHeader['authentication-results']); //$message->getHeader('delivered-to');
                        //echo ($message->getContent()); die;
                        //echo base64_decode($part->getContent()); die;
                        if(isset($type) && $type !="inline") {

                            $content = base64_decode($part->getContent());
                            $cnt_typ = explode(";" , $part->contentType);
                            $name = explode("=",$cnt_typ[count($cnt_typ)-1]);
                            $filename = $name[1];//It is the file name of the attachement in browser
                            //This for avoiding " from the file name when sent from yahoomail
                            $filename = str_replace('"',"",$filename);
                            $filename = trim($filename);
                            $attachement = $filename;//It is for add
                        }
                    }
                    if($attachement != "N") {
                        $myfile = Mage::getBaseDir() . DS. 'media' . DS.Mage::getStoreConfig('xticket/advanced/pathupload') . $filename;
                        $fh = fopen($myfile,'w') or die("can't open file");
                        fwrite($fh,$content);
                        fclose($fh);
                    }
                    $dataDepartment = $model->getDepartmentByEmail($message->getHeader('to'));
                    //print"<pre>"; print_r($message); die;
                    //echo $i.'---'.$message->from.'<br>';
                    $ticket = new Ticket();
                    $model = Mage::getModel('xticket/xticket');
                    $model->setData('subject',$message->subject);
                    $model->setData('code',$ticket->randStr());
                    //$model->setData('message', base64_decode($foundPart->getContent()));
                    $model->setData('timestamp',now());
                    $model->setData('name',$message->subject);
                    $model->setData('email',$email_sender);
                    $model->setData('status','awaitingcustomer');
                    $model->setData('cat',$dataDepartment);
                    $model->setData('created_time',now());
                    $model->setData('priority',3);
                    $model->setData('status',1);

                    $model->save();

                    $ticket->postAnswer($contentMessage, 1, '', $model->getID(), 'new');
                    //echo $model->getID(); die;
                    //unset($mail[$i]); // remove message from inbox mail on server
                    $modelAttachment = Mage::getModel('xticket/attachments');
                    $modelAttachment->setData('ticket',$model->getID());
                    $modelAttachment->setData('filename',$filename);
                    $modelAttachment->save();
                } //die('end');
            }
        }
    }
}
?>