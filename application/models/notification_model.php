<?php
class Notification_model extends CI_Model{
	
    /*
     * 
     */
    public function insert_record($tablename,$DataRecord){
		if(isset($DataRecord)){
			$q=$this->db->insert("$tablename",$DataRecord);
			return $this->db->insert_id();
		}
	
	}
    
	/*
	 * 
	 */
    public function update_record($tablename,$DataRecord,$where_val,$id){
		if(isset($DataRecord)){
			$this->db->where($where_val,$id);
			$q=$this->db->update("$tablename", $DataRecord);
		}
	}
	
	/*
	 * 
	 */
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
     * Display Latest 10 Messages
     */
   public function myMessages($current_user_id){
        
        $sql = "SELECT notification_id,notification_type_id,notification_message,sender_id,notification_create_time,notification_type from notifications WHERE notification_audience LIKE '%<".$current_user_id.">%' and notification_type = 'Message'  Order By notification_create_time DESC LIMIT 0,10";
       $query = $this->db->query($sql);
      $total_notifications = $query->num_rows(); 
       if($total_notifications){
           $messgae_array = array();
           foreach($query->result() as $row){
               
               $messgae_array[] = array('notification_id' => $row->notification_id,
                                        'notification_message' => $row->notification_message,
                                        'sender_data'            => $this->getSenderInfo($row->sender_id),
                                        'notification_type'     => $row->notification_type,
                                        'notification_type_id'  => $row->notification_type_id,
                                        'time_notification'    => $row->notification_create_time
               );
           }
           
           return $messgae_array;
       }else{
           return $total_notifications;
       }
           
    }
    
    /*
     * Display Latest 10 Tasks
     */
    
    public function myTasks($current_user_id){
        $sql = "SELECT notification_id,notification_message,sender_id,notification_create_time,notification_type from notifications WHERE notification_audience LIKE '%<".$current_user_id.">%' and notification_type = 'Task'  Order By notification_create_time DESC LIMIT 0,10";
        $query = $this->db->query($sql);
        $total_notifications = $query->num_rows();
        if($total_notifications){
            $task_array = array();
            foreach($query->result() as $row){
                 
                $task_array[] = array('notification_id' => $row->notification_id,
                    'notification_message' => $row->notification_message,
              //      'sender_id'            => $this->getSenderInfo($row->sender_id),
                    'notification_type'     => $row->notification_type,
                    'time_notification'    => $row->notification_create_time
                );
            }
            return $task_array;
        }else{
            return $total_notifications;
        }
    }
    
    /*
     * Display Latest 10 Activity
     */
    public function myActivity($current_user_id){
        
        
        
    }
    
    /*
     * Display Latest 10 Notifications
     */
    public function myNotifications($current_user_id){
    
        $sql = "SELECT notification_id,notification_message,notification_type_id,sender_id,notification_create_time,notification_type from notifications WHERE notification_audience LIKE '%<".$current_user_id.">%' and notification_type NOT IN ('Message','Task') Order By notification_create_time DESC LIMIT 0,10";
        $query = $this->db->query($sql);
        $total_notifications = $query->num_rows();
        if($total_notifications){
            $notification_array = array();
            foreach($query->result() as $row){
                 
                $notification_array[] = array('notification_id' => $row->notification_id,
                    'notification_message' => $row->notification_message,
                 //   'sender_id'            => $this->getSenderInfo($row->sender_id),
                    'notification_type'     => $row->notification_type,
                    'notification_type_id' => $row->notification_type_id,
                    'time_notification'    => $row->notification_create_time
                );
            }
            
            return $notification_array;
        }else{
            return $total_notifications;
        }
    
    }
    
    public function updateNotificationStatus($notification_type,$type_id,$audience_id){
        
        
    $sql = "SELECT notification_audience,notification_seen_audience,notification_id from notifications WHERE notification_audience LIKE '%<".$audience_id.">%' and notification_type_id = $type_id and notification_type = 'Message'";
    $query = $this->db->query($sql);
    foreach($query->result() as $row){
    	//if($notification_type == "Message"){
    	  // For notifications Audience
    	  $notification_audience = str_replace("<".$audience_id.">", "", $row->notification_audience);
    	  // For notifications Seen Audience
    	  $notification_seen_audience = $row->notification_seen_audience;
    	  $notification_seen_audience = $notification_seen_audience." <".$audience_id."> ";
    	  // Now Updating the Notification
    	  $data = array('notification_audience' => $notification_audience,
    					'notification_seen_audience' => $notification_seen_audience);
    	  $notification_id = $row->notification_id;
    	  $this->db->update('notifications', $data, array('notification_id' => $notification_id));
    	//}
    }
        
        return true;
    }
    
    /*
     * 
     */
       
    
    public function getSenderInfo($uid){
        
        $query_sender = "Select user_photo,user_department, CONCAT_WS(' ',user_first_name, user_last_name) as name from users where user_id = '".$uid."'";
        $query = $this->db->query($query_sender);
        $user_array = array();
        foreach($query->result() as $row){
        
         $user_array = array('user_photo' => $row->user_photo,
                            'name'      => $row->name,
                            'department' => $row->user_department
            );
        }
        return $user_array;
    }
	
}

/* End of file Notification_model.php */
/* Location: ./application/models/Notification_model.php */
