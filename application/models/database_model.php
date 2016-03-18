<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_model extends CI_Model {
	function __construct(){
        parent::__construct();
    }
	public function getAll($tablename,$perpagerecords='',$currentrecordshowing=0){
		$DataRecord=array();
		$q=$this->db->get("$tablename");
		//$q=$this->db->limit($currentrecordshowing,$perpagerecords);
		$totalRecords=$this->db->count_all_results();
		if($totalRecords>0){
			$DataRecord=$q->result();
		}
		return $DataRecord;
	}
	public function getNumRows($tablename){
		$q=$this->db->get("$tablename");
		return $q->num_rows();
	}
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
			/*if($q->num_rows()>0){
				$q=$this->db->update("$tablename",$DataRecord);
				return true;	
			}
			else{
				return false;
			}*/
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
	public function get_query_recordset($sql){
        $query="";
        if(isset($sql)){
            $query= $this->db->query($sql);
        }
        return $query;
    }
}<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_model extends CI_Model {
	function __construct(){
        parent::__construct();
    }
	public function getAll($tablename,$perpagerecords='',$currentrecordshowing=0){
		$DataRecord=array();
		$q=$this->db->get("$tablename");
		//$q=$this->db->limit($currentrecordshowing,$perpagerecords);
		$totalRecords=$this->db->count_all_results();
		if($totalRecords>0){
			$DataRecord=$q->result();
		}
		return $DataRecord;
	}
	public function getNumRows($tablename){
		$q=$this->db->get("$tablename");
		return $q->num_rows();
	}
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
			/*if($q->num_rows()>0){
				$q=$this->db->update("$tablename",$DataRecord);
				return true;	
			}
			else{
				return false;
			}*/
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
	public function get_query_recordset($sql){
        $query="";
        if(isset($sql)){
            $query= $this->db->query($sql);
        }
        return $query;
    }
}