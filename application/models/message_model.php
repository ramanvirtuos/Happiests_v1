<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model
{
    /**
     * Send a New Message
     *
     * @param   integer  $sender_id
     * @param   mixed    $recipients  A single integer or an array of integers
     * @param   string   $subject
     * @param   string   $body
     * @param   integer  $priority
     * @return  integer  $new_thread_id
     */
    function send_new_message($sender_id, $recipients, $subject, $body, $priority,$attachment_arr)
    {
        $this->db->trans_start();

        $thread_id = $this->_insert_thread($subject);
        $msg_id    = $this->_insert_message($thread_id, $sender_id, $body, $priority);

        // Create batch inserts
        $participants[] = array('thread_id' => $thread_id,'user_id' => $sender_id);
        //$attachments[] = array('thread_id' => $thread_id,'user_id' => $sender_id);
        $statuses[]     = array('message_id' => $msg_id, 'user_id' => $sender_id,'status' => MSG_STATUS_READ);

        if ( ! is_array($recipients))
        {
            $participants[] = array('thread_id' => $thread_id,'user_id' => $recipients);
            $statuses[]     = array('message_id' => $msg_id, 'user_id' => $recipients, 'status' => MSG_STATUS_UNREAD);
            $sent_user[] = array('msg_id' => $msg_id, 'user_from_id' => $sender_id,'user_to_id' => $recipients );
        }
        else
        {
            foreach ($recipients as $recipient)
            {
                $participants[] = array('thread_id' => $thread_id,'user_id' => $recipient);
                $statuses[]     = array('message_id' => $msg_id, 'user_id' => $recipient, 'status' => MSG_STATUS_UNREAD);
                $sent_user[] = array('msg_id' => $msg_id, 'user_from_id' => $sender_id,'user_to_id' => $recipient );
            }
        }
        
        foreach ($attachment_arr as $name){
            $attachments[] = array('thread_id' => $thread_id,'msg_id' => $msg_id,'user_id' => $sender_id, 'attachment_name' => $name);
            if (copy('./uploads/messages/temp/'.$name, './uploads/messages/'.$name)) {
                 unlink('./uploads/messages/temp/'.$name);
            }
           
            
        }
        
        $this->_insert_participants($participants);
        if(!empty($attachments)){
            $this->_insert_attachments($attachments);
        }
        $this->_insert_statuses($statuses);
        $this->_insert_sent($sent_user);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }

        return $thread_id;
    }
    
    
    // ------------------------------------------------------------------------
    
    /**
     * Get Message ATTACHMENT
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     *
     * @return  integer  $attachment
     */
    
    function get_message_attachment($message_id){
    
        $sql = 'SELECT attachment_id,attachment_name from msg_attachments as m WHERE m.msg_id = ?' ;
    
        $query = $this->db->query($sql, array($message_id));
    
        return $query->result_array();
    
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Get Message ATTACHMENT
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * 
     * @return  integer  $attachment
     */
    
    function get_msg_attachment($thread_id, $user_id){
        
            $sql = 'SELECT attachment_id,attachment_name from msg_attachments as m WHERE m.thread_id = ? and m.user_id = ?' ;
        
            $query = $this->db->query($sql, array($thread_id, $user_id));
        
            return $query->result_array();
        
    }

    // ------------------------------------------------------------------------

    /**
     * Reply to Message
     *
     * @param   integer  $reply_msg_id
     * @param   integer  $sender_id
     * @param   string   $body
     * @param   integer  $priority
     * @return  integer  $new_msg_id
     */
    function reply_to_message($reply_msg_id, $sender_id, $new_recipients, $body, $priority, $attachment_arr,$all_participant)
    {
        $this->db->trans_start();

        // Get the thread id to keep messages together
        if ( ! $thread_id = $this->_get_thread_id_from_message($reply_msg_id))
        {
            return FALSE;
        }
        // Add this message
        $msg_id = $this->_insert_message($thread_id, $sender_id, $body, $priority);
    if($all_participant){
        if ($recipients = $this->_get_thread_participants($thread_id, $sender_id))
        {
            //print_r($recipients); die;
            $statuses[] = array('message_id' => $msg_id, 'user_id' => $sender_id,'status' => MSG_STATUS_READ);
            //print_r($recipients); die;
            foreach ($recipients as $recipient)
            {
                $statuses[] = array('message_id' => $msg_id, 'user_id' => $recipient['user_id'], 'status' => MSG_STATUS_UNREAD);
                $sent_user[] = array('msg_id' => $msg_id, 'user_from_id' => $sender_id,'user_to_id' => $recipient['user_id'] );
                $r_user_id[] = $recipient['user_id'];
            }
            //$new_recipients = array_diff($r_user_id,$new_recipients);
           // $new_recipients = array_diff($new_recipients);
            $this->_insert_statuses($statuses);
            $this->_insert_sent($sent_user);
            unset($new_recipients[0]);
            unset($statuses);
            unset($sent_user);
          if(!empty($new_recipients)){  
            foreach ($new_recipients as $recipient)
            {
                $statuses[] = array('message_id' => $msg_id, 'user_id' => $recipient, 'status' => MSG_STATUS_UNREAD);
                $sent_user[] = array('msg_id' => $msg_id, 'user_from_id' => $sender_id,'user_to_id' => $recipient );
            }
            $this->_insert_statuses($statuses);
            $this->_insert_sent($sent_user);
          }
        }
    }else{
        
        foreach ($new_recipients as $recipient)
        {
            $statuses[] = array('message_id' => $msg_id, 'user_id' => $recipient, 'status' => MSG_STATUS_UNREAD);
            $sent_user[] = array('msg_id' => $msg_id, 'user_from_id' => $sender_id,'user_to_id' => $recipient );
        }
        $this->_insert_statuses($statuses);
        $this->_insert_sent($sent_user);
        
    }
    
    foreach ($attachment_arr as $name){
        $attachments[] = array('thread_id' => $thread_id,'msg_id' => $msg_id,'user_id' => $sender_id, 'attachment_name' => $name);
        if (copy('./uploads/messages/temp/'.$name, './uploads/messages/'.$name)) {
            unlink('./uploads/messages/temp/'.$name);
        }
         
    
    }
    if(!empty($attachments)){
        $this->_insert_attachments($attachments);
    }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }

        return $msg_id;
    }

    // ------------------------------------------------------------------------

    /**
     * Get a Single Message
     *
     * @param  integer $msg_id
     * @param  integer $user_id
     * @return array
     */
    function get_message($msg_id, $user_id)
    {
        $sql = 'SELECT m.*, s.status, t.subject, ' . USER_TABLE_USERNAME .
        ' FROM ' . $this->db->dbprefix . 'msg_messages m ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (m.thread_id = t.id) ' .
        ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) '.
        ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_id = ? ) ' .
        ' WHERE m.id = ? ' ; 

        $query = $this->db->query($sql, array($user_id, $msg_id));

        return $query->result_array();
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Get All Threads
     *
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    function get_all_receive_threads($user_id, $full_thread = FALSE, $order_by = 'asc',$limit_per_page, $offset)
    {
        $sql = 'SELECT m.*, s.status, t.subject,p.user_id as puser_id, '.USER_TABLE_USERNAME .
        ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (t.id = p.thread_id) ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.thread_id = t.id) ' .
        ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) '.
        ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_id = ? ) ' .
        ' WHERE p.user_id = ? and m.sender_id != ?' ;
    
        if (!$full_thread)
        {
            $sql .= ' AND m.cdate >= p.cdate';
        }
        
    
        $sql .= ' ORDER BY t.id ' . $order_by. ', m.cdate '. $order_by;
        
        if (!is_null($limit_per_page) && !is_null($offset)){
            $sql .= ' LIMIT '.$limit_per_page.' OFFSET '.$offset;
        }
    
        $query = $this->db->query($sql, array($user_id, $user_id,$user_id));
    
        return $query->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Get a Full Thread
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    function get_full_thread($thread_id, $user_id, $full_thread = FALSE, $order_by = 'asc')
    {
        $sql = 'SELECT m.*, s.status, t.subject, '.USER_TABLE_USERNAME .
        ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (t.id = p.thread_id) ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.thread_id = t.id) ' .
        ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) '.
        ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_id = ? ) ' .
        ' WHERE p.user_id = ? ' .
        ' AND p.thread_id = ? ';

        if ( ! $full_thread)
        {
            $sql .= ' AND m.cdate >= p.cdate';
        }

        $sql .= ' ORDER BY m.cdate ' . $order_by;

        $query = $this->db->query($sql, array($user_id, $user_id, $thread_id));

        return $query->result_array();
    }
    
    // -------------------------------------------------------------------------
    /**
     * Get All Sent Threads
     *
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    
    function get_all_sent_threads($user_id, $full_thread = FALSE, $order_by = 'asc'){
        
        $sql = 'SELECT m.*, s.cdate as sentdate, t.subject, CONCAT(u.user_first_name, " ", u.user_last_name) as user_name, s.user_to_id as user_id FROM msg_messages as m JOIN msg_threads as t ON (m.thread_id = t.id) JOIN msg_sent as s on (m.sender_id = s.user_from_id) JOIN users u ON (u.user_id = s.user_to_id ) WHERE s.user_from_id = ? Group By m.id';
        
        if (!$full_thread)
        {
            $sql .= ' AND m.cdate >= p.cdate';
        }
        
        $sql .= ' ORDER BY t.id ' . $order_by. ', m.cdate '. $order_by;
        
        $query = $this->db->query($sql, array($user_id));
        
        return $query->result_array();
        
        
    }

    // ------------------------------------------------------------------------

    /**
     * Get All Threads
     *
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    function get_all_threads($user_id, $full_thread = FALSE, $order_by = 'asc')
    {
        $sql = 'SELECT m.*, s.status, t.subject, '.USER_TABLE_USERNAME .
        ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (t.id = p.thread_id) ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.thread_id = t.id) ' .
        ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) '.
        ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_id = ? ) ' .
        ' WHERE p.user_id = ? ' ;

        if (!$full_thread)
        {
            $sql .= ' AND m.cdate >= p.cdate';
        }

        $sql .= ' ORDER BY t.id ' . $order_by. ', m.cdate '. $order_by;

        $query = $this->db->query($sql, array($user_id, $user_id));

        return $query->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Change Message Status
     *
     * @param   integer  $msg_id
     * @param   integer  $user_id
     * @param   integer  $status_id
     * @return  integer
     */
    function update_message_status($msg_id, $user_id, $status_id)
    {
        $this->db->where(array('message_id' => $msg_id, 'user_id' => $user_id ));
        $this->db->update('msg_status', array('status' => $status_id ));

        return $this->db->affected_rows();
    }

    // ------------------------------------------------------------------------

    /**
     * Add a Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    function add_participant($thread_id, $user_id)
    {
        $this->db->trans_start();

        $participants[] = array('thread_id' => $thread_id,'user_id' => $user_id);

        $this->_insert_participants($participants);

        // Get Messages by Thread
        $messages = $this->_get_messages_by_thread_id($thread_id);

        foreach ($messages as $message)
        {
            $statuses[] = array('message_id' => $message['id'], 'user_id' => $user_id, 'status' => MSG_STATUS_UNREAD);
        }

        $this->_insert_statuses($statuses);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Remove a Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    function remove_participant($thread_id, $user_id)
    {
        $this->db->trans_start();

        $this->_delete_participant($thread_id, $user_id);
        $this->_delete_statuses($thread_id, $user_id);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }

        return TRUE;
    }
    
    
    // ------------------------------------------------------------------------
    
    /**
     * Remove a Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    function remove_sent_msg($msg_id,$from_id, $to_user_id)
    {
        $this->db->trans_start();
    
        $sql = 'DELETE s FROM msg_sent s ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.id = s.msg_id) ' .
        ' WHERE s.user_from_id = ? ' .
        ' AND s.user_to_id = ? ';

        $query = $this->db->query($sql, array($from_id, $to_user_id));

            
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
    
        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Valid New Participant - because of CodeIgniter's DB Class return style,
     *                         it is safer to check for uniqueness first
     *
     * @param   integer $thread_id
     * @param   integer $user_id
     * @return  boolean
     */
    function valid_new_participant($thread_id, $user_id)
    {
        $sql = 'SELECT COUNT(*) AS count ' .
        ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
        ' WHERE p.thread_id = ? ' .
        ' AND p.user_id = ? ';

        $query = $this->db->query($sql, array($thread_id, $user_id));

        if ($query->row()->count)
        {
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Application User
     *
     * @param   integer  $user_id`
     * @return  boolean
     */
    function application_user($user_id)
    {
        $sql = 'SELECT COUNT(*) AS count ' .
        ' FROM ' . $this->db->dbprefix . USER_TABLE_TABLENAME .
        ' WHERE ' . USER_TABLE_ID . ' = ?' ;

        $query = $this->db->query($sql, array($user_id));

        if ($query->row()->count)
        {
            return TRUE;
        }

        return FALSE;
    }

    // ------------------------------------------------------------------------

    /**
     * Get Participant List
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @return  mixed
     */
    function get_participant_list($thread_id, $sender_id = 0)
    {
        if ($results = $this->_get_thread_participants($thread_id, $sender_id))
        {
            return $results;
        }
        return FALSE;
    }

    // ------------------------------------------------------------------------

    /**
     * Get Message Count
     *
     * @param   integer  $user_id
     * @param   integer  $status_id
     * @return  integer
     */
    function get_msg_count($user_id, $status_id = MSG_STATUS_UNREAD)
    {
        $query = $this->db->select('COUNT(*) AS msg_count')->where(array('user_id' => $user_id, 'status' => $status_id ))->get('msg_status');
        return $query->row()->msg_count;
    }
    
    /**
     * Get Message Count
     *
     * @param   integer  $user_id
     * @param   integer  $status_id
     * @return  integer
     */
    function get_total_msg_count($user_id, $status_id = MSG_STATUS_ARCHIVED)
    {
        $query = $this->db->select('COUNT(*) AS msg_count')->where(array('user_id' => $user_id, 'status !=' => $status_id ))->get('msg_status');
        return $query->row()->msg_count;
    }

    // ------------------------------------------------------------------------
    // Private Functions from here out!
    // ------------------------------------------------------------------------

    /**
     * Insert Thread
     *
     * @param   string  $subject
     * @return  integer
     */
    private function _insert_thread($subject)
    {
        $insert_id = $this->db->insert('msg_threads', array('subject' => $subject));

        return $this->db->insert_id();
    }

    /**
     * Insert Message
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @param   string   $body
     * @param   integer  $priority
     * @return  integer
     */
    private function _insert_message($thread_id, $sender_id, $body, $priority)
    {
        $insert['thread_id'] = $thread_id;
        $insert['sender_id'] = $sender_id;
        $insert['body']      = $body;
        $insert['priority']  = $priority;

        $insert_id = $this->db->insert('msg_messages', $insert);

        return $this->db->insert_id();
    }

    /**
     * Insert Participants
     *
     * @param   array  $participants
     * @return  bool
     */
    private function _insert_participants($participants)
    {
        return $this->db->insert_batch('msg_participants', $participants);
    }
    
    /**
     * Insert Participants
     *
     * @param   array  $participants
     * @return  bool
     */
    private function _insert_sent($sent_user)
    {
        return $this->db->insert_batch('msg_sent', $sent_user);
    }
    
    /**
     * Insert Attachments
     *
     * @param   array  $attachments
     * @return  bool
     */
    private function _insert_attachments($attachments)
    {
        return $this->db->insert_batch('msg_attachments', $attachments);
    }

    /**
     * Insert Statuses
     *
     * @param   array  $statuses
     * @return  bool
     */
    private function _insert_statuses($statuses)
    {
        return $this->db->insert_batch('msg_status', $statuses);
    }

    /**
     * Get Thread ID from Message
     *
     * @param   integer  $msg_id
     * @return  integer
     */
    public function _get_thread_id_from_message($msg_id)
    {
        $query = $this->db->select('thread_id')->get_where('msg_messages', array('id' => $msg_id));

        if ($query->num_rows())
        {
            return $query->row()->thread_id;
        }
        return 0;
    }

    /**
     * Get Messages by Thread
     *
     * @param   integer  $thread_id
     * @return  array
     */
    private function _get_messages_by_thread_id($thread_id)
    {
        $query = $this->db->get_where('msg_messages', array('thread_id' => $thread_id));

        return $query->result_array();
    }
    
    
    /**
     * Get Message ID by Thread
     *
     * @param   integer  $thread_id
     * @return  array
     */
    public function _get_message_by_thread_id($thread_id, $sender_id)
    {
        $this->db->order_by("id", "DESC");
        $query = $this->db->select('id')->get_where('msg_messages', array('thread_id' => $thread_id,'sender_id' => $sender_id), 1, 0);
    
        if ($query->num_rows())
        {
            return $query->row()->id;
        }
        return 0;
    }


    /**
     * Get Thread Particpiants
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @return  array
     */
    public function _get_thread_participants($thread_id, $sender_id = 0)
    {
        $array['thread_id'] = $thread_id;

        if ($sender_id) // If $sender_id 0, no one to exclude
        {
            $array['msg_participants.user_id != '] = $sender_id;
        }

        $this->db->select('msg_participants.user_id, '.USER_TABLE_USERNAME, FALSE);
        $this->db->join(USER_TABLE_TABLENAME, 'msg_participants.user_id = ' . USER_TABLE_ID);

        $query = $this->db->get_where('msg_participants', $array);

        return $query->result_array();
    }

    /**
     * Delete Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    private function _delete_participant($thread_id, $user_id)
    {
        $this->db->delete('msg_participants', array('thread_id' => $thread_id, 'user_id' => $user_id));

        if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Delete Statuses
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    private function _delete_statuses($thread_id, $user_id)
    {
        $sql = 'DELETE s FROM msg_status s ' .
        ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.id = s.message_id) ' .
        ' WHERE m.thread_id = ? ' .
        ' AND s.user_id = ? ';

        $query = $this->db->query($sql, array($thread_id, $user_id));

        return TRUE;
    }
    
    /**
     * Update Statuses
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    public function _update_msg_statuses($message_id, $user_id)
    {
        $sql = 'Update msg_status as s set status = 2' .
            ' WHERE s.message_id = ? ' .
            ' AND s.user_id = ? ';
    
        $query = $this->db->query($sql, array($message_id, $user_id));
    
        return TRUE;
    }
}

/* end of file message_model.php */