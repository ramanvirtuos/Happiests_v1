<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

    //put your code here
    public function __construct()
    {
        parent::__construct();
        //$this->clear_cache();
        //$this->output->cache(10);
        if (!is_logged_in()){
            $this->clear_cache();
            redirect('access/login');
        }
    }
    
    /*
     * 
     */
	
	function checkForUpdates(){
		$this->CheckSession();
		$session_data = $this->session->userdata('logged_in');
		$user_id = $session_data['user_id'];
		$sql = "SELECT * from notifications WHERE notification_audience LIKE '%<".$user_id.">%'";
		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$notification_type = array();
			$notification_type = $row->notification_type;
			$notification_message = array(); 
			$notification_message = $row->notification_message;
		}
		echo json_encode(array('total_notifications' => $query->num_rows,
							   'notification_type' => $notification_type,
							   'notification_message' => $notification_message));
		exit();
	}
}

/* End of file notifications.php */
/* Location: ./application/controllers/notifications.php */