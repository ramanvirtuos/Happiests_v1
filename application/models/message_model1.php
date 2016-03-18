<?php
class Message_model extends CI_Model{
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
	
	public function get_record($sql){
        $query="";
        if(isset($sql)){
            $query= $this->db->query($sql);
        }
        return $query;
    }
	 function get_contents($fields,$where_val,$id,$tablename) {
        $this->db->select($fields);
        $this->db->where($where_val,$id);
        $result = $this->db->get($tablename);
		return $result;
    }

	
	}

/* End of file Message_model.php */
/* Location: ./application/models/Message_model.php */
<?php
class Message_model extends CI_Model{
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
	
	public function get_record($sql){
        $query="";
        if(isset($sql)){
            $query= $this->db->query($sql);
        }
        return $query;
    }
	 function get_contents($fields,$where_val,$id,$tablename) {
        $this->db->select($fields);
        $this->db->where($where_val,$id);
        $result = $this->db->get($tablename);
		return $result;
    }

	
	}

/* End of file Message_model.php */
/* Location: ./application/models/Message_model.php */
