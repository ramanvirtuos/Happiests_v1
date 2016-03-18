<?php
class User_model extends CI_Model{
	public function insert_record($tablename,$DataRecord){
		if(isset($DataRecord)){
			$q=$this->db->insert("$tablename",$DataRecord);
			return $this->db->insert_id();
		}
		}
		
	public function update_record($tablename,$DataRecord,$where_val,$id){
		if(isset($DataRecord)){
			$this->db->where($where_val,$id);
			$q=$this->db->update("$tablename", $DataRecord);
		}
	}
	public function delete_record($tablename,$where_val,$id){
		if(isset($id)){
			$this->db->where($where_val,$id);
			$q=$this->db->get("$tablename");
			if($q->num_rows()>0){
				$this->db->where($where_val,$id);
				$q=$this->db->delete("$tablename");
				return true;	
			}
			else{
				return false;
			}
		}
	}
	/*
	 * 
	 */
	public function get_record($sql){
        $query="";
        if(isset($sql)){
            $query= $this->db->query($sql);
        }
        return $query;
    }
    /*
     * 
     */
    public function loginExistingUser($username = NULL, $user_password = NULL){
        
        if ($username == NULL)
            $username = $this->security->xss_clean($this->input->post('username'));
        if ($user_password == NULL)
            $user_password = $this->security->xss_clean($this->input->post('user_password'));
        
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
    /*
     * 
     */
    public function loginFacbookUser($userid = NULL, $user_email = NULL){
    
        if ($userid == NULL || $user_email == NULL)
            return false;
        else{
            
                date_default_timezone_set('Asia/Calcutta');
                $user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
                 
                $this->db->where('user_o_email', $user_email);
                $this->db->or_where('user_p_email', $user_email);
                $query = $this->db->get('users');
                /*$query = $this->db->get_where('users',
                    array('user_o_email' => $user_email ));*/
                    if($query->num_rows()==1){
                        $this->db->update('users', $user_last_login);
                        return $query->result();
                    }
                    else return false;
            }
    }
    /*
     * 
     */
    public function loginGoogleUser($userid = NULL, $user_email = NULL){
        
        if ($userid == NULL || $user_email == NULL)
            return false;
            else{
        
                date_default_timezone_set('Asia/Calcutta');
                $user_last_login = array('user_last_login' => date('Y-m-d H:i:s'));
                 
                $this->db->where('user_o_email', $user_email);
                $this->db->or_where('user_p_email', $user_email);
                $query = $this->db->get('users');
                if($query->num_rows()==1){
                    $this->db->update('users', $user_last_login);
                    return $query->result();
                }
                else return false;
            }
        
    }
    /*
     * 
     */
    public function checkUsername($username){
        
        $query = $this->db->get_where('users',
            array('username' => $username));
            if($query->num_rows()==1){
                return $username.'_1';
            }else{
                return $username;
            }
    }
    
    /*
     *  get All Active Users Data
     */
    
    public function getActiveUsers($login_id){
        
        $this->db->select('CONCAT_WS(" ",user_first_name,user_last_name) as name, user_photo,user_id, user_o_email',FALSE);
        $this->db->where('user_status', 'Active');
        $this->db->where('user_id !=', $login_id);
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
                    //$this->db->update('users', $user_last_login);
                    return $query->result();
         }
         else return false;
        
    }
    
    public function getUsers($conditions){
    
        $this->db->select('CONCAT_WS(" ",user_first_name,user_last_name) as name, user_photo,user_id, user_o_email',FALSE);
       
        $query = $this->db->get_where('users',$conditions);
        if($query->num_rows() > 0){
            //$this->db->update('users', $user_last_login);
            return $query;
        }
        else return false;
    
    }
	
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
