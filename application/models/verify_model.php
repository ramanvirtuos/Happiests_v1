<?php

	class Verify_model extends CI_Model{
		function loginUser(){
			$verification_number= $this->input->post('verification_number');
			$employee_ID = $this->input->post('employee_id');
			//date_default_timezone_set('Asia/Calcutta');
			//$user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
			
			$query = $this->db->get_where('verification_detail',
								 array('verification_number' => $verification_number,
								 	   'employee_id' => $employee_ID
									   ));
			if($query->num_rows() > 0 ){
				$query1=$this->db->get_where('users',array('user_id'=>$employee_ID));
				return $query1->result();
			}
			else return false;
		}
	}

/* End of file Verify_model.php */
/* Location: ./application/models/loginModel.php */<?php

	class Verify_model extends CI_Model{
		function loginUser(){
			$verification_number= $this->input->post('verification_number');
			$employee_ID = $this->input->post('employee_id');
			//date_default_timezone_set('Asia/Calcutta');
			//$user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
			
			$query = $this->db->get_where('verification_detail',
								 array('verification_number' => $verification_number,
								 	   'employee_id' => $employee_ID
									   ));
			if($query->num_rows() > 0 ){
				$query1=$this->db->get_where('users',array('user_id'=>$employee_ID));
				return $query1->result();
			}
			else return false;
		}
	}

/* End of file Verify_model.php */
/* Location: ./application/models/loginModel.php */