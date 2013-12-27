<?php

class Plan_model extends CI_Model {

    public $static_table = 'business_plan';
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * This function can used to get all records or particular records depending on the clause
     * @param type $where_array -- $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
        
     
     
    function get_plan($where_array = null) {
        
        $this->db->select('*');
        $this->db->from('business_plan');
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
    function insert_plan(){
        
        $this->form_validation->set_rules('price', 'Category Name', 'required|trim|max_length[200]|xss_clean');
        $this->form_validation->set_rules('duration', 'Category Name', 'required|trim|max_length[200]|xss_clean');
        if ($this->form_validation->run() != FALSE) {
        
		            $price = addslashes($this->input->post('price', TRUE));
                            $duration = addslashes($this->input->post('duration', TRUE));
		            
		            $data = array(
					                'price' => addslashes($price),
					                'duration' => addslashes($duration),
					                'created_date' => date('Y-m-d H:i:s')
					            	);
		            $this->db->insert('business_plan', $data);
		            if($this->db->insert_id()>0)
		                return $this->db->insert_id();
		            else 
		                return false;
            }
        else { 
            		return false; 
            }
    }
    
    /**
     * Update page for the content page
     * @return boolean
     */
    function update_plan($id){
        
        $this->form_validation->set_rules('price', 'page title', 'required|trim|max_length[200]|xss_clean');
        $this->form_validation->set_rules('duration', 'page title', 'required|trim|max_length[200]|xss_clean');
//$this->form_validation->set_rules('page_content', 'page content', 'required');
        
        if ($this->form_validation->run() != FALSE) {
            $price = addslashes($this->input->post('price', TRUE));
            $duration = addslashes($this->input->post('duration', TRUE));
            //$page_content = $this->input->post('page_content', TRUE);
            
            $data = array(
                'price' => addslashes($price),
                'duration' => addslashes($duration)
                
            );
            $this->db->where('id', $id);
            $this->db->update('business_plan', $data);
            return true;
        }
        else 
            return false;
    }
    
    
    function update_status($cat_id) {
    	
    		  $query = "UPDATE `business_plan` set plan_status = if(`plan_status`= '0','1','0') WHERE id=".$cat_id;
    		  $this->db->query($query);
			 // $this->db->where('page_id', $cat_id);
          //$this->db->update('category', $data);
           return true;   	
    	}
    

}