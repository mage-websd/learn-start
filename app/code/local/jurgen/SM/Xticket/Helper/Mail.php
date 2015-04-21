<?php

/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */


require 'TicketFunctions.php';

class Mail {
	

	public function sendEmail($id, $subject, $name, $email, $cat, $pri, $message = '', $mailsubject, $mailmsg , $signature, $answer = false){

		$db_settings=Mage::helper('xticket')->getMailDBSettings();
        $vars = array();
        $vars['ticket'] = $id;
        $vars['subject'] = $subject;
        if ($answer)
        	$vars['answer'] = $message;
        else
        	$vars['message'] = $message;
        $vars['name'] = $name;
        $vars['email'] = $email;
        $vars['category'] ='';
        if ($cat && $cat->getData('name'))
        	$vars['category'] = $cat->getData('name');
        	
        // remove tags from the message.
        $mailmsg = addRemoveTag($mailmsg, $db_settings);

        // add signature to the message.
        if ($signature)
        	$mailmsg = addSig($signature, $mailmsg, $db_settings);
        else
        	$mailmsg = addSig('', $mailmsg, $db_settings);

        // replace keyword with real values from db.
        $mailsubject = keywords($mailsubject, $vars, $db_settings);
        $text = keywords($mailmsg, $vars, $db_settings);
		
        if ($html = getHTML($mailmsg, $vars, 'email-example.html', $db_settings)) {
            $body = array();
            $body['text'] = $text;
            $body['html'] = $html;
        } else {
            $body = $text;
        }
        
        if ($db_settings['ticket_response']) {
        	$from='';
        	if ($cat && $cat->getData('name') && $cat->getData('email'))
            	$from = '"' . $cat->getData('name') . '" <' .  $cat->getData('email') . '>';
            send_mail($email, $mailsubject, $body, $from, $pri, $db_settings);
        }
	}
	
	
	function emailAlert($tid, $msgid = false, $subject = false, $message = false) { //alerts the alert_user (in mail) and cat reps

		$db_settings=Mage::helper('xticket')->getMailDBSettings();
		
	    $tid = preg_replace('/\D+/', '', $tid); //sanitise
	    $msgid = preg_replace('/\D+/', '', $msgid); //sanitise
	    if (empty($tid)) {
	        return;
	    }
	    $t  = Mage::getModel('xticket/xticket')->load($tid);
	    $cat =Mage::getModel('xticket/cats')->load($t->getData('cat'));
	      
	    $m = Mage::getModel('xticket/messages')->load($msgid);
	    $from = $db_settings['alert_email'];
	    $alert_subj = $db_settings['alert_subj'];
	    $repl_meth = $cat->getData('reply_method');
	    $alert_msg = $db_settings['alert_msg'];
	    /*if ($repl_meth['reply_method'] != 'url') {
	        $alert_msg.= '<br>Client Request:' . $m->getData('message');
	    }*/
	    $vars = array();
	    $vars['ticket'] = $t->getData('ID');
	    $vars['subject'] = $subject ? $subject : htmlspecialchars_decode($t->getData('subject'));
	    $vars['category'] = $cat->getData('name');
	    $vars['cat_name'] = $cat->getData('name');
	    $vars['name'] = $t->getData('name');
	    $vars['email'] = $t->getData('email');
	    $vars['status'] = $t->getData('status');
	    $vars['datetime'] = (empty($m)) ? '' : format_time('r', $m->getData('timestamp'));
	    $vars['message'] = $message ? $message : htmlspecialchars_decode($m->getData('message'));
	    $alert_subj = keywords($alert_subj, $vars, $db_settings);
	    $text = keywords($alert_msg, $vars, $db_settings);
	    
		if ($html = getHTML($alert_msg, $vars, 'email-example.html', $db_settings)) {
	        $body = array();
	        $body['text'] = $text;
	        $body['html'] = $html;
	    } else {
	        $body = $text;
	    }
		foreach($this->getEmails($t->getData('cat')) as $to) {
	        if (!empty($to)) {
	            send_mail($to, $alert_subj, $body, $from, $t->getData('priority'), $db_settings);
	        }
	    }
	}
	
	
	function getEmails($catid) {
	    $db_settings=Mage::helper('xticket')->getMailDBSettings();
	    $cat_reps = array();
	    $reps = Mage::getModel('xticket/reps')->getCollection();
	    foreach($reps as $rep) {
	    	$user_group =Mage::getModel('xticket/groups')->load($rep->getData('user_group'));
	    	if ($user_group){
		        $cat_access = explode(':', $user_group->getData('cat_access'));
		        if (in_array($catid, $cat_access) || in_array('all', $cat_access)) {
		            $cat_reps[] = $rep;
		        }
	    	}
	    }
	    $emails = array();
	    if (!empty($db_settings['alert_user'])) {
	        $emails = explode(';', $db_settings['alert_user']);
	    }
	    foreach($cat_reps as $cat_rep) {
	        $add_email = 1;
	        if (substr($rep->getData('password'), 0, 8) === '*LOCKED*') {
	            $add_email = 0;
	        }
	        if (in_array($cat_rep->getData('email'), $emails)) {
	            $add_email = 0;
	        }
	        if ($add_email) {
	            $emails[] = $cat_rep->getData('email');
	        }
	    }
	    $emails = array_unique($emails);
	    return $emails;
	}
	
	
}
?>