<?php 
class Template_model extends CI_Model{
    
    public function get_template($type, $status){
        $query = $this->db->get_where('template',
            array('template_type' => $type,
                'template_status' => $status));
            if($query->num_rows()==1){
                return $query->result();
            }
    }
}
