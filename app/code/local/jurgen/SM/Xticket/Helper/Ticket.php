<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


//require_once 'Mail.php';

class Ticket {


    /* ID of the ticket.
   * @var int
    */
    public $id          = 0;


    /* Name of the person filling out the ticket.
   * @var int
    */
    public $name          = '';

    /**
     * Email of the person filling out the ticket.
     * @var int
     */
    public $email          = '';

    /**
     * Phone of the person filling out the ticket.
     * @var int
     */
    public $phone          = '';

    /**
     * Category of the ticket.
     * @var int
     */
    public $category          = 0;

    /**
     * Email priority (1 = High, 2 = Normal, 3 = low).
     * @var int
     */
    public $priority          = '';

    /**
     * IP of the client.
     * @var int
     */
    public $ip          = '';

    /**
     * Message coming the first time from the user.
     * @var int
     */
    public $message          = '';

    /**
     * Subject of the Message.
     * @var int
     */
    public $subject          = '';

    /**
     * Subject of the Message.
     * @var int
     */
    public $timestamp         	 = '';
    public $is_lock          		 = '';
    public $order_incremental_id	 = '';
    public $quick_template         = '';
    public $note          		 = '';
    public $status          		 = '';
    public $code          		 = '';

    function create($sendmail = TRUE) {


        if ($this->id && /*$this->priority && $this->category && $this->subject &&*/ $this->name && $this->email) {
            $db_settings=Mage::helper('xticket')->getMailDBSettings();

            if (($this->ip != '') && ($_SERVER['REMOTE_ADDR'] != ''))
                $this->ip = $_SERVER['REMOTE_ADDR'];

            //if (($this->priority == '') || ($this->priority < 0 || $this->priority > 3))
            //	$this->priority = 2;

            //$this->priority = preg_replace('/\D+/', '', $this->priority); //sanitise
            $this->category = preg_replace('/\D+/', '', $this->category); //sanitise
            $this->timestamp = now();
            $this->created_time = now();
            // insert a new ticket...
            $model = Mage::getModel('xticket/xticket');
            $model->setData('ID',$this->id);
            $model->setData('code',$this->code);
            $model->setData('subject',$this->subject);
            $model->setData('name',$this->name);
            $model->setData('email',strtolower($this->email));
            $model->setData('cat',$this->category);
            $model->setData('priority',$this->priority);
            $model->setData('status',$this->status);
            $model->setData('ip',$this->ip);
            //$model->setData('message',$this->message);
            $model->setData('timestamp',$this->timestamp);
            $model->setData('created_time',$this->created_time);
            $model->setData('is_lock',$this->is_lock);
            $model->setData('order_incremental_id',$this->order_incremental_id);
            $model->setData('quick_template',$this->quick_template);
            $model->setData('note',$this->note);
            //print"<pre>"; print_r($this->status); die('hepler');
            $model->save();

            $c = Mage::getModel('xticket/cats')->load($this->category);
            $mailsubj = $db_settings['ticket_subj'];
            $mailmsg = $db_settings['ticket_msg'];
            $signature= $c->getData('signature');

            if ($sendmail) { //should we send?
                $mail=new Mail();
                $mail->sendEMail($this->id, $this->subject, $this->name, $this->email, $c, $this->priority, $this->message,$mailsubj, $mailmsg, $signature);
            }
            return true;
        }else
            return false;
    }

    function update($id, $data, $sendmail = TRUE) {
        $model = Mage::getModel('xticket/xticket')->load($id);
        $model->setData($data);
        $model->setData('ID',$id);
        $model->update();
//		    $model = Mage::getModel('xticket/xticket');
//		    $data['ID'] = $id;
//			$model->setData('ID',$id);
//			$model->setData('order_incremental_id',$data['order_incremental_id']);
//			$model->setData('note',$data['note']);
//			print"<pre>"; print_r($data); die("asd");
//			$model->save();
    }

    function close($ticketID) {
        $this->changeStatus($ticketID, 'closed');
    }
    function reopen($ticketID) {
        $this->changeStatus($ticketID, 'reopened');
    }
    function putonHold($ticketID) {
        $this->changeStatus($ticketID, 'onhold');
    }
    function delete($ticketID) {
        $ticketID = preg_replace('/\D+/', '', $ticketID); //sanitise
        // delete ticket
        $model = Mage::getModel('xticket/xticket');
        $model->setId($ticketID)->delete();

        // delete messages
        $model = Mage::getModel('xticket/messages');
        $model->setTicket($ticketID)->delete();

        // delete answers
        $model = Mage::getModel('xticket/answers');
        foreach ($model->getCollection()->addFieldToFilter('ticket',$ticketID)->load() as $item) {
            $ans_id=$item->getData('ID');
            if ($ans_id) {
                Mage::getModel('xticket/answers')
                        ->setId($ans_id)
                        ->delete();
            }
        }
    }

    function changeStatus($ticketId, $status) {
        $ticketId = preg_replace('/\D+/', '', $ticketId); //sanitise
        $model = Mage::getModel('xticket/xticket')->load($ticketId);
        $model->setData('status',$status);
        $model->update();
    }

    function changeRep($ticketId, $repId) {
        $ticketId = preg_replace('/\D+/', '', $ticketId); //sanitise
        $model = Mage::getModel('xticket/xticket')->load($ticketId);
        $model->setData('rep',$repId);
        $model->update();
    }

    function postMessage($ticketId, $message, $header = '', $notifyuser = true, $newstatus = 'new') {

        $db_settings=Mage::helper('xticket')->getMailDBSettings();

        $ticketId = preg_replace('/\D+/', '', $ticketId); //sanitise
        $errors = array();

        $this->reopen($ticketId);
        $header = $db_settings['save_headers'] ? $header : '';

        $model = Mage::getModel('xticket/messages');
        $model->setData('headers',$header);
        $model->setData('message',$message);
        $model->setData('ticket',$ticketId);
        $model->setData('timestamp',now());
        $id=$model->save()->getId();


        //update ticket status
        $this->changeStatus($ticketId, $newstatus);

        if ($db_settings['alert_new']) {
            $mail = new Mail();
            $mail->emailAlert($ticketId, $id);
        }
        if ($db_settings['message_response'] && $notifyuser) {
            $t = Mage::getModel('xticket/xticket')->load($ticketId);
            $c = Mage::getModel('xticket/cats')->load($t->getData('cat'));

            $mailsubj = $db_settings['message_subj'];
            $mailmsg = $db_settings['message_msg'];
            $signature= $c->getData('signature');
            $mail=new Mail();
            $mail->sendEMail($t->getData('ID'), $t->getData('subject'), $t->getData('name'), $t->getData('email'), $c, $t->getData('priority'), $t->getData('message'), $mailsubj, $mailmsg, $signature);
        }
    }
    function postAnswer($message, $repid, $rep_name, $ticketid, $newstatus, $rep_filename) {

        $db_settings=Mage::helper('xticket')->getMailDBSettings();

        $msg_res = Mage::getModel('xticket/messages')->load($ticketid,'ticket');
        $msgid= $msg_res->getData('ID');

        $t = Mage::getModel('xticket/xticket')->load($ticketid);

        //$this->changeStatus($ticketid, $newstatus);
        if (! ($rep_name == 'Administrator')) {
            if($repid > 0)
                $this->changeRep($ticketid, $repid);
        }

        $answers=Mage::getModel('xticket/answers');
        $answers->setData('ticket',$ticketid);
        $answers->setData('message',$message);
        $answers->setData('reference',$msgid);
        $answers->setData('rep',$repid);
        $answers->setData('filename',$rep_filename);
        $answers->save();

        $catid=$t->getData('cat');
        $cat_res=Mage::getModel('xticket/cats')->load($catid);
        $answer_subj = $db_settings['answer_subj'];
        $answer_msg = $db_settings['answer_msg'];
        $signature= $cat_res->getData('signature');
        //$mail=new Mail();
        //$mail->sendEMail($ticketid, $t->getData('subject'), $t->getData('name'), $t->getData('email'), $cat_res, $t->getData('priority'), $message, $answer_subj, $answer_msg, $signature, true);
    }


    function postPrivMessage($ticket, $repid, $msg) {
        $db_settings=Mage::helper('xticket')->getMailDBSettings();
        $id = preg_replace('/\D+/', '', $id); //sanitise
        $errors = array();
        $model=Mage::getModel('xticket/privmsg');
        $model->setData('ticket',$ticket);
        $model->setData('rep',$repid);
        $model->setData('message',$msg);
        $model->setData('timestamp',now());
        $model->save();
        return $errors ? $errors : $id;
    }


    function transCatTicket($tid, $cid, $add_msg = false, $alert = false) {

        $db_settings=Mage::helper('xticket')->getMailDBSettings();

        $tid = preg_replace('/\D+/', '', $tid); //sanitise
        $cid = preg_replace('/\D+/', '', $cid); //sanitise

        $add_msg = $add_msg ? ': ' . $add_msg : '';
        $add_msg = preg_replace("/%20/", " ", $add_msg);


        $model=Mage::getModel('xticket/xticket')->load($tid);
        $catFrom=Mage::getModel('xticket/cats')->load($model->getData('cat'));
        $cat2=Mage::getModel('xticket/cats')->load($cid);
        $trans_msg = 'From ' . $catFrom->getData('name') . ' ' . ' (' . '' /*format_time($db_settings['time_format'])*/ . ') ' . $add_msg;
        $model->setData('cat',$cid);
        $model->setData('trans_msg', $trans_msg);
        $model->update();

        if ($db_settings['trans_response'] && !$cat2->getData('hidden') && $alert) {
            $trans_subj = $db_settings['trans_subj'];
            $trans_msg = $db_settings['trans_msg'];
            $vars = array();
            $vars['ticket'] = $tid;
            $vars['subject'] = $model->getData('subject');
            $vars['category'] = $cat2->getData('name');
            $vars['cat_name'] = $cat2->getData('name');
            $vars['name'] = $model->getData('name');
            $vars['email'] = $model->getData('email');
            $vars['status'] = $model->getData('status');
            $vars['trans_msg'] = $add_msg;
            $trans_msg = addRemoveTag($trans_msg, $db_settings);
            $trans_msg = addSig($cat2->getData('signature'), $trans_msg, $db_settings);
            $trans_subj = keywords($trans_subj, $vars, $db_settings);
            $text = keywords($trans_msg, $vars,$db_settings);
            if ($html = getHTML($trans_msg, $vars, 'email-example.html',$db_settings)) {
                $body = array();
                $body['text'] = $text;
                $body['html'] = $html;
            } else {
                $body = $text;
            }
            //notify user
            $from = '"' . $cat2->getData('name') . '" <' . $cat2->getData('email') . '>';
            send_mail($model->getData('email'), $trans_subj, $body, $from, $model->getData('priority'),$db_settings);
            //notify admin
            $from = $db_settings['alert_email'];
            $mail=new Mail();
            foreach($mail->getEmails($cat2->getData('ID')) as $to) {
                if (!empty($to)) {
                    send_mail($to, $trans_subj, $body, $from, $model->getData('priority'),$db_settings);
                }
            }
        }
    }


    function transRepTicket($tid, $rid, $alert = false) {

        $db_settings=Mage::helper('xticket')->getMailDBSettings();

        $tid = preg_replace('/\D+/', '', $tid); //sanitise
        $rid = preg_replace('/\D+/', '', $rid); //sanitise
        if (empty($tid)) {
            return;
        }
        if (empty($rid)) {
            return;
        }

        $model=Mage::getModel('xticket/xticket')->load($tid);
        $repFrom=Mage::getModel('xticket/reps')->load($model->getData('rep'));
        $rep2=Mage::getModel('xticket/reps')->load($rid);
        $model->setData('rep',$rid);
        $model->update();

        if ($db_settings['rep_trans_response'] && $alert) {
            $trans_subj = $db_settings['rep_trans_subj'];

            $trans_msg = $db_settings['rep_trans_msg'];
            $vars = array();
            $vars['ticket'] = $tid;
            $vars['subject'] = $model->getData('subject');
            $vars['rep_name'] = $rep2->getData('name');
            $vars['name'] = $model->getData('name');
            $vars['email'] = $model->getData('email');
            $vars['status'] = $model->getData('status');
            $trans_subj = keywords($trans_subj, $vars, $db_settings);

            $text = keywords($trans_msg, $vars, $db_settings);
            if ($html = getHTML($trans_msg, $vars, 'email-example.html', $db_settings)) {
                $body = array();
                $body['text'] = $text;
                $body['html'] = $html;
            } else {
                $body = $text;
            }

            //notify admin
            $from = $db_settings['alert_email'];
            $emails = array();

            // alert_users need to be alerted
            if (!empty($db_settings['alert_user'])) {
                $emails = explode(';', $db_settings['alert_user']);
            }
            // The rep who is being transferred from needs to be alerted
            if ($repFrom->getData('email')) {
                $emails[] = $repFrom->getData('email');
            }
            // The rep who is being transferred to needs to be alerted
            if ($rep2->getData('email')) {
                $emails[] = $rep2->getData('email');
            }
            // Ensure we don't send to the same email address twice
            $emails = array_unique($emails);

            foreach($emails as $to) {
                if (!empty($to)) {
                    send_mail($to, $trans_subj, $body, $from, $model->getData('priority'),$db_settings);
                }
            }
        }

    }

    function addAttachment($filename, $ticketid) {
        $modelAttachment = Mage::getModel('xticket/attachments');
        $modelAttachment->setData('ticket',$ticketid);
        $modelAttachment->setData('filename',$filename);
        $modelAttachment->save();
    }

    public function getEmailFrom($text) {
        $emailArr = array();
        if(!empty($text)) {
            $spl = split('<', $text);
            $mail = split('>', $spl[1]);
            $emailArr['name'] = $spl[0];
            $emailArr['email'] = $email[0];
            return $emailArr;
        } else {
            return NULL;
        }
    }

    public function getEmailByAuthenticationResults($text) {
        if(!empty($text)) {
            $spl = split('smtp.mail=', $text);
            return $spl[1];
        } else {
            return NULL;
        }
    }

    public function randStr($length = 6, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        // Length of character list
        $chars_length = (strlen($chars) - 1);

        // Start our string
        $string = $chars{rand(0, $chars_length)};

        // Generate random string
        for ($i = 1; $i < $length; $i = strlen($string)) {
            // Grab a random character from our list
            $r = $chars{rand(0, $chars_length)};

            // Make sure the same two characters don't appear next to each other
            if ($r != $string{$i - 1}) $string .=  $r;
        }

        // Return the string
        return $string;
    }

}