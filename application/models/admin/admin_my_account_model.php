<?php

class Admin_my_account_model extends CI_Model {

    
    function __construct() {
        // Call the Model constructor
        parent::__construct();        
    }
    
    
    public function get_admin_details($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('admin_user');
        $fetchQuery = $this->db->get();
        
        if ($fetchQuery->num_rows() > 0) {
            return $fetchQuery->result();
            
        } else 
            return false;
    }
     
    
   public function update_account_details($admin_id, $POST){
       
       $data['display_name'] = $POST['display_name'];
       if(isset($POST['email']) && !empty($POST['email'])) {
           $data['email'] = $POST['email'];
       }
       
       if(isset($POST['new_password']) && !empty($POST['new_password'])) {
           $data['password'] = md5($POST['new_password']);
       }
       
       $this->db->where('id',$admin_id);
       $this->db->update('admin_user',$data);       
       
   }
    
    
    public function change_password($user_id, $new_password,$table_name) {
        if (!empty($user_id) && !empty($new_password)) {
            $data = array('password' => md5($new_password));
            $this->db->where('id', $user_id);
            $this->db->update($table_name, $data);
            return true;
        }
        else
            return false;
    }

}