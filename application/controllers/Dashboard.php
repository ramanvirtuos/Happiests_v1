<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

/**
 * Description of Dashboard
 *
 * @author Pudyasto
 */
class Dashboard extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        //$this->clear_cache();
        //$this->output->cache(10);
        $this->load->helper('time');
        
        if (!is_logged_in()){
            $this->clear_cache();
            redirect('access/login');
        }
    }    
    
    public function index() {        
        
        
        $session_data = $this->session->userdata('logged_in');
        $session_data['page'] = 'Dashboard';
        /*$this->load->view('design/header',$session_data);
        $this->load->view('dashboard/admin');
        $this->load->view('design/footer');*/
        $this->load->template('dashboard/admin', $session_data);
        
    }
    
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    
}
