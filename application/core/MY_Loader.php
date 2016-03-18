<?php 
class MY_Loader extends CI_Loader {
    static $add_data = array();
    public function view($view, $vars = array(), $return = FALSE)
    {
        self::$add_data = array_merge($vars, self::$add_data);
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array(self::$add_data), '_ci_return' => $return));
    }
    
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $S3Header  = $this->view('design/header', $vars, $return);
    
        if(is_array($template_name)) { //return all values in contents
    
            foreach($template_name as $file_to_load) {
                $S3Content = $this->view($file_to_load, $vars, $return);
            }
        }
        else {
           $S3Content = $this->view($template_name, $vars, $return);
        }
    
        $S3Footer = $this->view('design/footer', $vars, $return);
    
        if ($return)
        {
            return $S3Header; // default header
            return $S3Content; // view as controller
            return $S3Footer; // default footer
        }
    }
}
?>