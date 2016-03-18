<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script : Message Send/Receive Script
 * Version : 
 * Date :
 * Author : Raman.
 * Email : raman.katyal@virtuos.com
 * Description : 
 * ***************************************************************
 */

/**
 * Description of Message
 *
 * @author Raman
 */
class Messages extends CI_Controller{
    //put your code here
    public function __construct()
    {
        
        parent::__construct();
        //$this->clear_cache();
        //$this->output->cache(10);
        $this->load->helper('time');
        $this->load->helper(array('form', 'url'));
        $this->load->library('mahana_messaging');
        
        if (!is_logged_in()){
            $this->clear_cache();
            redirect('access/login');
        }
    }    
    
    /*
     *  List All Messages 
     */
    public function index() {        
        
        
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        $this->load->library('pagination');
        
        $message_obj = new Mahana_messaging();
        
        $status = $message_obj->get_msg_count($session_data['user_id']);
         $session_data['count'] = $status['retval'];
        
        /*
         * Get logged in user message thread
         */
        
        $total = $message_obj->get_total_msg_count($session_data['user_id']);
        
       
        $session_data['total_records'] = $total['retval'];
        
        $limilt_per_page = 15;
        $offset = 0;
        $session_data['offset'] = $offset + 1;
        $session_data['limit_page'] = $limilt_per_page;
        
        $result = $message_obj->get_all_receive_threads($session_data['user_id'],TRUE,'DESC',$limilt_per_page,$offset);
        
        
      //print_r($result); die;
        $message_inbox = array();
        foreach ($result['retval'] as $inbox){
            $attachment_array = $message_obj->get_msg_attachment($inbox['thread_id'], $inbox['sender_id']);
            $message_inbox[] = array_merge($inbox,$attachment_array);
        }
        $session_data['inbox'] = $message_inbox;
        /*
        $this->load->view('design/header',$session_data);
        $this->load->view('message/mailbox');
        $this->load->view('design/footer');*/
                
        $this->load->template('message/mailbox', $session_data);
        
    }
    
    
    /*
     *  List All Sent Messages
     */
    public function sentmail() {
    
    
        $session_data = $this->session->userdata('logged_in');
    
        $session_data['page'] = 'Message';
    
        $this->load->library('pagination');
    
        $message_obj = new Mahana_messaging();
        
        $total_messages = $message_obj->get_all_sent_threads($session_data['user_id'],TRUE,'DESC'); 
        $status = $message_obj->get_msg_count($session_data['user_id']);
        $session_data['count'] = ($status['retval']);
    
        /*
         * Get logged in user message thread
         */
    
        $total = count($total_messages['retval']);
    
         
        $session_data['total_records'] = $total;
        //$session_data['count'] = ($status['retval']);
    
        $limilt_per_page = 15;
        $offset = 0;
        $session_data['offset'] = $offset + 1;
        $session_data['limit_page'] = $limilt_per_page;
    
        //$result = $message_obj->get_all_receive_threads($session_data['user_id'],TRUE,'DESC',$limilt_per_page,$offset);
    
    
        //print_r($result); die;
        $message_inbox = array();
        foreach ($total_messages['retval'] as $inbox){
            $attachment_array = $message_obj->get_msg_attachment($inbox['thread_id'], $inbox['user_id']);
            $message_inbox[] = array_merge($inbox,$attachment_array);
        }
        $session_data['inbox'] = $message_inbox;
        /*
         $this->load->view('design/header',$session_data);
         $this->load->view('message/mailbox');
         $this->load->view('design/footer');*/
    
        $this->load->template('message/sent-mail', $session_data);
    
    }
    
    
    
    /*
     * AJAX DATA LOAD 
     */
    
    function ajaxPaginationData()
    {
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
    
        //total rows count
        $totalRec = count($this->post->getRows());
    
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
    
        $this->ajax_pagination->initialize($config);
    
        //get the posts data
        $data['posts'] = $this->post->getRows(array('start'=>$offset,'limit'=>$this->perPage));
    
        //load the view
        $this->load->view('posts/ajax-pagination-data', $data, false);
    }
    
    /*
     * Compose New Message
     */
    
    public function compose(){
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        
        $message_obj = new Mahana_messaging();
        
        $status = $message_obj->get_msg_count($session_data['user_id']);
        $session_data['count'] = $status['retval'];
        
        /*$this->load->view('design/header',$session_data);
        $this->load->view('message/compose');
        $this->load->view('design/footer');*/
        $this->load->template('message/compose', $session_data);
    }
    
    
    /*
     *  Send Message To Multiple Recipients
     */
    
    function sendMessage(){
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        $this->form_validation->set_rules('send_to', 'Send To', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('compose-textarea', 'Message', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->template('message/compose', $session_data);
            
        } else {
          //$this->load->view('formsuccess');
          
            $send_id = explode(",",$this->input->post('send_to'));
            $sendEmail = $this->input->post('sendEmail');
            $subject = $this->input->post('subject');
            $upload_images = explode(",",$this->input->post('upload_images'));
            unset($upload_images[0]);
            $message = $this->input->post('compose-textarea');
            $priority = $this->input->post('priority');
            $message_obj = new Mahana_messaging();
            $thread_id = $message_obj->send_new_message($session_data['user_id'],$sendEmail,$subject,$message,$priority,$upload_images);
            if(!$thread_id['err'])
                $thread_id = $thread_id['retval']; 
            else{
                $this->session->set_flashdata('MessageSend', 'Message Error.');
                redirect('messages/index');
            }
                
            //print_r($sendEmail);
            //print_r($upload_images);
            //die;
            //print_r($send_id);die;
            
            /*
             * Send Notification
             */
            $this->load->model('Notification_model','notification_model');
            $notification_audience = '';
            for($i=0;$i<count($sendEmail);$i++){
                //exit;
                $notification_audience .= " <".$sendEmail[$i]."> "; 
                // For storing user ids in notification audience like <1> <2> and so on.
            }
            $this->load->model("Message_model","message_model");
            $msg_id = $this->message_model->_get_message_by_thread_id($thread_id,$session_data['user_id']);
                $notification_data = array('notification_audience' => $notification_audience,
                    'notification_message' => "<i style='font-size:17px;' class='fa fa-envelope'></i>".substr($message,0,25),
                    'notification_type' => 'Message',
                    'notification_type_id' => $msg_id,
                    'sender_id' => $session_data['user_id'],
                    'notification_create_time' => date('Y-m-d H:i:s'));
                //$this->db->insert('notifications', $notification_data);
                $this->notification_model->insert_record('notifications',$notification_data);
            //}
            
            $this->session->set_flashdata('MessageSend', 'Message Sent Successfully to Recipients.');
            redirect('messages/sentmail');
        }
        
        
    }
    
    
    
    /*
     *  Send Message To Multiple Recipients
     */
    
    function replyMessage(){
    
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    
        $session_data = $this->session->userdata('logged_in');
    
        $session_data['page'] = 'Message';
    
        $this->form_validation->set_rules('send_to', 'Send To', 'required');
       // $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('reply-textarea', 'Message', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->template('message/replyMessages', $session_data);
    
        } else {
            //$this->load->view('formsuccess');
    
            $message_id = $this->input->post('message_id');
            $reply_recipient = $this->input->post('reply_to_id');
            $send_id = explode(",",$this->input->post('send_to'));
            $sendEmail = $this->input->post('sendEmail');
            $subject = $this->input->post('subject');
            $upload_images = explode(",",$this->input->post('upload_images'));
            unset($upload_images[0]);
            $message = $this->input->post('reply-textarea');
            $priority = $this->input->post('priority');
            $message_obj = new Mahana_messaging();
            $participant = $this->input->post('all_participant');
            //print_r($upload_images);
            $sendEmail[0] = $reply_recipient;
            //print_r($sendEmail); die;
            
            $new_msg_id = $message_obj->reply_to_message($message_id,$session_data['user_id'],$sendEmail,$message,$priority,$upload_images,$participant);
            if(!$new_msg_id['err'])
                $new_msg_id = $new_msg_id['retval'];
                else{
                    $this->session->set_flashdata('MessageSend', 'Message Error.');
                    redirect('messages/index');
                }
    
                //print_r($sendEmail);
                //print_r($upload_images);
                //die;
                //print_r($send_id);die;
    
                /*
                 * Send Notification
                 */
                $this->load->model('Notification_model','notification_model');
                $notification_audience = '';
                $this->load->model("Message_model","message_model");
                if($participant){
                    
                    $thread_id = $this->message_model->_get_thread_id_from_message($new_msg_id);
                    $all_participant = $this->message_model->_get_thread_participants($thread_id,$session_data['user_id']);
                    foreach ($all_participant as $recipient)
                    {
                        //$statuses[] = array('message_id' => $msg_id, 'user_id' => $recipient['user_id'], 'status' => MSG_STATUS_UNREAD);
                        $sendEmail[] = $recipient['user_id'];
                    }
                }
                $sendEmail = array_unique($sendEmail);
                for($i=0;$i<count($sendEmail);$i++){
                    //exit;
                    $notification_audience .= " <".$sendEmail[$i]."> ";
                    // For storing user ids in notification audience like <1> <2> and so on.
                }
                $this->load->model("Message_model","message_model");
                //$msg_id = $this->message_model->_get_message_by_thread_id($thread_id,$session_data['user_id']);
                $notification_data = array('notification_audience' => $notification_audience,
                    'notification_message' => "<i style='font-size:17px;' class='fa fa-envelope'></i>".substr($message,0,25),
                    'notification_type' => 'Message',
                    'notification_type_id' => $new_msg_id,
                    'sender_id' => $session_data['user_id'],
                    'notification_create_time' => date('Y-m-d H:i:s'));
                //$this->db->insert('notifications', $notification_data);
                $this->notification_model->insert_record('notifications',$notification_data);
                //}
    
                $this->session->set_flashdata('MessageSend', 'Message Sent Successfully to Recipients.');
                redirect('messages/sentmail');
        }
    
    
    }
    
    
    
    /*
     *  Read Full Message
     */
    
    public function read($message_id,$receiver_id = NULL){
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        
        $message_obj = new Mahana_messaging();
     
     if(!empty($message_id)){
         if(is_null($receiver_id)){
            $message_data = $message_obj->get_message($message_id, $session_data['user_id']);
            $receiver_id = $message_data['retval'][0]['sender_id'];
         }else{
             $message_data = $message_obj->get_message($message_id, $receiver_id);
             
         }
       
       if($message_data['msg'] == 'Success'){
           $attachment_record = $message_obj->get_message_attachment($message_id);
           
           if($attachment_record['code'] == 'MSG_SUCCESS' && !empty($attachment_record['retval'])){
               $message_data['attachment'] = $attachment_record['retval'];
           }
           
           $session_data['message_detail'] = $message_data['retval'][0];
           if (!empty($message_data['attachment'])){
            $session_data['attachment'] = $message_data['attachment'];
           }
           
           $session_data['message_detail']['reply_id'] = $receiver_id;
         // print_r($session_data); die;
            
           $message_obj->update_message_status($message_id, $session_data['user_id'], MSG_STATUS_READ);
           
            $status = $message_obj->get_msg_count($session_data['user_id']);
            $session_data['count'] = $status['retval'];
            
            /*$this->load->view('design/header',$session_data);
            $this->load->view('message/compose');
            $this->load->view('design/footer');*/
            //$session_data['full_message'] = $message_data;
            
            $this->load->model('Notification_model','notification_model');
            
            $this->notification_model->updateNotificationStatus('Message',$message_id,$session_data['user_id']);
            //redirect('messages/index');
            
       }else{
           $this->session->set_flashdata('MessageError', 'You are not authorize to view this message.');
           redirect('messages/index');
       }
     }else{
           $this->session->set_flashdata('MessageError', 'You are not authorize to view this message.');
           redirect('messages/index');
       }
        $this->load->template('message/read-mail', $session_data);
        
    }
    
    
    /*
     *  Get JSON data for Users Email 
     */
    
    function getComplexData($user_id){
        
        $this->load->model('User_model','user_model');
        $users_array = $this->user_model->getActiveUsers($user_id);
        $return_users = array();
        $i = 0;
        foreach ($users_array as $row){
            
            $i++;
            if ($row->user_photo != '' && $row->user_photo != 'null'){
                $user_photo = $row->user_photo;
            }else{
                $user_photo = 'User_No-Frame.png';
            }
            $return_users[] = array("id" => $row->user_id,
                                    "guid" => "3cd80004-6866-4134-b5c0-206848122854",
                                    "isActive" => true,
                                    'name' => $row->name,
                                    'user_photos' => $user_photo,
                                    'email'     => $row->user_o_email
            );
        }
        echo (json_encode($return_users)); exit;
       // $jdata = json_encode($users_array);
        
       //return $jdata;
       
       //exit;
        
    }
    
    /*
     * 
     * File Upload Batch
     */
    
    function UploadBatchFile($uid){
        // ...
        // SERVER CODE that processes ajax upload and returns a JSON response. Your server action
        // must return a json object containing initialPreview, initialPreviewConfig, & append.
        // An example for PHP Server code is mentioned below.
        // ...
        // upload.php
        // 'images' refers to your file input name attribute
        if (empty($_FILES['userfile'])) {
            echo json_encode(['error'=>'No files found for upload.']);
            // or you can throw an exception
            return; // terminate
        }
        
        $p1 = $p2 = [];
        $paths = array();
        $files = $_FILES;
        $config['upload_path'] = './uploads/messages/temp/';
        $config['upload_url'] = base_url()."uploads/messages/temp/";
        $config['allowed_types'] = 'gif|jpg|png|txt|doc|pdf';
        $config['max_size']	= '10024';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload');
        
        $count_total = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $count_total; $i++) {
            $j = $i + 1;
            
            $name = $files['userfile']['name'][$i];
            
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];
            
            
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
            
                $success = false;
                break;
            }
            else
            {
                $paths[] = array('name' => $name,);
            
                $success = true;
            }
            $key = $name;
            $url = base_url()."messages/deleteUploadFile/$key";
            $p1[$i] = "<img style='height:160px' src='".base_url()."uploads/messages/temp/{$key}' class='file-preview-image'>";
            $p2[$i] = ['caption' => "$name-{$j}.jpg", 'width' => '120px', 'url' => $url, 'key' => $key];
        }
        
        
        echo json_encode([
            'initialPreview' => $p1,
            'initialPreviewConfig' => $p2,
            'extra' => $paths,
            'append' => true // whether to append these configurations to initialPreview.
            // if set to false it will overwrite initial preview
            // if set to true it will append to initial preview
            // if this propery not set or passed, it will default to true.
        ]);
        
        exit;
        
        /*
        // check and process based on successful status
        if ($success === true) {
            // call the function to save all data to database
            // code for the following function `save_data` is not
            // mentioned in this example
            //save_data($userid, $username, $paths);
        
            // store a successful response (default at least an empty array). You
            // could return any additional response info you need to the plugin for
            // advanced implementations.
            $output = [];
            // for example you can get the list of files uploaded this way
            // $output = ['uploaded' => $paths];
            
            echo json_encode([
                'initialPreview' => $p1,
                'initialPreviewConfig' => $p2,
                'append' => true // whether to append these configurations to initialPreview.
                // if set to false it will overwrite initial preview
                // if set to true it will append to initial preview
                // if this propery not set or passed, it will default to true.
            ]);
        } elseif ($success === false) {
            $output = ['error'=>'Error while uploading images. Contact the system administrator'];
            // delete any uploaded files
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No files were processed.'];
        }*/
        
        
    }
    
    
    /*
     * Reply TO Message
     * 
     */
    
    function replymail($reply_to_id,$msg_id){
        
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        
        $message_obj = new Mahana_messaging();
      
        if(!empty($reply_to_id) && !empty($msg_id)){
            
        
        $status = $message_obj->get_msg_count($session_data['user_id']);
        $session_data['count'] = $status['retval'];
        
        /*$this->load->view('design/header',$session_data);
         $this->load->view('message/compose');
         $this->load->view('design/footer');*/
         $message_data = $message_obj->get_message($msg_id, $reply_to_id);
         
            $attachment_record = $message_obj->get_message_attachment($msg_id);
           
           if($attachment_record['code'] == 'MSG_SUCCESS' && !empty($attachment_record['retval'])){
               $message_data['attachment'] = $attachment_record['retval'];
           }
           
           $session_data['message_detail'] = $message_data['retval'][0];
           $session_data['message_detail']['reply_id'] = $reply_to_id;
           if (!empty($message_data['attachment'])){
            $session_data['attachment'] = $message_data['attachment'];
           }
        //print_r($message_data); die;
        
        $this->load->template('message/reply-mail', $session_data);
        }else{
            $this->session->set_flashdata('MessageError', 'You are not authorize to Reply this message.');
            redirect('messages/index');
        }
        
    }
    
    
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    
    
    /*
     *  Delete Single or Multiple Messages
     */
    
    function deleteMessage(){
        
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        
        $message_obj = new Mahana_messaging();
        
        $delete_record = $this->input->post('del_id');
        
       // print_r($delete_record); die;
        $this->load->model('Message_model','message_model');
        
        if (!empty($delete_record)){
            //$user_id = $this->input->post('pid');
            foreach($delete_record as $del_id){
                
                list($message_id, $user_id) = explode("_",$del_id);
               $thread_id =  $this->message_model->_get_thread_id_from_message($message_id);
                if(!empty($message_id)){
                    //$message_obj->_update_msg_statuses($message_id,$user_id);
                    //$message_obj->remove_participant($thread_id,$user_id);
                    $this->message_model->remove_sent_msg($message_id,$session_data['user_id'],$user_id);
                }
                            
            }
            $this->session->set_flashdata('MessageSend', 'Selected Message Moved to Trash.');
            redirect('messages/index');
        }else{
            $this->session->set_flashdata('MessageError', 'Please select atleast one message to delete.');
            redirect('messages/index');
        }
        
    }
    
    
    /*
     * 
     * Trash Message
     * 
     */
    
    function trash(){
        $session_data = $this->session->userdata('logged_in');
        
        $session_data['page'] = 'Message';
        
        $this->load->library('pagination');
        
        $message_obj = new Mahana_messaging();
        
        $status = $message_obj->get_msg_count($session_data['user_id']);
        $session_data['count'] = $status['retval'];
        
        $total_messages = $message_obj->get_all_sent_threads($session_data['user_id'],TRUE,'DESC');

        
        /*
         * Get logged in user message thread
         */
        
        $total_r = count($total_messages['retval']);
        
         
        $session_data['total_records'] = $total_r;
        
        /*
         * Get logged in user message thread
         */
        
        $total = $message_obj->get_total_msg_count($session_data['user_id']);
        
         
        $session_data['total_records'] = $total['retval'];
        
        $limilt_per_page = 15;
        $offset = 0;
        $session_data['offset'] = $offset + 1;
        $session_data['limit_page'] = $limilt_per_page;
        
        $result = $message_obj->get_all_receive_threads($session_data['user_id'],TRUE,'DESC',$limilt_per_page,$offset);
        
        
        //print_r($result); die;
        $message_inbox = array();
        foreach ($result['retval'] as $inbox){
            $attachment_array = $message_obj->get_msg_attachment($inbox['thread_id'], $inbox['sender_id']);
            $message_inbox[] = array_merge($inbox,$attachment_array);
        }
        $session_data['inbox'] = $message_inbox;
        /*
         $this->load->view('design/header',$session_data);
         $this->load->view('message/mailbox');
         $this->load->view('design/footer');*/
        
        $this->load->template('message/trash', $session_data);
    }
    
    /*
     * Function to Download Mail File
     */
    
    function downloadfile($name){
        
        $this->load->helper('download');
        $filepath = "./uploads/messages/".$name;
        $data = file_get_contents($filepath);
        force_download($name, $data);
        
    }
    
}
