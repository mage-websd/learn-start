<?php
/**
 * @category	design_default
 * @author 		smartosc.com
 * @package		SM_XTicket
 * @copyright  	Copyright (c) 2008-2009
 */

require 'SM/Xticket/Helper/Ticket.php';

class SM_Xticket_Adminhtml_XticketController extends Mage_Adminhtml_Controller_action {
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('xticket/ticket')
                ->_addBreadcrumb(Mage::helper('xticket')->__('XTicket'), Mage::helper('xticket')->__('View Tickets'));
        return $this;
    }

    public function indexAction() {
        $this->_initAction();
        $this->renderLayout();
    }


    public function editAction() {
        $this->loadLayout();
        $this->_setActiveMenu('xticket/items');
        $this->_addBreadcrumb(Mage::helper('xticket')->__('Ticket'), Mage::helper('xticket')->__('View Tickets'));
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $cats = Mage::helper('xticket')->getAllCategories(true);
        $templates = Mage::helper('xticket')->getAllTemplates(true);
        $reps=Mage::helper('xticket')->getAllRepresantatives();
        Mage::register('xticket_represantatives',$reps);
        Mage::register('xticket_categories', $cats);
        Mage::register('xticket_templates', $templates);

        $id = $this->getRequest()->getParam('id');
        //$this->getContentTemplateAction();
        // Edit Ticket
        if ($id > 0) {

            // **********************************************
            $model  = Mage::getModel('xticket/xticket')->load($id);
            $model->setData('hidden_ID',$id);
            $model->setData('hidden_status',$model->getData('status'));
            $model->setData('hidden_subject',$model->getData('subject'));
            $model->setData('hidden_name',$model->getData('name'));
            $model->setData('hidden_email',$model->getData('email'));
            $model->setData('hidden_phone',$model->getData('phone'));
            $model->setData('cat_alert',1);
            $model->setData('rep_alert',1);
            $model->setData('email_fill','Paste Template');
            // **********************************************
            Mage::register('xticket_data', $model);

            $answers='';
            $model_ans  = Mage::getModel('xticket/answers');
            $data_message = array();
            foreach ($model_ans->getCollection()->addFieldToFilter('ticket',$id)->load() as $val){
            //$thread = Mage::getResourceModel('xticket/answers')->getThreadContent();
            //foreach($thread as $key => $val) {
                $message=$val['message'];
                $rep=$val['rep'];
                $timestamp=$val['timestamp'];
                $filename=$val['filename'];
                $represantative='';
                if (array_key_exists($rep,$reps))
                    $represantative = $reps[$rep]->getData('name');
                $answers .='('.$represantative.' '.$timestamp.') '.$message."\n";
                if(!empty($filename)) {
                $data_message[] = array('represantative' => $represantative,
                        'timestamp' => $timestamp,
                        'filename' => $filename,
                        'message' => nl2br($message));                    
                } else {
                $data_message[] = array('represantative' => $represantative,
                        'timestamp' => $timestamp,
                        'message' => nl2br($message));                    
                }

            }
            //print"<pre>"; print_r($model_ans->getCollection()->addFieldToFilter('ticket',$id)->load()->getItems());

            $model_msg  = Mage::getModel('xticket/messages')->load($id, 'ticket');
            $message = $model_msg->getMessage();
            $timestamp= $model_msg->getTimestamp();
            $rep=$model_msg->getRep();
            $represantative='';
            $represantative='';
            if (array_key_exists($rep,$reps))
                $represantative = $reps[$rep]->getData('name');
            $message ='('.$represantative.' '.$timestamp.') '.$message."\n";

            if ($answers)
                $message = $message."\n".$answers;
            // **********************************************

            // Set message to front
            //$model->setData('message', $message);
            $model->setData('trans_note', $model->getData('trans_msg'));
            $model->setData('trans_msg','');
            $model->setData('reply', $message);
            $model->setData('data_message', $data_message);

            $this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_xticket_edit'))
                    ->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_xticket_edit_tabs'));

        } else {
            $model  = Mage::getModel('xticket/xticket');
            $model->setData('email_fill','Paste Template');
            // New Ticket
            $this->_addContent($this->getLayout()->createBlock('xticket/adminhtml_xticket_edit'))
                    ->_addLeft($this->getLayout()->createBlock('xticket/adminhtml_xticket_edit_newtabs'));
        }
        $this->renderLayout();
    }


    public function onholdAction() {
        $ticket = new Ticket();
        $ticket->id = $this->getRequest()->getParam('id');
        $ticket->changeStatus('onhold');
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Status was successfully changed'));
        $this->_redirect('*/*/');
        return;
    }


    public function setstatAction() {
        $ticket = new Ticket();
        $id = $this->getRequest()->getParam('id');
        $new_status     = $this->getRequest()->getParam('new_status');
        if($new_status) {
            $ticket->changeStatus($id,$new_status);
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Status was successfully changed'));
        }else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select a status'));
        }
        $this->_redirect('*/*/edit', array('id' => $id));
        return;
    }


    public function transrepAction() {
        $id     = $this->getRequest()->getParam('id');
        $repId  = $this->getRequest()->getParam('reps');
        $alert 	= $this->getRequest()->getParam('rep_alert');
        if($repId) {
            $ticket = new Ticket();
            $ticket->transRepTicket($id, $repId, $alert);
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Represantative was successfully assigned'));
        }else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select a represantative'));
        }
        $this->_redirect('*/*/edit', array('id' => $id));
        return;
    }


    public function transcatAction() {
        $id     	= $this->getRequest()->getParam('id');
        $catId     	= $this->getRequest()->getParam('cats');
        $cat_message = $this->getRequest()->getParam('message');
        $alert 	= $this->getRequest()->getParam('cat_alert');

        $ticket = new Ticket();
        $ticket->transCatTicket($id, $catId, $cat_message, $alert);

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Ticket is transfered to department successfully'));
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
        return;
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {

        $id=$this->getRequest()->getParam('id');
        $data = $this->getRequest()->getPost();


        if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader('filename');
                //$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir() . DS. 'media'. DS.Mage::getStoreConfig('xticket/advanced/pathupload') . DS ;
                $uploader->save($path, $_FILES['filename']['name'] );
            } catch (Exception $e) {

            }

            $data['filename'] = $_FILES['filename']['name'];
        }
        //print"<pre>"; print_r($_FILES['filename']);
        //die('bg');

        $is_new=false;
        if ($id == 0)
            $is_new=true;
        try {
            // *********************************************
            // New Ticket
            //print"<pre>"; print_r($data); die;
            if ($is_new) {
                if (empty($data['name'])==false && empty($data['email'])==false )
                    $id=Mage::helper('xticket')->getTicketID();
                else {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please enter all required fields'));
                    $this->_redirect('*/*/new', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
            }
            // Existing Ticket
            else if(is_array($data) && empty($data['answer'])) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please enter the new message'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }

            // *********************************************
            $ticket = new Ticket();
            $ticket->id=$id;
            $ticket->message=isset($data['message']) ? $data['message'] : $data['answer'];
            $ticket->timestamp=now();
            if ($is_new) {
                $ticket->subject=$data['name'];
                $ticket->code=$ticket->randStr();
                $ticket->name=$data['name'];
                $ticket->email=$data['email'];
                $ticket->priority=$data['priority'];
                $ticket->category=$data['cat'];
                //$ticket->ip=$_SERVER['REMOTE_ADDR'];
                $ticket->status=$data['status'];
                $ticket->is_lock=$data['is_lock'];
                $ticket->quick_template=$data['quick_template'];
                $ticket->note=$data['note'];
                //print"<pre>"; print_r($ticket); die("zxc");
                if(!$ticket->create(false)) {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Ticket could not be saved. Check all fields.'));
                    return;
                }else {
                    // Do not notify user for the message post
                    $ticket->postMessage($id, $ticket->message, '', false, 'new');
                    if(!empty($data['filename'])) {
                        $ticket->addAttachment($data['filename'], $id);
                    }
                    $model_department = Mage::getModel('xticket/cats')->load($data['cat']);
                    $dataDepartment = $model_department->getData();
                    if($data['is_sendmail'] == 1) {
                        $this->sendemailAction($dataDepartment['name'], $dataDepartment['email'], "#".$ticket->code.' - '.$data['name'], $data['email'], '', $data['message'], $dataDepartment['out_pophost'], $dataDepartment['out_ssl'], $dataDepartment['out_popport'], $dataDepartment['popuser'], $dataDepartment['poppass'], $dataDepartment['is_smtp']);
                    }

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Ticket was successfully saved'));
                }
            }else if (is_array($data) /*&& empty($data['answer'])==false && empty($data['priority'])==false && empty($data['cat'])==false*/) {

                $model = Mage::getModel('xticket/xticket')->load($id);
                $code = $model->getData('code');
                $model->setData($data);
                $model->setData('ID',$id);
                $model->update();
				if(isset($data['stores'])){
					$stores = $data['stores'];
				}else{
					$stores = array(null);
				}
                $answer=$data['answer'];

                if (!empty($answer)) {
                    $user = Mage::getSingleton('admin/session')->getData('user');
                    $username= $user->getData('username');
                    if ($username) {
                        $reps  = Mage::getModel('xticket/reps')->load($username,'username');
                        $repid = $reps->getData('ID');
                        $rep_name = $reps->getData('name');
                        if(!empty($data['filename'])) {
                            $rep_filename = $data['filename'];
                        }
                        $ticket->postAnswer($answer, $repid, $rep_name, $ticket->id, $data['status'], $rep_filename);
                    }
                }
                $model_department = Mage::getModel('xticket/cats')->load($data['cat']);
                $dataDepartment = $model_department->getData();

                if(!empty($data['filename'])) {
                    $ticket->addAttachment($data['filename'], $id);
                }

                if($data['is_sendmail'] == 1) {
                    $this->sendemailAction($dataDepartment['name'], $dataDepartment['email'], "#".$code, $data['email'], '', $data['answer'], $dataDepartment['out_pophost'], $dataDepartment['out_ssl'], $dataDepartment['out_popport'], $dataDepartment['popuser'], $dataDepartment['poppass'], $dataDepartment['is_smtp']);
                }
                //$this->sendemailAction();



                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Ticket was successfully saved'));
            }else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Ticket could not be saved. Check all fields.'));
            }
            // *********************************************

            if ($is_new)
                $this->_redirect('*/*/', array('id' => $id));
            else
                $this->_redirect('*/*/edit', array('id' => $id));

        } catch (Exception $e) {
            Mage::log('Save exception:'.$e);
            //Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            //Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/', array('id' => $id));
        }
    }

    public function deleteAction() {
        $id=$this->getRequest()->getParam('id');
        if( $id > 0 ) {
            try {
                $ticket = new Ticket();
                $ticket->delete($id);
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('xticket')->__('Ticket was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $softicketIds = $this->getRequest()->getParam('xticket');
        if(!is_array($softicketIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select ticket(s)'));
        } else {
            try {
                foreach ($softicketIds as $softicketId) {
                    $ticket = new Ticket();
                    $ticket->delete($softicketId);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('xticket')->__('Total of %d record(s) were successfully deleted', count($softicketIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $softicketIds = $this->getRequest()->getParam('xticket');
        $status = $this->getRequest()->getParam('status');
        if(!is_array($softicketIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select ticket(s)'));
        } else {
            try {
                foreach ($softicketIds as $softicketId) {
                    if ($softicketId >0) {
                        $ticket = new Ticket();
                        $ticket->changeStatus($softicketId, $status);
                    }else {
                        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('xticket')->__('Please select ticket(s)'));
                        $this->_redirect('*/*/index');
                        return;
                    }
                }
                $this->_getSession()->addSuccess(Mage::helper('xticket')->__('Total of %d record(s) were successfully updated', count($softicketIds)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction() {
        $fileName   = 'xticket.csv';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName   = 'xticket.xml';
        $content    = $this->getLayout()->createBlock('xticket/adminhtml_xticket_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    public function sendemailAction($name, $email, $mailsubj, $emailto, $nameto, $mailmsg, $mailserver, $ssl, $port, $username, $password, $is_smtp) {
        $config = array('username' => $username,
                'password' => $password,
                'auth' => 'login',
                'ssl' => $ssl /*'SSL'*/,
                'port' => $port /*465*/); // Optional port number supplied
        $transport = new Zend_Mail_Transport_Smtp($mailserver, $config);

        $params = array();
        $params['email'] = $email; //'duytrinhit@gmail.com';
        $params['name'] = $name; //'doan duy trinh';
        $params['comment'] = $mailmsg; //'test send mail';
        $params['emailto'] = $emailto;
        $params['nameto'] = $nameto;
        $params['mailsubj'] = $mailsubj;
        $mail = new Zend_Mail('utf8');
        $mail->setBodyText($params['comment']);
        $mail->setFrom($params['email'], $params['name']);
        $mail->addTo($params['emailto'], $params['nameto']);
        $mail->setSubject($params['mailsubj']);
        try {
            if($is_smtp == 0) {
                $mail->send();
            } else {
                $mail->send($transport);
            }
        }
        catch(Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email.');

        }
    }

    public function defaultTemplateAction() {
        $id = Mage::app()->getRequest()->getPost('id_template');
        $model = Mage::getModel('xticket/templates')->load($id);
        $this->getResponse()->setBody($model->getData('content'));
    }

    public function defaultCustomerAction() {
        $text = Mage::app()->getRequest()->getParam('q');
        //$limit = Mage::app()->getRequest()->getParam('limit');
        $limit = 20;

        $collection = Mage::getResourceModel('customer/customer_collection')
                ->addEmailFillter($text)
                ->setPageSize($limit);

        $_list = array();
        foreach($collection as $item) {
            $_list[] = $item->getEmail();
        }
        $this->getResponse()->setBody(implode("\n", $_list));
    }

}