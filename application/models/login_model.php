<?php

	class Login_model extends CI_Model{
		function loginExistingUser(){
			$username = $this->input->post('username');
			$user_password = $this->input->post('user_password');
			date_default_timezone_set('Asia/Calcutta');
			$user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
			
			$query = $this->db->get_where('users',
								 array('username' => $username,
								 	   'user_password' => $user_password));
			if($query->num_rows()==1){
				$this->db->update('users', $user_last_login);
				return $query->result();
			}
			else return false;
		}
	}

/* End of file loginmodel.php */
/* Location: ./application/models/loginmodel.php */
<?php

	class Login_model extends CI_Model{
		function loginExistingUser(){
			$username = $this->input->post('username');
			$user_password = $this->input->post('user_password');
			date_default_timezone_set('Asia/Calcutta');
			$user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
			
			$query = $this->db->get_where('users',
								 array('username' => $username,
								 	   'user_password' => $user_password));
			if($query->num_rows()==1){
				$this->db->update('users', $user_last_login);
				return $query->result();
			}
			else return false;
		}
	}

/* End of file loginmodel.php */
/* Location: ./application/models/loginmodel.php */
