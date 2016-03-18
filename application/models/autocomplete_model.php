    <?php  
    class Autocomplete_model extends CI_Model{  
        function lookup($keyword){  
            $this->db->select('*')->from('users');  
            $this->db->like('user_first_name',$keyword,'after');  
            $query = $this->db->get();      
               
            return $query->result();  
        }  
    }     <?php  
    class Autocomplete_model extends CI_Model{  
        function lookup($keyword){  
            $this->db->select('*')->from('users');  
            $this->db->like('user_first_name',$keyword,'after');  
            $query = $this->db->get();      
               
            return $query->result();  
        }  
    } 