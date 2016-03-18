<?php 

/*
 * ***************************************************************
 * Script : To Load Logged in User Notifications
 * Version : 1.0
 * Date :
 * Author : Raman / Sristy
 * Email : raman.katyal@virtuos.com
 * Description : This class is used to count user total notifications and messages.
 * ***************************************************************
 */
class NotificationHeader{
    
   
    function loadMessages(){
        
        
        
        $ci =& get_instance();
        
        
        $session_data = $ci->session->userdata('logged_in');
        $current_user_id = $session_data['user_id'];
        
        $ci->load->model('Notification_model','notification_model');
        
        $msg_data = $ci->notification_model->myMessages($current_user_id);

        MY_Loader::$add_data['top_messages'] = $msg_data;
        
    }
    
    
    function loadNotifications(){
    
           
        $ci=& get_instance();
        
        $session_data = $ci->session->userdata('logged_in');
        $current_user_id = $session_data['user_id'];
    
        $ci->load->model('Notification_model','notification_model');
    
        $msg_data = $ci->notification_model->myNotifications($current_user_id);
        
        MY_Loader::$add_data['top_notification'] = $msg_data;
    
    }
    
    
    function loadTasks(){
    
            
        $ci=& get_instance();
    
        $session_data = $ci->session->userdata('logged_in');
        $current_user_id = $session_data['user_id'];
        
        $ci->load->model('Notification_model','notification_model');
    
        $msg_data = $ci->notification_model->myTasks($current_user_id);
        
        MY_Loader::$add_data['top_tasks'] = $msg_data;
    
    }
    
    function loadActivitys(){
    
            
        $ci=& get_instance();
        
        $session_data = $ci->session->userdata('logged_in');
        $current_user_id = $session_data['user_id'];
    
        $ci->load->model('Notification_model','notification_model');
    
        $msg_data = $ci->notification_model->myMessages($current_user_id);
        
        MY_Loader::$add_data['top_activity'] = $msg_data;
    
    }
    
    function loadMessageCounts(){
        $ci=& get_instance();
        
        $session_data = $ci->session->userdata('logged_in');
        $current_user_id = $session_data['user_id'];
        $ci->load->library('mahana_messaging');
        $message_obj = new Mahana_messaging();
        
        if (!empty($current_user_id)){
            $status = $message_obj->get_msg_count($current_user_id);
            MY_Loader::$add_data['count'] = $status['retval'];
        }
        
    }
    
}
?>