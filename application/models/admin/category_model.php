<?php

class Category_model extends CI_Model {

    public $static_table = 'category';
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * This function can used to get all records or particular records depending on the clause
     * @param type $where_array -- $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
        
     
     
    function get_category($where_array = null) {
        
        $this->db->select('*');
        $this->db->from('category');
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
    function insert_category(){
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|max_length[200]|xss_clean|is_unique[category.category_name]');
        $this->form_validation->set_rules('category_slug', 'Category Slug', 'required|trim|max_length[200]|xss_clean|is_unique[category.category_slug]');
        
        if ($this->form_validation->run() != FALSE) {
        	
        // uploadfile	 // $this->form_validation->set_rules('page_content', 'page content', 'required');
        if (empty($_FILES['category_logo']['name'])) {
					    $this->form_validation->set_rules('category_logo', 'Category Logo', 'required');
					}
					
				$this->load->model('Common_model');
				
				$ext = array_pop(explode(".",$_FILES['category_logo']['name']));
				$destination = $this->config->item('category_image');
			   $pointer     = 'category_logo';
			   $new_file_name = md5($_FILES['category_logo']['name']);
			   $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'10' );
				
        		//$config['upload_path'] = './uploads/admin/category';
				//$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//$config['max_size']	= '0';
				//$config['max_width']  = '0';
				//$config['max_height']  = '0';
				//$this->load->library('upload', $config);
				//var_dump($this->upload->do_upload('category_logo')); die();
				//if ( $this->upload->do_upload('category_logo') )	{
					if($ret != 'success' ){
					
							$error = array('error' => $this->upload->display_errors());
							//print_r($error); die();
							$this->load->view('add_view', $error);
						}
						else {
								//$data = array('upload_data' => $this->upload->data());
								//$this->load->view('upload_success', $data);
				            $category_name = addslashes($this->input->post('category_name', TRUE));
				            $category_slug = addslashes($this->input->post('category_slug', TRUE));
				            $category_logo = $new_file_name.".".$ext;
				            $data = array(
							                'category_name' => addslashes($category_name),
							                'category_slug' => addslashes($category_slug),
							                'category_logo' => $category_logo,
							                'created_date' => date('Y-m-d H:i:s')
							            	); 
				            $this->db->insert('category', $data);
				            if($this->db->insert_id()>0)
				                return $this->db->insert_id();
				            else 
				                return false;
		           			}
            }
        else { 
            	return false; 
            	}
    }
    
    /**
     * Update page for the content page
     * @return boolean
     */
    function update_category($category_id){
        
        $this->form_validation->set_rules('category_name', 'page title', 'required|trim|max_length[200]|xss_clean');
        $this->form_validation->set_rules('category_slug', 'Category Slug', 'required|trim|max_length[200]|xss_clean');
        //$this->form_validation->set_rules('page_content', 'page content', 'required');
        
        if ($this->form_validation->run() != FALSE) {
            //$page_content = $this->input->post('page_content', TRUE);
            
            $new_file_name = '';
            $ext = '';
            
             if (!empty($_FILES['category_logo']['name'])) {
					
						$this->load->model('Common_model');
						$ext = array_pop(explode(".",$_FILES['category_logo']['name']));
						$destination = $this->config->item('category_image');
					   $pointer     = 'category_logo';
					   $new_file_name = md5($_FILES['category_logo']['name']);
					   $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'10' );

						if($ret != 'success' ){
						
								$error = array('error' => $this->upload->display_errors());
								//print_r($error); die();
								$this->load->view('add_view', $error);
							}
						}
													
				      $category_name = addslashes($this->input->post('category_name', TRUE));
   					$category_slug = addslashes($this->input->post('category_slug', TRUE));
   					if($new_file_name != ''){
							$category_logo = $new_file_name.".".$ext;
							$logo = "'category_logo' => ".$category_logo.",";
							}
							else{
									$logo = '';
									}
						
		            $data = array(
		                'category_name' => addslashes($category_name),
		                'category_slug' => addslashes($category_slug),
		                'category_logo' => $category_logo,
		                'created_date' => date('Y-m-d H:i:s')
		            );
		            $this->db->where('category_id', $category_id);
		            $this->db->update('category', $data);
		            return true;
					           
        }
        else 
            return false;
    }
    
    
    function update_status($cat_id) {
    	
    		  $query = "UPDATE `category` set category_status = if(`category_status`= '0','1','0') WHERE category_id=".$cat_id;
    		  $this->db->query($query);
			 // $this->db->where('page_id', $cat_id);
          //$this->db->update('category', $data);
           return true;   	
    	}
    

}