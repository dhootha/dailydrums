<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authmanager {

    private $session_login_id = 'admin';
    
    public $ci;
    
    public function __construct() {
        $this->ci =& get_instance();        
    }

    /**
     * Check looged in or not
     * @return boolean
     */
    public function is_logged_in($session_id_name = null) {
        if($session_id_name!=null){
            $this->session_login_id = $session_id_name;
        }
        
        
        if ($this->session_login_id == null)
            return false;
        else {
            $user = $this->ci->session->userdata($this->session_login_id);           
            return $user;
        }
    }

}

/* End of file Someclass.php */