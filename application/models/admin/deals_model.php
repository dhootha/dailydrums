<?php

class Deals_model extends CI_Model {

    public $deal_table = 'deals';
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * This function can used to get all records or particular records depending on the clause
     * @param type $where_array -- $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
     
     function get_Deal_details( $where_array = null ) {

					$this->db->select('d.*,u.user_type,c.category_name,up.display_name');
					$this->db->from('deals d');
					$this->db->join('user u', 'u.id=d.user_id','left');
					$this->db->join('category c', 'c.category_id=d.category_id','left');
					$this->db->join('user_profile up', 'up.user_id=d.user_id','left');
					
					if($where_array!=null) {
				            $this->db->where($where_array);
				        }

					 $qry = $this->db->get();
					 //echo $this->db->last_query();
					 
					 if($qry->num_rows() > 0 ) {
								return $qry->result(); 
							}
							else {
									   return false;
								   }		
					}
        
     
     
   /* function get_category($where_array = null) {
        
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
    }*/
    
    /**
     * Function for inserting the db insert of static page
     * @return boolean
     */
    
    function  get_subscription($user_id){
        $this->db->select('u.firstname,u.lastname,subscriptions.id,subscriptions.created_date,subscriptions.status,deals.business_name');
        $this->db->from('user_profile u');
        $this->db->join('deal_subscriptions subscriptions', 'subscriptions.user_id = u.user_id','left');
        $this->db->join('deals deals', 'deals.id = subscriptions.deal_id','left');
        $this->db->where('subscriptions.user_id',$user_id);
        $this->db->where('subscriptions.status','1');
        $qry = $this->db->get();
        return $qry->result();
        
    }
    function get_deals($deal_cond = array(),$deal_status = '1'){
        $this->db->select('u.display_name,deals.*,cat.category_name');
        $this->db->from('user_profile u');
        $this->db->join('deals deals', 'deals.user_id = u.user_id','left');
        $this->db->join('category cat', 'deals.category_id = cat.category_id','left');
        
        if( !empty($deal_cond)) {
        			$this->db->where($deal_cond);
        			}
        	
        if($deal_status == '1'){		
        		$this->db->where('deals.status','1');
        		}
        $qry = $this->db->get();
        return $qry->result();
    }
            
    function insert_category(){
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|max_length[200]|xss_clean');
        
        if ($this->form_validation->run() != FALSE) {
        	
        /*// uploadfile	 // $this->form_validation->set_rules('page_content', 'page content', 'required');
        /*if (empty($_FILES['category_logo']['name'])) {
					    $this->form_validation->set_rules('category_logo', 'Category Logo', 'required');
					}
        		//$config['upload_path'] = './uploads/admin/category';
				//$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//$config['max_size']	= '0';
				//$config['max_width']  = '0';
				//$config['max_height']  = '0';
				//$this->load->library('upload', $config);
				//if ( $this->upload->do_upload('category_logo'))
				//{
							//$error = array('error' => $this->upload->display_errors());
							//$this->load->view('upload_form', $error);
						//}
						//else
						//{
							//$data = array('upload_data' => $this->upload->data());
				
							//$this->load->view('upload_success', $data);
						//}*/
		        	
		            $category_name = addslashes($this->input->post('category_name', TRUE));
		            $category_logo = $_FILES['category_logo']['name'];
		            $data = array(
					                'category_name' => addslashes($category_name),
					               
					                'created_date' => date('Y-m-d H:i:s')
					            	); // 'category_logo' => $category_logo,
		            $this->db->insert('category', $data);
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
    function update_category($category_id){
        
        $this->form_validation->set_rules('category_name', 'page title', 'required|trim|max_length[200]|xss_clean');
        //$this->form_validation->set_rules('page_content', 'page content', 'required');
        
        if ($this->form_validation->run() != FALSE) {
            $category_name = addslashes($this->input->post('category_name', TRUE));
            //$page_content = $this->input->post('page_content', TRUE);
            
            $data = array(
                'category_name' => addslashes($category_name),
                'created_date' => date('Y-m-d H:i:s')
            );
            $this->db->where('category_id', $category_id);
            $this->db->update('category', $data);
            return true;
        }
        else 
            return false;
    }
    
    
    function update_status($deal_id) {
    	
    		  $query = "UPDATE `deals` set status = if(`status`= '0','1','0') WHERE id=".$deal_id;
    		  $this->db->query($query);
			 // $this->db->where('page_id', $cat_id);
          //$this->db->update('category', $data);
           return true;   	
    	}
    

}