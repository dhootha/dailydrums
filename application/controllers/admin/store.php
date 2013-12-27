<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Store extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public $is_logged_in;
    public $pageName;
    
    public function __construct() {
        parent::__construct();
         
        $this->load->library('authmanager'); ////$session_id = $this->session->all_userdata();
        $this->is_logged_in = $this->authmanager->is_logged_in();
        
        if(!$this->is_logged_in){
            redirect('admin/welcome/login');            
        }
        $this->load->model('admin/Deals_model');
        $this->load->model('admin/Store_model');
        $this->load->model('Common_model');
        $this->load->model('admin/User_model');
        $this->load->model('Insert_data_model');
        $this->load->model('Update_data_model');
        $this->load->model('admin/Store_model');
        
        $this->pageName = 'Manage Store';
        
    }
    
    /**
     * Index redirecting to home()
     * @param type $method
     */
    public function index() {
         $this->home();        
    }
    
    /**
     * Default controller home
     */
     //OK
    public function home() {
        $data['pageName'] = $this->pageName;
        
        //$whr_arr = array('d.status'=>'1');
        
        $userRS = $this->Store_model->get_store_details();
        											//echo "<pre>"; print_r($userRS);exit;
        $data['userRS'] = $userRS;
        $this->load->view('admin/store/listing_view', $data);    
    }

	public function by_user() {
        $data['pageName'] = $this->pageName;

		$user_id = $this ->uri->segment(4);
        $whr_arr = array('s.user_id'=>$user_id);
        
        $userRS = $this->Store_model->get_store_details($whr_arr);
        											//echo "<pre>"; print_r($userRS);exit;
        $data['userRS'] = $userRS;
        $this->load->view('admin/store/listing_view', $data);    
    }
    
    public function subscriptions($store_id) {
        		$userRS = $this->Store_model->get_store_subscription($store_id);
        		$data['userRS'] = $userRS;
            if(isset($userRS[0]->store_name))
            $data['pageName'] = 'Subscriptions Of '.$userRS[0]->store_name;
            
            $this->load->view('admin/store/subscriptions', $data); 
    			}
    			
    public function deals_by_store($store_id = '') {
        
        /* if(!isset($deal_id)){
            echo '<h5>Error in page. Please try again later.</h5>';
            exit();
        		} */

        $userRS = $this->Store_model->get_deals_by_store($store_id);

       /* if($userRS) {
            $user = $userRS[0];
        		} */
        		
       // $user = $userRS[0];
        $data['userRS'] = $userRS;

        $this->load->view('admin/store/deal_details', $data); 
    	}
    	
    public function create_store(){
    	
    		$where_clause = array('u.status'=>'1');
    		$where_in_utype_clause  = array('business_basic','business_pro','ADMIN');
    		$data['user'] = $this->User_model->get_users($where_clause,$where_in_utype_clause);
    		
    		$store_cond = array('s.status'=>'1','s.user_id'=>'1');
    		$data['stores']		= $this->Common_model->fetch_stores($store_cond);
    		//$data['categories'] = $this->Common_model->fetch_category();
    		//$data['country']  = $this->Common_model->get_countries(array('status'=>'1'));
    		$data['city']		= $this->Common_model->fetch_city('1');

    		$this->load->view('admin/store/add_view',$data);
    	}
    	
    public function add_store() {
    	
    			if(isset($_POST['page_action']) && $_POST['page_action'] == 'add_store'){
    			
    			 $this->form_validation->set_rules('user_id', 'User', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[255]|xss_clean');
    			 $this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[255]|xss_clean');
    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|max_length[255]|xss_clean');
				 $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|max_length[255]|xss_clean');    			 
    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|max_length[30]|max_length[15]|xss_clean');
    			 $this->form_validation->set_rules('website', 'Website', 'trim|required|max_length[200]|prep_url|xss_clean');
    			 $this->form_validation->set_rules('tag_words', 'Tag Words', 'trim|required|max_length[255]|xss_clean');
    			 
    			 
    			 $this->form_validation->set_error_delimiters('', '');
    			 
    			 if($this->form_validation->run() == FALSE) {
    			 	
    			 		$this->create_store();
    			 		}
    			 		else{
    			 					if( isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "" ) {
										
											 /* $ext = array_pop(explode(".",$_FILES['img']['name']));
											  $destination = $this->config->item('deal_image');
											  $pointer     = 'img';
											  $new_file_name = md5($_FILES['img']['name'].time()); 
											  $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'232' );
																							  
											  if( $ret == 'success' ) { */
													  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
													  $destination1 	= $this->config->item('store_image');
													  $pointer1     	= 'logo';
													  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
													  
													  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'600'  );
													  
											  			if( $ret1 == 'success' ) {
													 	
																if( $this->Insert_data_model->save_store($this->input->post('user_id'),$new_file_name1.".".$ext1) ) {
																		$this->session->set_flashdata('info_message',"Store uploaded successfully");
																		redirect(base_url('admin/store'));	
																		exit;
																		}
																		else{
																				$this->session->set_flashdata('info_message',"Failed to Create the Store, please try again.");
																				redirect(base_url('admin/store/create_store'));	
																				exit;	
																			 }
																}
																else{
																		$this->session->set_flashdata('info_message',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/store/create_store'));	
																		exit;	
																		}
														/*}
														else{
																//$this->session->set_flashdata('action_msg',$ret);
																//$this->session->set_flashdata('action','0');	
																//redirect(base_url('user/deal_upload'));	
																$this->session->set_flashdata('info_message',$ret);//"Failed to upload the Campaign, please try again."
																redirect(base_url('admin/deals/create_pro_deal'));	
																exit;								
															}*/
												}
												else{
														$this->session->set_flashdata('info_message',"Plese select a file for logo, please try again.");
														redirect(base_url('admin/store/create_store'));	
													}
    			 			  }
    			}
    			else{
						$this->create_store();    				
    				}
    	}
    	
    public function get_zip(){
    	
    		$city_name = $this->input->post('city_name');
    		
    	   $zip = $this->Common_model->fetch_zip_by_city('1','',$city_name);
			echo json_encode($zip);
    	   exit;   		
    	}
    	
    	public function get_stores(){
    		$user_id = $this->input->post('user_id');
    		$store_cond = array('user_id'=>$user_id,'status'=>'1');
    		
    		$store = $this->Common_model->fetch_stores($store_cond);
			echo json_encode($store);
			exit;    		
    		}
    
    
    /**
     * Show details page
     */
     //OK
    public function view() {
        $get = $this->uri->uri_to_assoc();
        //echo "<pre>"; print_r($get);
        if(!isset($get['id'])){
            echo '<h5>Error in page. Please try again later.</h5>';
            exit();
        }
        
        $store_id = $get['id'];
        $where_clause = array('s.store_id' => $store_id);
        $storeRS = $this->Store_model->get_stores($where_clause);

        if(!$storeRS) {
            echo '<h5>No records found..</h5>';
            exit();
        }
        $store = $storeRS[0];

        $data['store'] = $store;
        
        //echo "<pre>"; print_r($user); exit;

        $this->load->view('admin/store/view_details', $data);    
        
    }
    
    /**
     *  Change Status
     */
     //OK
     public function change_status() {
	     		$get = $this->uri->uri_to_assoc();
	     		
				if(!isset($get['id'])){
						redirect('admin/store');
						exit;
					}     		
	     		$deal_id = $get['id']; 
	     		$this->Store_model->update_status($deal_id);
	
	     		redirect('admin/store');
	         exit();
	     		}
    
 
    
    /**
     *  Editing the content of the pages
     */
    public function edit_store($not_updt_id = '') {  
		        $data['pageName'] = $this->pageName . ' : Edit Store';
		        $get = $this->uri->uri_to_assoc();
		        
		        //If no id found
		        if(!isset($get['id']) && $not_updt_id == ''){
		            $this->session->set_flashdata('info_message', '<span class="error-alert">No store found</span>');
		            redirect('admin/store');
		            exit();
		        }
		        
		        $store_id = (isset($get['id']))?$get['id']:$not_updt_id;
		        $where_clause = array('s.store_id' => $store_id);
		        $storeRs = $this->Store_model->get_store_details($where_clause);
		
		        if (!$storeRs) {
		            $this->session->set_flashdata('info_message', '<span class="error-alert">Store not available. Please try again later.</span>');
		            redirect('admin/store', "location");
		            exit();
		        		}
		        
		        $store 			 = $storeRs[0];
		        $data['store'] = $store;
		        
		         $where_clause 				= array('u.status'=>'1');
		         $where_in_utype_clause  = array('business_basic','business_pro','ADMIN');
		         										
    				$data['user'] 			= $this->User_model->get_users($where_clause,$where_in_utype_clause);
		         //$store_cond 			= array('s.status'=>'1','s.user_id'=>$deal->user_id);
		    		//$data['stores']		= $this->Common_model->fetch_stores($store_cond);
		    		$data['categories'] 	= $this->Common_model->fetch_category();
		    		//$data['country']  	= $this->Common_model->get_countries(array('status'=>'1'));
		    		$data['city']			= $this->Common_model->fetch_city('1');
		        
		       
     				$this->load->view('admin/store/edit_view', $data); 
    	}
    	
    public function update_store(){
    	
    			if(isset($_POST['store_id']) && !empty($_POST['store_id']) && isset($_POST['page_action']) && ($_POST['page_action'] == 'edit_store')) {
		        	
		        					 $this->form_validation->set_rules('user_id', 'User', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[255]|xss_clean');
					    			 $this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[255]|xss_clean');
					    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|max_length[255]|xss_clean');
									 $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|max_length[255]|xss_clean');    			 
					    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|max_length[30]|max_length[15]|xss_clean');
					    			 $this->form_validation->set_rules('website', 'Website', 'trim|required|max_length[200]|prep_url|xss_clean');
					    			 $this->form_validation->set_rules('tag_words', 'Tag Words', 'trim|required|max_length[255]|xss_clean');
    			 
					    			 $store_id = $this->input->post('store_id');
					    			 
					    			 $this->form_validation->set_error_delimiters('', '');
					    			 
					    			 if($this->form_validation->run() == FALSE) {
					    			 	
					    			 		$this->edit_store($store_id);
					    			 		}
					    			 		else{
    			 									$logo_img_name  = '';
    			 									
											  		  if(isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "")	{
															  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
															  $destination1 	= $this->config->item('store_image');
															  $pointer1     	= 'logo';
															  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
															  
															  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'600'  );
															  
													  			if( $ret1 != 'success' ) {
																		$this->session->set_flashdata('info_message',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/store/edit_store/store/id'.'/'.$store_id));	
																		exit;	
																		}
											  							else {
													 							$logo_img_name = $new_file_name1.".".$ext1;
													 							}
											 					}
											 					
													 	
														if( $this->Update_data_model->update_store($this->input->post('user_id'),$logo_img_name,$store_id) ) {
																$this->session->set_flashdata('info_message',"Campaign updated successfully");
																redirect(base_url('admin/store'));	
																exit;
																}
																else{
																		$this->session->set_flashdata('info_message',"Failed to update the Campaign, please try again.");
																		redirect(base_url('admin/store/edit_store/store/id'.'/'.$store_id));	
																		exit;	
																	 }
					    			 			  }
		        		}
						else {
								redirect(base_url('admin/store'));
								exit;
								}		        		
    			}
    
    
    //OK
    function delete() {
        $get = $this->uri->uri_to_assoc();

        //If no id found
        if (!isset($get['id'])) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
            redirect('admin/store', "location");
            exit();
        }
       $id = addslashes($get['id']);
       $idName = 'store_id';
       $tableName= $this->Store_model->store_table;
       
        $isDelete = $this->Common_model->delete_records($tableName, $idName, $id);
        if($isDelete){
             $this->session->set_flashdata('info_message', 'Records delete successfully');
        }
        else{
             $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
        }
        redirect('admin/store', "location");
        exit();
    }

}

 
