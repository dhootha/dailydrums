<?php

class Static_page_model extends CI_Model {

    public $static_table = 'static_pages';
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * This function can used to get all records or particular records depending on the clause
     * @param type $where_array -- $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
    function get_static_pages($where_array = null) {
        
        $this->db->select('*');
        $this->db->from('static_pages');
        if($where_array!=null) {
            $this->db->where($where_array);
        }
        
        $fetchQuery = $this->db->get();

        if ($fetchQuery->num_rows() > 0) {
            return $fetchQuery->result();
            
        } else 
            return false;
    }
    
    /**
     * Function for inserting the db insert of static page
     * @return boolean
     */
    function insert_page(){
        
        $this->form_validation->set_rules('page_title', 'page title', 'required|trim|max_length[200]|xss_clean');
        $this->form_validation->set_rules('page_content', 'page content', 'required');
        
        if ($this->form_validation->run() != FALSE) {
            $page_title = addslashes($this->input->post('page_title', TRUE));
            $page_content = $this->input->post('page_content', TRUE);
           
            $data = array(
                'page_title' => addslashes($page_title),
                'page_content' => $page_content,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('static_pages', $data);
            if($this->db->insert_id()>0)
                return $this->db->insert_id();
            else 
                return false;
        }
        else 
            return false;
    }
    
    /**
     * Update page for the content page
     * @return boolean
     */
    function update_page($page_id){
        
        $this->form_validation->set_rules('page_title', 'page title', 'required|trim|max_length[200]|xss_clean');
        $this->form_validation->set_rules('page_content', 'page content', 'required');
        
        if ($this->form_validation->run() != FALSE) {
            $page_title = addslashes($this->input->post('page_title', TRUE));
            $page_content = $this->input->post('page_content', TRUE);
            
            $data = array(
                'page_title' => addslashes($page_title),
                'page_content' => $page_content,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('page_id', $page_id);
            $this->db->update('static_pages', $data);
            return true;
        }
        else 
            return false;
    }

}