<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			if(($this->uri->segment(1) == "User") && ($this->uri->segment(2) == "New")){
				$user_details = $this->db->get_where('users', array('user_id' => $session_data['user_id']));
				foreach($user_details->result() as $row){
					$session_data['row'] = $row;
				}
				$this->load->view('register_Self', $session_data);
			}
			else if($session_data['user_access_type'] == '1'){
				$this->load->view('register', $session_data);
			}
			else redirect('/');
		 }
		 else{
			redirect('/');
			exit;
		}
	}
	
	public function CheckSession(){
		if(!($this->session->userdata('logged_in'))){
			redirect('/');
			exit;
		}
	}
	
	function Self(){ // When a new user fills details for the first time
	    $this->CheckSession();
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('logged_in');
		
		$emp_id = $session_data['user_id'];
		$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
		if(strlen($this->input->post('user_middle_name'))){
			$this->form_validation->set_rules('user_middle_name', 'Middle Name', 'trim|required');
		}
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('user_p_email', 'Personal Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('user_p_mobile', 'Personal Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('user_pan', 'PAN', 'trim|required');
		$this->form_validation->set_rules('user_blood_group', 'Blood Group', 'callback_check_Dropdown');
        $this->form_validation->set_rules('user_emergency_mobile', 'Emergency Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_emergency_contact_type', 'Contact Relation', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_address', 'Permanent Address', 'trim|required');
		$this->form_validation->set_rules('user_p_state', 'Permanent State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_city', 'Permanent City', 'callback_check_Dropdown');
		//$this->form_validation->set_rules('user_p_zip', 'Permanent Zip', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_address', 'Current Address', 'trim|required');
		$this->form_validation->set_rules('user_t_state', 'Current State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_city', 'Current City', 'callback_check_Dropdown');
		//$this->form_validation->set_rules('user_t_zip', 'Current Zip', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_number', 'Bank Account Number', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_holder', 'Bank Account Holder  Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_address', 'Main Branch Address', 'trim|required');
		$this->form_validation->set_rules('user_bank_ifsc', 'IFSC Code', 'trim|required');
		
		if($this->form_validation->run() == FALSE){	// If Validations fail, reload page
			$session_data = $this->session->userdata('logged_in');
			$this->load->view('register_Self', $session_data);
		}
		else{
			$userregisterationData = array(
							'user_first_name' => $this->input->post('user_first_name'),
							'user_middle_name' => $this->input->post('user_middle_name'),
							'user_last_name' => $this->input->post('user_last_name'),
							'user_p_email' => $this->input->post('user_p_email'),
							'user_p_mobile' => $this->input->post('user_p_mobile'),
							'user_dob' => $this->input->post('user_dob'),
							'user_pan' => $this->input->post('user_pan'),
							'user_blood_group' => $this->input->post('user_blood_group'),
							'user_emergency_contact_type' => $this->input->post('user_emergency_contact_type'),
							'user_emergency_mobile' => $this->input->post('user_emergency_mobile'),
							'user_p_address' => $this->input->post('user_p_address'),
							'user_p_state' => $this->input->post('user_p_state'),
							'user_p_city' => $this->input->post('user_p_city'),
							//'user_p_zip' => $this->input->post('user_p_zip'),
							'user_t_address' => $this->input->post('user_t_address'),
							'user_t_state' => $this->input->post('user_t_state'),
							'user_t_city' => $this->input->post('user_t_city'),
							//'user_t_zip' => $this->input->post('user_t_zip'),
							'user_marital_status' => $this->input->post('user_marital_status'),
					        'user_hobbies'=> $this->input->post('user_hobbies'),
							'user_bank_name' => $this->input->post('user_bank_name'),
							'user_bank_account_number' => $this->input->post('user_bank_account_number'),
							'user_bank_account_holder' => $this->input->post('user_bank_account_holder'),
							'user_bank_address' => $this->input->post('user_bank_address'),
							'user_bank_ifsc' => $this->input->post('user_bank_ifsc'),
							'user_new' => '0');
							/*$config['upload_path']='./uploads/profile/';
							$config['upload_path']= $_SERVER['DOCUMENT_ROOT'].'/uploads/profile/';
		$path = $config['upload_path']; 
		$config['allowed_types']= '*';
		$this->load->library('upload',$config);
		if(isset($_FILES['user_photo']['name']) and strlen($_FILES['user_photo']['name'])){
			$file_name=$_FILES['user_photo']['name'];
				$arr=explode(".",$file_name);
				$documents_filename=$arr[0]."_".$emp_id.'.'.$arr[1];
				$config['file_name']= $documents_filename;
				if ( ! @copy($_FILES['user_photo']['tmp_name'], $config['upload_path'].$documents_filename)) {
					if ( ! @move_uploaded_file($_FILES['user_photo']['tmp_name'], $config['upload_path'].$this->$documents_filename))
					{
						//$this->set_error('upload_destination_error');
						echo "error uploading";
						return FALSE;
					}
				}*/
		if(count($_FILES['user_photo']['name']) > 0){
		    $tmpFilePath = $_FILES['user_photo']['name'];
			//echo $tmpFilePath;
			//exit;
            
			//Make sure we have a filepath
            if($tmpFilePath != ""){
                //save the filename
				$shortname ="";
                $shortname = $_FILES['user_photo']['name'];
                $arr=explode(".",$shortname);
				$documents_filename=$arr[0]."_".$emp_id.'.'.$arr[1];
				//echo $documents_filename;
				//exit;
				//save the url and the file
                $filePath =  $_SERVER['DOCUMENT_ROOT']."/uploads/profile/".$documents_filename;
				echo $filePath;
				exit;
				
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $documents_filename;
                }else{
					echo "Not Uploaded"; exit;
				}//move_uploaded_file ends here	
		    } //tmpFilePath ends here
		}		 
				//echo $documents_filename;
			/*if(!$this->upload->do_upload('user_photo')){
				
				$error=array('error'=> $this->upload->display_errors());
				$this->load->view('register_Self',$error);
			}
			$upload_data=$this->upload->data();
			
			$userregisterationData['user_photo']= $upload_data['raw_name'].$upload_data['file_ext'];
		}*/
		$userregisterationData['user_photo']= $documents_filename;	
			$session_data = $this->session->userdata('logged_in');
				//print_r($userregisterationData);
				//exit;
			//$this->db->update('users', $userregisterationData, array('user_id' => $session_data['user_id']));
			$this->user_model->update_record('users',$userregisterationData,'user_id',$session_data['user_id']);
			/*echo $this->db->last_query();
			exit;*/
			//if($this->db->affected_rows() > 0){
				//echo  $this->db->affected_rows();
				//exit;
				if(strlen($shortname)){
					$session_data['user_photo']=$documents_filename;
					$this->session->set_userdata('logged_in',$session_data);
				}
				
				redirect('home');
			//}
		}
		}
	
	
	function registerNewUser(){
		$this->CheckSession();
		$session_data = $this->session->userdata('logged_in');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[4]|max_length[32]|is_unique[users.username]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('user_o_email', 'Official Email', 'trim|required|xss_clean|valid_email|is_unique[users.user_o_email]');
		/*$this->form_validation->set_rules('user_p_email', 'Personal Email', 'trim|required|xss_clean|valid_email|is_unique[users.user_p_email]');
		$this->form_validation->set_rules('user_p_mobile', 'Personal Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_o_mobile', 'Official Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_pan', 'PAN', 'trim|required');
		$this->form_validation->set_rules('user_landline_number', 'Landline Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_extension_number', 'Extension Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('user_blood_group', 'Blood Group', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_emergency_mobile', 'Emergency Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_emergency_contact_type', 'Contact Relation', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('user_department', 'Department', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_e_code', 'employee Code', 'trim|required');
		$this->form_validation->set_rules('user_date_of_joining', 'Date of Joining', 'trim|required');
		$this->form_validation->set_rules('user_p_address', 'Permanent Address', 'trim|required');
		$this->form_validation->set_rules('user_p_state', 'Permanent State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_city', 'Permanent City', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_address', 'Current Address', 'trim|required');
		$this->form_validation->set_rules('user_t_state', 'Current State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_city', 'Current City', 'callback_check_Dropdown');
		if($this->input->post('user_access_type') != '1'){
			$this->form_validation->set_rules('managers_dropdown', 'Manager', 'callback_check_Dropdown');
		}
		$this->form_validation->set_rules('user_role', 'User Role', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_type', 'User Type', 'callback_check_Radio');
		$this->form_validation->set_rules('user_marital_status', 'Marital Status', 'callback_check_Radio');
		$this->form_validation->set_rules('user_work_location', 'Work Location', 'callback_check_Radio');
		$this->form_validation->set_rules('user_access_type', 'Access Type', 'callback_check_Radio');
		$this->form_validation->set_rules('user_status', 'User Status', 'callback_check_Radio');
		$this->form_validation->set_rules('user_bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_number', 'Bank Account Number', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_holder', 'Bank Account Holder  Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_address', 'Main Branch Address', 'trim|required');
		$this->form_validation->set_rules('user_bank_ifsc', 'IFSC Code', 'trim|required');*/
		
		if($this->form_validation->run() == FALSE){	// If Validations fail, reload page
			$session_data = $this->session->userdata('logged_in');
			$this->load->view('register', $session_data);
		}
		else{
			//echo "<pre>";
			//print_r($_POST);
		    //exit;
			$user_dob=($this->input->post('user_dob')=='1970-01-01' or $this->input->post('user_dob')== '') ? date('Y-m-d') : $this->input->post('user_dob');
			$user_date_of_joining=($this->input->post('user_date_of_joining')=='1970-01-01' or $this->input->post('user_date_of_joining')== '') ? date('Y-m-d') : $this->input->post('user_date_of_joining');
			
			$type=$this->input->post('user_type');
			$det=$this->db->query("Select * from leaves_count where employee_type='$type'");
			$row="";
			foreach($det->result() as $row)
			{
				$row->CL;
				$row->SL;
				$row->CCL;
				$row->RH;
			}
			$casual=$row->CL;
			$sick=$row->SL;
			$congrats=$row->CCL;
			$restricted=$row->RH;
			
			$userregisterationData = array(
							'user_first_name' => $this->input->post('user_first_name'),
							'user_middle_name' => $this->input->post('user_middle_name'),
							'user_last_name' => $this->input->post('user_last_name'),
							'user_o_email' => $this->input->post('user_o_email'),
							'user_p_email' => $this->input->post('user_p_email'),
							'username' => $this->input->post('username'),
							'user_password' => $this->input->post('user_password'),
							'user_p_mobile' => $this->input->post('user_p_mobile'),
							'user_o_mobile' => $this->input->post('user_o_mobile'),
							'user_landline_number' => $this->input->post('user_landline_number'),
							'user_extension_number' => $this->input->post('user_extension_number'),
							'user_dob' => $user_dob,
							'user_pan' => $this->input->post('user_pan'),
							'user_blood_group' => $this->input->post('user_blood_group'),
							'user_emergency_mobile' => $this->input->post('user_emergency_mobile'),
							'user_emergency_contact_type' => ($this->input->post('user_emergency_contact_type')) ? $this->input->post('user_emergency_contact_type') : 'Others',
							'user_marital_status' => ($this->input->post('user_marital_status')=="Single" ? $this->input->post('user_marital_status') : 'Married') ,
							'user_status' => $this->input->post('user_status'),
							'user_designation' => $this->input->post('user_designation'),
							'user_department' => $this->input->post('user_department'),
							'user_e_code' => $this->input->post('user_e_code'),
							'user_date_of_joining' => $user_date_of_joining,
							'user_p_address' => $this->input->post('user_p_address'),
							'user_p_state' => $this->input->post('user_p_state'),
							'user_p_city' => $this->input->post('user_p_city'),
							'user_p_zip' => $this->input->post('user_p_zip'),
							'user_t_address' => $this->input->post('user_t_address'),
							'user_t_state' => $this->input->post('user_t_state'),
							'user_t_city' => $this->input->post('user_t_city'),
							'user_t_zip' => $this->input->post('user_t_zip'),
							'manager_id' => $this->input->post('managers_dropdown'),
							'user_role' => $this->input->post('user_role'),
							'user_type' => $this->input->post('user_type'),
							'user_work_location' => $this->input->post('user_work_location'),
							'user_access_type' => $this->input->post('user_access_type'),
							'user_bank_name' => $this->input->post('user_bank_name'),
							'user_bank_account_number' => $this->input->post('user_bank_account_number'),
							'user_bank_account_holder' => $this->input->post('user_bank_account_holder'),
							'user_bank_address' => $this->input->post('user_bank_address'),
							'user_bank_ifsc' => $this->input->post('user_bank_ifsc'),
							'user_remaining_cl'=>$casual,
							'user_remaining_ccl'=>$congrats,
							'user_remaining_sl'=>$sick,
							'user_remaining_rh'=>$restricted,
							'user_new' => '1'
							);
				
			$userregisterationData['user_create_date'] =  date('Y-m-d');
			
			/*echo "<pre>";
			print_r($userregisterationData);
			echo "</pre>";
		*/
			//$this->db->insert('users',$userregisterationData);
			$this->user_model->insert_record('users',$userregisterationData);
			//echo $this->db->last_query();
			//exit;
			
			// Start - Send Email to New User
			$config = array(
					/*'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'gs.saini@virtuos.com',
					'smtp_pass' => 'Rightnow!GS',
					'smtp_timeout' => '6',*/
					'mailtype' => 'html',
					'charset' => 'utf-8');
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			//$this->email->set_crlf( "\r\n" );			
			$this->email->from($session_data['user_o_email'], $session_data['user_first_name']." ".$session_data['user_middle_name']." ".$session_data['user_last_name']);
			$this->email->to($this->input->post('user_o_email'));
			$this->email->subject('Virtuos - Portal Account Created');
			$data = array(
						'heading' => 'Virtous - Employee Portal Account Created',
						'user_first_name' => $this->input->post('user_first_name'),
						'username' => $this->input->post('username'),
						'user_password' => $this->input->post('user_password'),
						'email_type' => 'New Account Created');
			$this->email->message($this->load->view('New_Request_Email', $data, true));
			if($this->email->send()){
				$this->session->set_flashdata('UserAccountCreated', 'User account has been created and email sent.');
				redirect('employees');	
			}
			else show_error($this->email->print_debugger());
			// End - Send Email to New User
			
			
		}
	}//Function registerNewUser Ends
	
	public function check_Dropdown($str){
		if($str == ""){
			$this->form_validation->set_message('check_Dropdown', 'Please choose a type.');
			return FALSE;
		}
		else return TRUE;
	}
	
	public function check_Radio($str){
		if($str == ""){
			$this->form_validation->set_message('check_Radio', 'Please select one.');
			return FALSE;
		}
		else return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			if(($this->uri->segment(1) == "User") && ($this->uri->segment(2) == "New")){
				$user_details = $this->db->get_where('users', array('user_id' => $session_data['user_id']));
				foreach($user_details->result() as $row){
					$session_data['row'] = $row;
				}
				$this->load->view('register_Self', $session_data);
			}
			else if($session_data['user_access_type'] == '1'){
				$this->load->view('register', $session_data);
			}
			else redirect('/');
		 }
		 else{
			redirect('/');
			exit;
		}
	}
	
	public function CheckSession(){
		if(!($this->session->userdata('logged_in'))){
			redirect('/');
			exit;
		}
	}
	
	function Self(){ // When a new user fills details for the first time
	    $this->CheckSession();
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('logged_in');
		
		$emp_id = $session_data['user_id'];
		$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
		if(strlen($this->input->post('user_middle_name'))){
			$this->form_validation->set_rules('user_middle_name', 'Middle Name', 'trim|required');
		}
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('user_p_email', 'Personal Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('user_p_mobile', 'Personal Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('user_pan', 'PAN', 'trim|required');
		$this->form_validation->set_rules('user_blood_group', 'Blood Group', 'callback_check_Dropdown');
        $this->form_validation->set_rules('user_emergency_mobile', 'Emergency Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_emergency_contact_type', 'Contact Relation', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_address', 'Permanent Address', 'trim|required');
		$this->form_validation->set_rules('user_p_state', 'Permanent State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_city', 'Permanent City', 'callback_check_Dropdown');
		//$this->form_validation->set_rules('user_p_zip', 'Permanent Zip', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_address', 'Current Address', 'trim|required');
		$this->form_validation->set_rules('user_t_state', 'Current State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_city', 'Current City', 'callback_check_Dropdown');
		//$this->form_validation->set_rules('user_t_zip', 'Current Zip', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_number', 'Bank Account Number', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_holder', 'Bank Account Holder  Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_address', 'Main Branch Address', 'trim|required');
		$this->form_validation->set_rules('user_bank_ifsc', 'IFSC Code', 'trim|required');
		
		if($this->form_validation->run() == FALSE){	// If Validations fail, reload page
			$session_data = $this->session->userdata('logged_in');
			$this->load->view('register_Self', $session_data);
		}
		else{
			$userregisterationData = array(
							'user_first_name' => $this->input->post('user_first_name'),
							'user_middle_name' => $this->input->post('user_middle_name'),
							'user_last_name' => $this->input->post('user_last_name'),
							'user_p_email' => $this->input->post('user_p_email'),
							'user_p_mobile' => $this->input->post('user_p_mobile'),
							'user_dob' => $this->input->post('user_dob'),
							'user_pan' => $this->input->post('user_pan'),
							'user_blood_group' => $this->input->post('user_blood_group'),
							'user_emergency_contact_type' => $this->input->post('user_emergency_contact_type'),
							'user_emergency_mobile' => $this->input->post('user_emergency_mobile'),
							'user_p_address' => $this->input->post('user_p_address'),
							'user_p_state' => $this->input->post('user_p_state'),
							'user_p_city' => $this->input->post('user_p_city'),
							//'user_p_zip' => $this->input->post('user_p_zip'),
							'user_t_address' => $this->input->post('user_t_address'),
							'user_t_state' => $this->input->post('user_t_state'),
							'user_t_city' => $this->input->post('user_t_city'),
							//'user_t_zip' => $this->input->post('user_t_zip'),
							'user_marital_status' => $this->input->post('user_marital_status'),
					        'user_hobbies'=> $this->input->post('user_hobbies'),
							'user_bank_name' => $this->input->post('user_bank_name'),
							'user_bank_account_number' => $this->input->post('user_bank_account_number'),
							'user_bank_account_holder' => $this->input->post('user_bank_account_holder'),
							'user_bank_address' => $this->input->post('user_bank_address'),
							'user_bank_ifsc' => $this->input->post('user_bank_ifsc'),
							'user_new' => '0');
							/*$config['upload_path']='./uploads/profile/';
							$config['upload_path']= $_SERVER['DOCUMENT_ROOT'].'/uploads/profile/';
		$path = $config['upload_path']; 
		$config['allowed_types']= '*';
		$this->load->library('upload',$config);
		if(isset($_FILES['user_photo']['name']) and strlen($_FILES['user_photo']['name'])){
			$file_name=$_FILES['user_photo']['name'];
				$arr=explode(".",$file_name);
				$documents_filename=$arr[0]."_".$emp_id.'.'.$arr[1];
				$config['file_name']= $documents_filename;
				if ( ! @copy($_FILES['user_photo']['tmp_name'], $config['upload_path'].$documents_filename)) {
					if ( ! @move_uploaded_file($_FILES['user_photo']['tmp_name'], $config['upload_path'].$this->$documents_filename))
					{
						//$this->set_error('upload_destination_error');
						echo "error uploading";
						return FALSE;
					}
				}*/
		if(count($_FILES['user_photo']['name']) > 0){
		    $tmpFilePath = $_FILES['user_photo']['name'];
			//echo $tmpFilePath;
			//exit;
            
			//Make sure we have a filepath
            if($tmpFilePath != ""){
                //save the filename
				$shortname ="";
                $shortname = $_FILES['user_photo']['name'];
                $arr=explode(".",$shortname);
				$documents_filename=$arr[0]."_".$emp_id.'.'.$arr[1];
				//echo $documents_filename;
				//exit;
				//save the url and the file
                $filePath =  $_SERVER['DOCUMENT_ROOT']."/uploads/profile/".$documents_filename;
				echo $filePath;
				exit;
				
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $documents_filename;
                }else{
					echo "Not Uploaded"; exit;
				}//move_uploaded_file ends here	
		    } //tmpFilePath ends here
		}		 
				//echo $documents_filename;
			/*if(!$this->upload->do_upload('user_photo')){
				
				$error=array('error'=> $this->upload->display_errors());
				$this->load->view('register_Self',$error);
			}
			$upload_data=$this->upload->data();
			
			$userregisterationData['user_photo']= $upload_data['raw_name'].$upload_data['file_ext'];
		}*/
		$userregisterationData['user_photo']= $documents_filename;	
			$session_data = $this->session->userdata('logged_in');
				//print_r($userregisterationData);
				//exit;
			//$this->db->update('users', $userregisterationData, array('user_id' => $session_data['user_id']));
			$this->user_model->update_record('users',$userregisterationData,'user_id',$session_data['user_id']);
			/*echo $this->db->last_query();
			exit;*/
			//if($this->db->affected_rows() > 0){
				//echo  $this->db->affected_rows();
				//exit;
				if(strlen($shortname)){
					$session_data['user_photo']=$documents_filename;
					$this->session->set_userdata('logged_in',$session_data);
				}
				
				redirect('home');
			//}
		}
		}
	
	
	function registerNewUser(){
		$this->CheckSession();
		$session_data = $this->session->userdata('logged_in');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[4]|max_length[32]|is_unique[users.username]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('user_o_email', 'Official Email', 'trim|required|xss_clean|valid_email|is_unique[users.user_o_email]');
		/*$this->form_validation->set_rules('user_p_email', 'Personal Email', 'trim|required|xss_clean|valid_email|is_unique[users.user_p_email]');
		$this->form_validation->set_rules('user_p_mobile', 'Personal Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_o_mobile', 'Official Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_pan', 'PAN', 'trim|required');
		$this->form_validation->set_rules('user_landline_number', 'Landline Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_extension_number', 'Extension Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('user_blood_group', 'Blood Group', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_emergency_mobile', 'Emergency Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('user_emergency_contact_type', 'Contact Relation', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('user_department', 'Department', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_e_code', 'employee Code', 'trim|required');
		$this->form_validation->set_rules('user_date_of_joining', 'Date of Joining', 'trim|required');
		$this->form_validation->set_rules('user_p_address', 'Permanent Address', 'trim|required');
		$this->form_validation->set_rules('user_p_state', 'Permanent State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_p_city', 'Permanent City', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_address', 'Current Address', 'trim|required');
		$this->form_validation->set_rules('user_t_state', 'Current State', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_t_city', 'Current City', 'callback_check_Dropdown');
		if($this->input->post('user_access_type') != '1'){
			$this->form_validation->set_rules('managers_dropdown', 'Manager', 'callback_check_Dropdown');
		}
		$this->form_validation->set_rules('user_role', 'User Role', 'callback_check_Dropdown');
		$this->form_validation->set_rules('user_type', 'User Type', 'callback_check_Radio');
		$this->form_validation->set_rules('user_marital_status', 'Marital Status', 'callback_check_Radio');
		$this->form_validation->set_rules('user_work_location', 'Work Location', 'callback_check_Radio');
		$this->form_validation->set_rules('user_access_type', 'Access Type', 'callback_check_Radio');
		$this->form_validation->set_rules('user_status', 'User Status', 'callback_check_Radio');
		$this->form_validation->set_rules('user_bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_number', 'Bank Account Number', 'trim|required');
		$this->form_validation->set_rules('user_bank_account_holder', 'Bank Account Holder  Name', 'trim|required');
		$this->form_validation->set_rules('user_bank_address', 'Main Branch Address', 'trim|required');
		$this->form_validation->set_rules('user_bank_ifsc', 'IFSC Code', 'trim|required');*/
		
		if($this->form_validation->run() == FALSE){	// If Validations fail, reload page
			$session_data = $this->session->userdata('logged_in');
			$this->load->view('register', $session_data);
		}
		else{
			//echo "<pre>";
			//print_r($_POST);
		    //exit;
			$user_dob=($this->input->post('user_dob')=='1970-01-01' or $this->input->post('user_dob')== '') ? date('Y-m-d') : $this->input->post('user_dob');
			$user_date_of_joining=($this->input->post('user_date_of_joining')=='1970-01-01' or $this->input->post('user_date_of_joining')== '') ? date('Y-m-d') : $this->input->post('user_date_of_joining');
			
			$type=$this->input->post('user_type');
			$det=$this->db->query("Select * from leaves_count where employee_type='$type'");
			$row="";
			foreach($det->result() as $row)
			{
				$row->CL;
				$row->SL;
				$row->CCL;
				$row->RH;
			}
			$casual=$row->CL;
			$sick=$row->SL;
			$congrats=$row->CCL;
			$restricted=$row->RH;
			
			$userregisterationData = array(
							'user_first_name' => $this->input->post('user_first_name'),
							'user_middle_name' => $this->input->post('user_middle_name'),
							'user_last_name' => $this->input->post('user_last_name'),
							'user_o_email' => $this->input->post('user_o_email'),
							'user_p_email' => $this->input->post('user_p_email'),
							'username' => $this->input->post('username'),
							'user_password' => $this->input->post('user_password'),
							'user_p_mobile' => $this->input->post('user_p_mobile'),
							'user_o_mobile' => $this->input->post('user_o_mobile'),
							'user_landline_number' => $this->input->post('user_landline_number'),
							'user_extension_number' => $this->input->post('user_extension_number'),
							'user_dob' => $user_dob,
							'user_pan' => $this->input->post('user_pan'),
							'user_blood_group' => $this->input->post('user_blood_group'),
							'user_emergency_mobile' => $this->input->post('user_emergency_mobile'),
							'user_emergency_contact_type' => ($this->input->post('user_emergency_contact_type')) ? $this->input->post('user_emergency_contact_type') : 'Others',
							'user_marital_status' => ($this->input->post('user_marital_status')=="Single" ? $this->input->post('user_marital_status') : 'Married') ,
							'user_status' => $this->input->post('user_status'),
							'user_designation' => $this->input->post('user_designation'),
							'user_department' => $this->input->post('user_department'),
							'user_e_code' => $this->input->post('user_e_code'),
							'user_date_of_joining' => $user_date_of_joining,
							'user_p_address' => $this->input->post('user_p_address'),
							'user_p_state' => $this->input->post('user_p_state'),
							'user_p_city' => $this->input->post('user_p_city'),
							'user_p_zip' => $this->input->post('user_p_zip'),
							'user_t_address' => $this->input->post('user_t_address'),
							'user_t_state' => $this->input->post('user_t_state'),
							'user_t_city' => $this->input->post('user_t_city'),
							'user_t_zip' => $this->input->post('user_t_zip'),
							'manager_id' => $this->input->post('managers_dropdown'),
							'user_role' => $this->input->post('user_role'),
							'user_type' => $this->input->post('user_type'),
							'user_work_location' => $this->input->post('user_work_location'),
							'user_access_type' => $this->input->post('user_access_type'),
							'user_bank_name' => $this->input->post('user_bank_name'),
							'user_bank_account_number' => $this->input->post('user_bank_account_number'),
							'user_bank_account_holder' => $this->input->post('user_bank_account_holder'),
							'user_bank_address' => $this->input->post('user_bank_address'),
							'user_bank_ifsc' => $this->input->post('user_bank_ifsc'),
							'user_remaining_cl'=>$casual,
							'user_remaining_ccl'=>$congrats,
							'user_remaining_sl'=>$sick,
							'user_remaining_rh'=>$restricted,
							'user_new' => '1'
							);
				
			$userregisterationData['user_create_date'] =  date('Y-m-d');
			
			/*echo "<pre>";
			print_r($userregisterationData);
			echo "</pre>";
		*/
			//$this->db->insert('users',$userregisterationData);
			$this->user_model->insert_record('users',$userregisterationData);
			//echo $this->db->last_query();
			//exit;
			
			// Start - Send Email to New User
			$config = array(
					/*'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'gs.saini@virtuos.com',
					'smtp_pass' => 'Rightnow!GS',
					'smtp_timeout' => '6',*/
					'mailtype' => 'html',
					'charset' => 'utf-8');
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			//$this->email->set_crlf( "\r\n" );			
			$this->email->from($session_data['user_o_email'], $session_data['user_first_name']." ".$session_data['user_middle_name']." ".$session_data['user_last_name']);
			$this->email->to($this->input->post('user_o_email'));
			$this->email->subject('Virtuos - Portal Account Created');
			$data = array(
						'heading' => 'Virtous - Employee Portal Account Created',
						'user_first_name' => $this->input->post('user_first_name'),
						'username' => $this->input->post('username'),
						'user_password' => $this->input->post('user_password'),
						'email_type' => 'New Account Created');
			$this->email->message($this->load->view('New_Request_Email', $data, true));
			if($this->email->send()){
				$this->session->set_flashdata('UserAccountCreated', 'User account has been created and email sent.');
				redirect('employees');	
			}
			else show_error($this->email->print_debugger());
			// End - Send Email to New User
			
			
		}
	}//Function registerNewUser Ends
	
	public function check_Dropdown($str){
		if($str == ""){
			$this->form_validation->set_message('check_Dropdown', 'Please choose a type.');
			return FALSE;
		}
		else return TRUE;
	}
	
	public function check_Radio($str){
		if($str == ""){
			$this->form_validation->set_message('check_Radio', 'Please select one.');
			return FALSE;
		}
		else return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */