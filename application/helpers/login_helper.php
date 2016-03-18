<?php
function is_logged_in() {
    // Get current CodeIgniter instance
    
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('logged_in');
    if (!$user) { return false; } else { return true; }
}

function is_user_type(){
    
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $type = $CI->session->userdata('user_access_type');
    if (!$type) { return false; } else { return true; }
    
}

function getUserDetails($userId=NULL,$field='')
{
    $CI =& get_instance();
    $mod = $CI->load->model('User_model','user_model');
    $conditions = array('users.user_id'=>$userId, 'user_status' => 'Active');
    $result = $CI->user_model->getUsers($conditions);
    if($result->num_rows()>0) {
        $data = $result->row();
        $res = $data->$field;
    } else {
        $res = '';
    }
    return $res;
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}
?>