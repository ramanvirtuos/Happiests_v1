<?php 
class my404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        
        $session_data = $this->session->userdata('logged_in');
        
        $this->load->view('design/header',$session_data);
        $this->load->view('errors/html/error_404');
        $this->load->view('design/footer');
        //$this->output->set_status_header('404'); 
       // $data['content'] = 'error_404'; // View name 
        //$this->load->view('index',$data);//loading in my template 
    } 
} 
?> 