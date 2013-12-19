<?php

class Login_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Login function validity with blank check
     * @return boolean
     */
    function validate_login() {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() != FALSE) {
            $userName = addslashes($this->input->post('username', TRUE));
            $password = addslashes($this->input->post('password', TRUE));
            $isValid = $this->login_check_db($userName, $password);
            return $isValid;
        }
        else 
            return false;
    }
	

    function login_check_db($userName, $password) {
        $this->db->select('id, username, password, email, display_name');
        $this->db->from('admin_user');
        $this->db->where('username', $userName);
        $this->db->where('password', MD5($password));
        $checkLoginQuery = $this->db->get();

        if ($checkLoginQuery->num_rows() == 1) {
            return $checkLoginQuery->result();
        } else {
            return false;
        }
    }
	 
    
    
}