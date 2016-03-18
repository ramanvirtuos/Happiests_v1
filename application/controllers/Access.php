<?php
/*
 * ***************************************************************
 * Script : To validate Employee Login
 * Version : 1.0
 * Date :
 * Author : Raman / Sristy
 * Email : raman.katyal@virtuos.com
 * Description : This class is used to validate user login
 * ***************************************************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//include the facebook.php from libraries directory
require_once APPPATH.'libraries/facebook/facebook.php';

class Access extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->config->load('facebook');
        $this->load->model('User_model','user_model');
    }  
    
    public function index()
    {
        if (is_logged_in()){
            redirect('dashboard/index');
        }else{
            
            $contents['login_url'] = $this->googleplus->loginURL();
            //$this->load->view('welcome_message',$contents);
            $this->load->view('access/login',$contents);
        }
    }
    public function login()
    {
        $contents['login_url'] = $this->googleplus->loginURL();
        //$this->load->view('welcome_message',$contents);
        $this->load->view('access/login',$contents);
    }
    
    /*
     * ***************************************************************
     * Function : Function for Facebook Login
     * Date : 03/03/2016
     * Author : Raman.
     * Email : raman.katyal@virtuos.com
     * ***************************************************************
     */
    
    public function validate() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('access/login');
        }else{
            //redirect('dashboard');
            
            $result = $this->user_model->loginExistingUser();
            if($result){
                foreach($result as $rows){
                    $user_new = $rows->user_new;
                    $sess_array = array('username' => $rows->username,
                        'user_id' => $rows->user_id,
                        'user_access_type' => $rows->user_access_type,
                        'user_first_name' => $rows->user_first_name,
                        'user_middle_name' =>$rows->user_middle_name,
                        'user_last_name' => $rows->user_last_name,
                        'user_status' => $rows->user_status,
                        'user_role' => $rows->user_role,
                        'user_o_email' => $rows->user_o_email,
                        'session_id' => session_id(),
                        'user_photo' => $rows->user_photo,
                        'user_create_date' => $rows->user_create_date,
                        'user_department' => $rows->user_department,
                        'is_facebook' => false
                    );
                    //print_r($sess_array);
                    if($sess_array['user_status'] == "Inactive"){
                        $this->session->set_flashdata('AccountNotActive', 'Your account is not active.');
                        $this->session->unset_userdata('logged_in');
                        redirect('access/login');
                    }
                    $user_first_name = $sess_array['user_first_name'];
                    $user_id = $sess_array['user_id'];
                    date_default_timezone_set('Asia/Calcutta');
                    $this->session->set_userdata('logged_in', $sess_array);
            
                    //fetching IP
                    $ip = file_get_contents('https://api.ipify.org');
                    	
                    $agentString = $this->agent->agent_string();
                    //echo $agentString."<br>";
                    $json_str = file_get_contents('http://www.useragentstring.com/?uas='.urlencode($agentString).'&getJSON=all');
                    $arr=json_decode($json_str);
                    //exit;
                    $browser = $arr->agent_name;
                    $browser .= $arr->agent_version;
                    //echo $browser;
                    	
            
                    $operatingSystem = $arr->os_name;
                    //echo $operatingSystem;
                    	
                    $login_time = date('Y-m-d H:i:s');
                    $create_date = date('Y-m-d H:i:s');
                    $sessionId = $this->session->userdata('session_id');
                    
                    if (empty($sessionId)){
                        $sessionId = session_id();
                    }
                    //new record in attendance table
                    $data=array('user_id'=>$user_id,
                        'in_time'=>$login_time,
                        'ip_address'=>$ip,
                        'browser'=>$browser,
                        'create_date'=>$create_date,
                        'operating_system'=>$operatingSystem,
                        'session_id'=>$sessionId);
                    	
                    //print_r($data);
                    	
                    $this->db->insert('attendance', $data);
                    //echo $this->db->last_query();
                    //exit;
                    if($user_new == 1){
                        //redirect('User/New', 'refresh');
                        redirect('dashboard/index');
                    }
                    else{
                        //redirect('/', 'refresh');
                        redirect('dashboard/index');
                    }
                }
                	
                	
            }
            	
            else if($result == FALSE){
                $this->session->set_flashdata('WrongDetailsUser', 'The Username/Password you entered do not match.');
                redirect('access/login');
            }
        }
    }
    
    /*
     * ***************************************************************
     * Function : Function for Google Plus Login
     * Date : 03/03/2016
     * Author : Raman.
     * Email : raman.katyal@virtuos.com
     * ***************************************************************
     */
    function googlelogin(){
        
        $code_g = $this->input->get('code');
        if (isset($code_g) && !empty($code_g)) {
             
            try{
                $this->googleplus->getAuthenticate();
                //$this->session->set_userdata('login',true);
                //$this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());
                $user_profile = $this->googleplus->getUserInfo();
                if(!empty($user_profile['id'])){
                     
                    $result = $this->user_model->loginGoogleUser($user_profile['id'], $user_profile['email']);
                    if($result){
                        foreach($result as $rows){
                            $user_new = $rows->user_new;
                            $sess_array = array('username' => $rows->username,
                                'user_id' => $rows->user_id,
                                'user_access_type' => $rows->user_access_type,
                                'user_first_name' => $rows->user_first_name,
                                'user_middle_name' =>$rows->user_middle_name,
                                'user_last_name' => $rows->user_last_name,
                                'user_status' => $rows->user_status,
                                'user_role' => $rows->user_role,
                                'user_photo' => $rows->user_photo,
                                'user_o_email' => $rows->user_o_email,
                                'user_create_date' => $rows->user_create_date,
                                'session_id' => session_id(),
                                'user_department' => $rows->user_department,
                                'is_google' => false
                            );
                            //print_r($sess_array);
                            if($sess_array['user_status'] == "Inactive"){
                                $this->session->set_flashdata('AccountNotActive', 'Your account is not active.');
                                $this->session->unset_userdata('logged_in');
                                redirect('access/login');
                            }
                
                            // Update Facebook Information
                
                            $fb_data = array(
                                'google_id' => $user_profile['id'],
                                'user_g_email' => $user_profile['email'],

                            );
                            $this->user_model->update_record('users',$fb_data,'user_id',$rows->user_id);
                
                            ///
                
                            $user_first_name = $sess_array['user_first_name'];
                            $user_id = $sess_array['user_id'];
                            date_default_timezone_set('Asia/Calcutta');
                            $this->session->set_userdata('logged_in', $sess_array);
                
                            //fetching IP
                            $ip = file_get_contents('https://api.ipify.org');
                             
                            $agentString = $this->agent->agent_string();
                            //echo $agentString."<br>";
                            $json_str = file_get_contents('http://www.useragentstring.com/?uas='.urlencode($agentString).'&getJSON=all');
                            $arr=json_decode($json_str);
                            //exit;
                            $browser = $arr->agent_name;
                            $browser .= $arr->agent_version;
                            //echo $browser;
                             
                
                            $operatingSystem = $arr->os_name;
                            //echo $operatingSystem;
                             
                            $login_time = date('Y-m-d H:i:s');
                            $create_date = date('Y-m-d H:i:s');
                            $sessionId = $this->session->userdata('session_id');
                            if (empty($sessionId)){
                                $sessionId = session_id();
                            }
                            //new record in attendance table
                            $data=array('user_id'=>$user_id,
                                'in_time'=>$login_time,
                                'ip_address'=>$ip,
                                'browser'=>$browser,
                                'create_date'=>$create_date,
                                'operating_system'=>$operatingSystem,
                                'session_id'=>$sessionId);
                             
                            //print_r($data);
                             
                            $this->db->insert('attendance', $data);
                            //echo $this->db->last_query();
                            //exit;
                            /*if($user_new == 1){
                             //redirect('User/New', 'refresh');
                             redirect('dashboard');
                             }
                             else{
                             //redirect('/', 'refresh');
                             redirect('dashboard');
                             }*/
                            redirect('dashboard/index');
                        }
                         
                         
                    }
                    else if($result == FALSE){
                        // $this->session->set_flashdata('WrongDetailsUser', 'The Username/Password you entered do not match.');
                        // redirect('access/login');
                         
                        $url = $user_profile['picture'];
                        $data = file_get_contents($url);
                        $documents_filename=$user_profile['id'].'.jpg';
                
                        $filePath =  $_SERVER['DOCUMENT_ROOT']."/uploads/profile/".$documents_filename;
                        $fp = fopen($filePath,"wb");
                        if (!$fp) exit;
                        fwrite($fp, $data);
                        fclose($fp);
                        
                        $username = str_replace(" ", ".", strtolower($user_profile['name']));
                        $username = $this->user_model->checkUsername($username);
                        $userregisterationData = array(
                            'user_first_name' => $user_profile['given_name'],
                            'username' => $username,
                            'user_last_name' => $user_profile['family_name'],
                            'user_p_email' =>   $user_profile['email'],
                            'user_o_email' =>   $user_profile['email'],
                            'user_password' => "12345",
                            'user_access_type' => '3',
                            'user_department' => 'YMWD',
                            'google_id' => $user_profile['id'],
                            'user_g_email' => $user_profile['email'],
                            'user_create_date' => now(),
                            'user_photo' => $documents_filename
                
                            //'user_dob' =>   date('Y-m-d',strtotime($user_profile['birthday']))
                        );
                        $userregisterationData['user_create_date'] =  date('Y-m-d');
                         
                
                        $user_id = $this->user_model->insert_record('users',$userregisterationData);
                
                        /*
                         * Set Facebook User session Data
                         */
                        //print_r($this->session->all_userdata());die;
                
                        $sess_array = array('username' => $userregisterationData['username'],
                            'user_id' => $user_id,
                            'user_access_type' => $userregisterationData['user_access_type'],
                            'user_first_name' => $userregisterationData['user_first_name'],
                            'user_middle_name' =>'',
                            'user_last_name' => $userregisterationData['user_last_name'],
                            'user_status' => 'Active',
                            'user_role' => 'Default',
                            'user_department' => 'YMWD',
                            'user_o_email' => $userregisterationData['user_p_email'],
                            'session_id' => session_id(),
                            'user_create_date' => $userregisterationData['user_create_date'],
                            'user_photo' => $documents_filename,
                            'is_google' => true
                        );
                
                        $this->session->set_userdata('logged_in', $sess_array);
                
                        //fetching IP
                        $ip = file_get_contents('https://api.ipify.org');
                         
                        $agentString = $this->agent->agent_string();
                        //echo $agentString."<br>";
                        $json_str = file_get_contents('http://www.useragentstring.com/?uas='.urlencode($agentString).'&getJSON=all');
                        $arr=json_decode($json_str);
                        //exit;
                        $browser = $arr->agent_name;
                        $browser .= $arr->agent_version;
                        //echo $browser;
                         
                
                        $operatingSystem = $arr->os_name;
                        //echo $operatingSystem;
                         
                        $login_time = date('Y-m-d H:i:s');
                        $create_date = date('Y-m-d H:i:s');
                        $sessionId = $this->session->userdata('session_id');
                        if (empty($sessionId)){
                            $sessionId = session_id();
                        }
                         
                        //new record in attendance table
                        $data=array('user_id'=>$user_id,
                            'in_time'=>$login_time,
                            'ip_address'=>$ip,
                            'browser'=>$browser,
                            'create_date'=>$create_date,
                            'operating_system'=>$operatingSystem,
                            'session_id'=>$sessionId);
                         
                        //print_r($data);
                         
                        $this->db->insert('attendance', $data);
                
                        /*
                         * Send Email to New Facebook User
                         *
                         */
                        // Start - Send Email to New User
                        $config = array(
                
                            'mailtype' => 'html',
                            'charset' => 'utf-8');
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        //$this->email->set_crlf( "\r\n" );
                         
                        $this->load->model('Template_model','template_model');
                        $result_template = $this->template_model->get_template('New User','Active');
                        foreach($result_template as $template_data)
                        {
                            $temp_subj = $template_data->template_subject;
                            $temp_type = $template_data->template_type;
                            $temp_data = $template_data->template_description;
                            $temp_constant = $template_data->template_constant;
                        }
                        //echo "for HR2".$idea_category;
                        $url = base_url();
                        //echo $url;
                        $from_name = ucfirst($userregisterationData['user_first_name']." ".$userregisterationData['user_last_name']);
                        $email = $userregisterationData['user_o_email'];
                        $username =$userregisterationData['username'];
                        $first_name = ucfirst($userregisterationData['user_first_name']);
                        $last_name = ucfirst($userregisterationData['user_last_name']);
                        $user_password = '12345';
                        $date = date('Y');
                        $email_message = str_replace(array('{{PATH}}','{{COMPANY_NAME}}','{{FIRST_NAME}}','{{LAST_NAME}}','{{USER_NAME}}','{{PASSWORD}}','{{CURR_YEAR}}','{{SENDER_NAME}}'),array("$url","Virtuos Solutions","$first_name","$last_name","$username","$user_password","$date","$from_name"),$temp_data);
                        //echo html_entity_decode($email_message);
                        //echo $email_message;
                        //exit;
                        $this->email->from('admin@happiests.com', 'Happiests');
                        $this->email->to($this->input->post('user_o_email'));
                        $this->email->subject('Virtuos - Portal Account Created');
                        $this->email->message($email_message);
                         
                        if($this->email->send()){
                            $this->session->set_flashdata('UserAccountCreated', 'User account has been created and email sent.');
                            redirect('dashboard/index');
                        }
                
                
                
                    }
                }else{
                    $this->session->set_flashdata('WrongDetailsUser', 'Some issue with GOOGLE SDK. Please try again!');
                    $this->load->view('access/login');
                }
                redirect('dashboard/index');
            }catch (apiAuthException $e) {
                error_log($e);
                print_r($e);
                $user = NULL;
            }
             
        }
    }
    
    /*
     * ***************************************************************
     * Function : Function for Facebook Login
     * Date : 03/03/2016
     * Author : Raman.
     * Email : raman.katyal@virtuos.com
     * ***************************************************************
     */
    
    function fblogin(){
        $base_url=$this->config->item('base_url'); //Read the baseurl from the config.php file
        //get the Facebook appId and app secret from facebook.php which located in config directory for the creating the object for Facebook class
        $facebook = new Facebook(array(
            'appId'		=>  $this->config->item('appID'),
            'secret'	=> $this->config->item('appSecret'),
        ));
    
        $user = $facebook->getUser(); // Get the facebook user id
        
        if($user){
            	
            try{
                $user_profile = $facebook->api('/me',array('fields' => 'id,email,name,first_name,last_name,gender,link','birthday'));  //Get the facebook user profile data
    
                $params = array('next' => $base_url.'access/logout');
                
                //print_r($user_profile);  die;
                $ses_user=array('User'=>$user_profile,
                    'logout' =>$facebook->getLogoutUrl($params)   //generating the logout url for facebook
                );
               
                /*
                 * 
                 * Validate if Already Registered with Given EMail and username
                 */
                //$result = $this->user_model->loginExistingUser();
                 if(!empty($user_profile['id'])){
                       
                    $result = $this->user_model->loginFacbookUser($user_profile['id'], $user_profile['email']);
                    if($result){
                        foreach($result as $rows){
                            $user_new = $rows->user_new;
                            $sess_array = array('username' => $rows->username,
                                'user_id' => $rows->user_id,
                                'user_access_type' => $rows->user_access_type,
                                'user_first_name' => $rows->user_first_name,
                                'user_middle_name' =>$rows->user_middle_name,
                                'user_last_name' => $rows->user_last_name,
                                'user_status' => $rows->user_status,
                                'user_role' => $rows->user_role,
                                'user_department' => $rows->user_department,
                                'user_photo' => $rows->user_photo,
                                'user_create_date' => $rows->user_create_date,
                                'user_o_email' => $rows->user_o_email,
                                'session_id' => session_id(),
                                'is_facebook' => false
                            );
                            //print_r($sess_array);
                            if($sess_array['user_status'] == "Inactive"){
                                $this->session->set_flashdata('AccountNotActive', 'Your account is not active.');
                                $this->session->unset_userdata('logged_in');
                                redirect('access/login');
                            }
                            
                            // Update Facebook Information
                            
                            $fb_data = array(
                                'fb_user_id' => $user_profile['id'],
                                'user_f_email' => $user_profile['email'],
                                'fb_profile_link' => $user_profile['link'],
                                'user_gender' =>   $user_profile['gender']
                            );
                            $this->user_model->update_record('users',$fb_data,'user_id',$rows->user_id);
                            
                            ///
                            
                            $user_first_name = $sess_array['user_first_name'];
                            $user_id = $sess_array['user_id'];
                            date_default_timezone_set('Asia/Calcutta');
                            $this->session->set_userdata('logged_in', $sess_array);
                    
                            //fetching IP
                            $ip = file_get_contents('https://api.ipify.org');
                             
                            $agentString = $this->agent->agent_string();
                            //echo $agentString."<br>";
                            $json_str = file_get_contents('http://www.useragentstring.com/?uas='.urlencode($agentString).'&getJSON=all');
                            $arr=json_decode($json_str);
                            //exit;
                            $browser = $arr->agent_name;
                            $browser .= $arr->agent_version;
                            //echo $browser;
                             
                    
                            $operatingSystem = $arr->os_name;
                            //echo $operatingSystem;
                             
                            $login_time = date('Y-m-d H:i:s');
                            $create_date = date('Y-m-d H:i:s');
                            $sessionId = $this->session->userdata('session_id');
                            if (empty($sessionId)){
                                $sessionId = session_id();
                            }
                            //new record in attendance table
                            $data=array('user_id'=>$user_id,
                                'in_time'=>$login_time,
                                'ip_address'=>$ip,
                                'browser'=>$browser,
                                'create_date'=>$create_date,
                                'operating_system'=>$operatingSystem,
                                'session_id'=>$sessionId);
                             
                            //print_r($data);
                             
                            $this->db->insert('attendance', $data);
                            //echo $this->db->last_query();
                            //exit;
                            /*if($user_new == 1){
                                //redirect('User/New', 'refresh');
                                redirect('dashboard');
                            }
                            else{
                                //redirect('/', 'refresh');
                                redirect('dashboard');
                            }*/
                            redirect('dashboard/index');
                        }
                         
                         
                    }
                    else if($result == FALSE){
                       // $this->session->set_flashdata('WrongDetailsUser', 'The Username/Password you entered do not match.');
                       // redirect('access/login');
                       
                        $url = "https://graph.facebook.com/".$user_profile['id']."/picture?width=350&height=500";
                        $data = file_get_contents($url);
                        $documents_filename=$user_profile['id'].'.jpg';
                        
                        $filePath =  $_SERVER['DOCUMENT_ROOT']."/uploads/profile/".$documents_filename;
                        $fp = fopen($filePath,"wb");
                        if (!$fp) exit;
                        fwrite($fp, $data);
                        fclose($fp);
                        $username = str_replace(" ", ".", strtolower($user_profile['name']));
                        $username = $this->user_model->checkUsername($username);
                        $userregisterationData = array(
                            'user_first_name' => $user_profile['first_name'],
                            'username' => $username,
                            'user_last_name' => $user_profile['last_name'],
                            'user_p_email' =>   $user_profile['email'],
                            'user_o_email' =>   $user_profile['email'],
                            'user_gender' =>   $user_profile['gender'],
                            'user_password' => "12345",
                            'user_access_type' => '3',
                            'user_department' => 'YMWD',
                            'user_create_date' => now(),
                            'fb_user_id' => $user_profile['id'],
                            'user_f_email' => $user_profile['email'],
                            'fb_profile_link' => $user_profile['link'],
                            'user_photo' => $documents_filename
                            
                            //'user_dob' =>   date('Y-m-d',strtotime($user_profile['birthday']))
                            );
                        $userregisterationData['user_create_date'] =  date('Y-m-d');
                        	
                        
                        $user_id = $this->user_model->insert_record('users',$userregisterationData);
                        
                        /*
                         * Set Facebook User session Data
                         */
                        //print_r($this->session->all_userdata());die;
                        
                        $sess_array = array('username' => $userregisterationData['username'],
                            'user_id' => $user_id,
                            'user_access_type' => $userregisterationData['user_access_type'],
                            'user_first_name' => $userregisterationData['user_first_name'],
                            'user_middle_name' =>'',
                            'user_last_name' => $userregisterationData['user_last_name'],
                            'user_status' => 'Active',
                            'user_role' => 'Default',
                            'user_o_email' => $userregisterationData['user_p_email'],
                            'user_create_date' => $userregisterationData['user_create_date'],
                            'session_id' => session_id(),
                            'user_department' => 'YMWD',
                            'is_facebook' => true
                        );
                        
                        $this->session->set_userdata('logged_in', $sess_array);
                        
                        //fetching IP
                        $ip = file_get_contents('https://api.ipify.org');
                         
                        $agentString = $this->agent->agent_string();
                        //echo $agentString."<br>";
                        $json_str = file_get_contents('http://www.useragentstring.com/?uas='.urlencode($agentString).'&getJSON=all');
                        $arr=json_decode($json_str);
                        //exit;
                        $browser = $arr->agent_name;
                        $browser .= $arr->agent_version;
                        //echo $browser;
                         
                        
                        $operatingSystem = $arr->os_name;
                        //echo $operatingSystem;
                         
                        $login_time = date('Y-m-d H:i:s');
                        $create_date = date('Y-m-d H:i:s');
                        $sessionId = $this->session->userdata('session_id');
                        if (empty($sessionId)){
                            $sessionId = session_id();
                        }
                         
                        //new record in attendance table
                        $data=array('user_id'=>$user_id,
                            'in_time'=>$login_time,
                            'ip_address'=>$ip,
                            'browser'=>$browser,
                            'create_date'=>$create_date,
                            'operating_system'=>$operatingSystem,
                            'session_id'=>$sessionId);
                         
                        //print_r($data);
                         
                        $this->db->insert('attendance', $data);
                        
                        /*
                         * Send Email to New Facebook User
                         * 
                         */
                        // Start - Send Email to New User
                        $config = array(
                            
                            'mailtype' => 'html',
                            'charset' => 'utf-8');
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        //$this->email->set_crlf( "\r\n" );
                        	
                        $this->load->model('Template_model','template_model');
                        $result_template = $this->template_model->get_template('New User','Active');
                        foreach($result_template as $template_data)
                        {
                            $temp_subj = $template_data->template_subject;
                            $temp_type = $template_data->template_type;
                            $temp_data = $template_data->template_description;
                            $temp_constant = $template_data->template_constant;
                        }
                        //echo "for HR2".$idea_category;
                        $url = base_url();
                        //echo $url;
                        $from_name = ucfirst($userregisterationData['user_first_name']." ".$userregisterationData['user_last_name']);
                        $email = $userregisterationData['user_o_email'];
                        $username =$userregisterationData['username'];
                        $first_name = ucfirst($userregisterationData['user_first_name']);
                        $last_name = ucfirst($userregisterationData['user_last_name']);
                        $user_password = '12345';
                        $date = date('Y');
                        $email_message = str_replace(array('{{PATH}}','{{COMPANY_NAME}}','{{FIRST_NAME}}','{{LAST_NAME}}','{{USER_NAME}}','{{PASSWORD}}','{{CURR_YEAR}}','{{SENDER_NAME}}'),array("$url","Virtuos Solutions","$first_name","$last_name","$username","$user_password","$date","$from_name"),$temp_data);
                        //echo html_entity_decode($email_message);
                        //echo $email_message;
                        //exit;
                        $this->email->from('admin@happiests.com', 'Happiests');
                        $this->email->to($this->input->post('user_o_email'));
                        $this->email->subject('Virtuos - Portal Account Created');
                        $this->email->message($email_message);
                       
                        if($this->email->send()){
                            $this->session->set_flashdata('UserAccountCreated', 'User account has been created and email sent.');
                            redirect('dashboard/index');
                        }
                        
                        
                        
                    }
                }else{
                    $this->session->set_flashdata('WrongDetailsUser', 'Some issue with Facebook SDK. Please try again!');
                    $this->load->view('access/login');
                }
                
            }catch(FacebookApiException $e){
                error_log($e);
                //print_r($e);
                $user = NULL;
            }
        }
        redirect('dashboard/index');
    }
    
    /*
     * ***************************************************************
     * Function : Function for Change Password Login via Facebook
     * Date : 03/03/2016
     * Author : Raman.
     * Email : raman.katyal@virtuos.com
     * ***************************************************************
     */
    
    function changefacebookpassword(){
        //echo "good";
        $this->load->view('access/changefacebookpassword');
    }
    
    
    /*
     * ***************************************************************
     * Function : Function for LOGOUT
     * Date : 03/03/2016
     * Author : Raman.
     * Email : raman.katyal@virtuos.com
     * ***************************************************************
     */
    
    public function logout(){
        //ob_start();
        $login_time= "";
        $date = "";
        date_default_timezone_set('Asia/Calcutta');
        //$str = "logout Date-Time: ";
        //$str.= date("Y-m-d H:i:s").PHP_EOL;
        
        
        $session_data = $this->session->userdata('logged_in');
        $user_first_name = $session_data['user_first_name'];
        $user_id = $session_data['user_id'];
        $sessionId = $this->session->userdata('session_id');
        $logout = date('Y-m-d H:i:s');
        $in=$this->db->query("Select * from attendance where user_id=$user_id");
        foreach($in->result() as $in_time)
        {
            $login_time = $in_time->in_time;
            $date=$in_time->create_date;
            $sessionId=$in_time->session_id;
        }
        //echo $login_time."<br>";
    
        $logout_time = date('Y-m-d H:i:s');
        //echo $logout_time."<br>";
        $difference=$this->calculate_datediff($logout_time,$login_time); 
        if($difference < 9){ ?>
    			<script>
    				var r = confirm("You have not completed 9hours. Are you sure you want to logout?");
    				if (r == true){
    					//ok
    					window.location="<?php echo base_url(); ?>access/logout_force";
    				} 
    				else{
    					//close
    					window.location="<?php echo base_url(); ?>dashboard/index";
    				}
    		</script>
    		<?php }
    		else{
    			$time_spent=$this->short($logout_time,$login_time);
    			/*echo "time spent in office:".$time_spent."<br>";*/
    			$time_spent1=strtotime($time_spent);
    			//echo "Time spent in strtotime:".$time_spent1."<br>";
    			$time_spent1=date('H:i:s',$time_spent1);
    			//echo "<br>";
    			//echo "time spent in office:".$time_spent."<br>";
    			$total_hours="09:00:00";
    			$shortfall = "";
    			if($total_hours > $time_spent){
    				$shortfall =$this->short($total_hours,$time_spent);
    			}
    			else {
    				$excess_hours=$this->short($time_spent,$total_hours);
    			}
    				
    			//echo "Shortfall:".$shortfall."<br>";	
    			$shortfall1=strtotime($shortfall)."<br>";
    			/*echo "Shortfall in strtotime:".$shortfall1."<br>";*/
    			$shortfall1=date('H:i:s',strtotime($shortfall));
    			$data=array('out_time'=>$logout,
    			'attendance_shortfall'=>$shortfall1,
    			'total_hours'=>$time_spent1,
    			'excess_hours'=>$excess_hours
    				  );
    				  //print_r($data);
    				  //exit;
    			$this->db->where(array('user_id'=>$user_id,'session_id'=>$sessionId,'create_date'=>$date));
    			$this->db->update('attendance',$data);
    			
    			$this->session->unset_userdata('logged_in');
    			 
    			//error_reporting(E_ERROR);
    			$this->session->sess_destroy();
    			redirect('access/login', 'refresh');
    		}
    	} // index()
    	
    	
    	public function short($date2,$date1)
    	{
    		$date2=strtotime($date2);
    		$date1=strtotime($date1);
    		$dateDiff = $date2 - $date1;
    		$dateDiff = abs($dateDiff);
    		$fullDays = floor($dateDiff/(60*60*24));
    		$fullHours = floor(($dateDiff-($fullDays*60*60*24))/(60*60));
    		$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);
    		$ret = "$fullHours:$fullMinutes:00";
    		return $ret;
    		
    	} // short()
    	
    	public function calculate_datediff($date2,$date1){
    		$date2=strtotime($date2);
    		$date1=strtotime($date1);
    		$dateDiff = $date2 - $date1;
    		$dateDiff = abs($dateDiff);
    		$fullDays = floor($dateDiff/(60*60*24));
    		$fullHours = floor(($dateDiff-($fullDays*60*60*24))/(60*60));
    		$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);
    		//$ret = " ago";
    		$ret='';
    	   
    		/*if($fullMinutes!=""){
    			$ret = $fullMinutes." mins".$ret;
    		}*/
    		if($fullHours!=""){
    			//$ret = $fullHours." hours".$ret;
    			$ret = $fullHours.$ret;
    		}
    		/*if($fullDays!=""){
    			$ret =  $fullDays." days, ".$ret;
    		}*/
    		if($ret!=" ago"){
    			return $ret;
    		}
    	} // calculate_datediff()
    	
    	
    	public function logout_force(){
    	    
    	    date_default_timezone_set('Asia/Calcutta');
    	    //$str = "logout Date-Time: ";
    	    //$str.= date("Y-m-d H:i:s").PHP_EOL;
    	    $session_data = $this->session->userdata('logged_in');
    	    $user_first_name = $session_data['user_first_name'];
    	    $user_id = $session_data['user_id'];
    	    $sessionId = $this->session->userdata('session_id');
    	    $logout = date('Y-m-d H:i:s');
    	    $in=$this->db->query("Select * from attendance where user_id=$user_id");
    	    foreach($in->result() as $in_time)
    	    {
    	        $login_time = $in_time->in_time;
    	        $date=$in_time->create_date;
    	        $sessionId=$in_time->session_id;
    	    }
    	    //echo $login_time."<br>";
    	    //echo "Login time:".$login_time."<br>";
    	    $logout_time = date('Y-m-d H:i:s');
    	    //echo $logout_time."<br>";
    	    $difference=$this->calculate_datediff($logout_time,$login_time);
    	
    	    $time_spent=$this->short($logout_time,$login_time);
    	    /*echo "time spent in office:".$time_spent."<br>";*/
    	    $time_spent1=strtotime($time_spent);
    	    //echo "Time spent in strtotime:".$time_spent1."<br>";
    	    $time_spent1=date('H:i:s',$time_spent1);
    	    //echo "time spent in office:".$time_spent."<br>";
    	    $total_hours="09:00:00";
    	    if($total_hours > $time_spent){
    	        $shortfall=$this->short($total_hours,$time_spent);
    	    }
    	    else
    	    {
    	        $shortfall=$this->short($time_spent,$total_hours);
    	    }
    	    	
    	    //echo "Shortfall:".$shortfall."<br>";
    	    $shortfall1=strtotime($shortfall)."<br>";
    	    /*echo "Shortfall in strtotime:".$shortfall1."<br>";*/
    	    $shortfall1=date('H:i:s',strtotime($shortfall));
    	
    	    //exit;
    	    $data=array('out_time'=>$logout,
    	        'attendance_shortfall'=>$shortfall1,
    	        'total_hours'=>$time_spent1
    	    );
    	    //print_r($data);
    	    //exit;
    	    $this->db->where(array('user_id'=>$user_id,'session_id'=>$sessionId,'create_date'=>$date));
    	    $this->db->update('attendance',$data);
    	    
    	    $this->session->unset_userdata('logged_in');
    	    //end all session
    	   // session_destroy();
    	    $this->session->sess_destroy();
    	
    	    redirect('access/login', 'refresh');
    	}
    
}
