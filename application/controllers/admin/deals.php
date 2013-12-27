<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Deals extends CI_Controller {

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
        $this->load->model('Common_model');
        $this->load->model('admin/User_model');
        $this->load->model('Insert_data_model');
        $this->load->model('Update_data_model');
        $this->pageName = 'Manage Campaign';
        
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
    public function home() {
        $data['pageName'] = $this->pageName;
        
        //$whr_arr = array('d.status'=>'1');
        
        $userRS = $this->Deals_model->get_Deal_details();
        											//echo "<pre>"; print_r($userRS);exit;
        $data['userRS'] = $userRS;
        $this->load->view('admin/deals/listing_view', $data);    
    }
    
    public function subscriptions($user_id) {
        		$userRS = $this->User_model->get_subscription($user_id);
        		$data['userRS'] = $userRS;
            if(isset($userRS[0]->firstname) || isset($userRS[0]->lastname))
            $data['pageName'] = 'Subscription Of '.$userRS[0]->firstname.' '.$userRS[0]->lastname;
 			
            $this->load->view('admin/user/subscriptions', $data); 
    			}
    			
    public function deal_details($deal_id) {
        
        if(!isset($deal_id)){
            echo '<h5>Error in page. Please try again later.</h5>';
            exit();
        		}

        $userRS = $this->User_model->get_deals($deal_id);

        if(!$userRS) {
            echo '<h5>No records found..</h5>';
            exit();
        		}
        $user = $userRS[0];
        $data['user'] = $user;

        $this->load->view('admin/user/deal_details', $data); 
    	}
    	
    public function create_deal(){
    	
    		$where_clause = array('u.status'=>'1');
    		$where_in_utype_clause  = array('business_basic','ADMIN');
    		$data['user'] = $this->User_model->get_users($where_clause,$where_in_utype_clause);
    		
    		$store_cond = array('s.status'=>'1','s.user_id'=>'1');
    		$data['stores']		= $this->Common_model->fetch_stores($store_cond);
    		$data['categories'] = $this->Common_model->fetch_category();
    		$data['country']  = $this->Common_model->get_countries(array('status'=>'1'));
    		$data['city']		= $this->Common_model->fetch_city('1');

    		$this->load->view('admin/deals/add_view',$data);
    	}
    	
    public function add_deal() {
    	
    			if(isset($_POST['page_action']) && $_POST['page_action'] == 'add_deal'){
    			
    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|max_length[30]|max_length[15]|xss_clean');
    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[200]|prep_url|xss_clean');
    			 
    			 $this->form_validation->set_error_delimiters('', '');
    			 
    			 if($this->form_validation->run() == FALSE) {
    			 	
    			 		$this->create_deal();
    			 		}
    			 		else{
    			 					if( isset( $_FILES['img']['name'] ) && $_FILES['img']['name'] != "" ) {
										
											  $ext = array_pop(explode(".",$_FILES['img']['name']));
											  $destination = $this->config->item('deal_image');
											  $pointer     = 'img';
											  $new_file_name = md5($_FILES['img']['name'].time()); 
											  $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'600'  );
																							  
											  if( $ret == 'success' ) {
													  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
													  $destination1 	= $this->config->item('deal_image');
													  $pointer1     	= 'logo';
													  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
													  
													  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  );
													  
											  			if( $ret1 == 'success' ) {
													 	
																if( $this->Insert_data_model->save_campaign($this->input->post('user_id'),$new_file_name.".".$ext,$new_file_name1.".".$ext1,'basic','1') ) {
																		$this->session->set_flashdata('info_message',"Campaign uploaded successfully");
																		redirect(base_url('admin/deals'));	
																		exit;
																		}
																		else{
																				$this->session->set_flashdata('info_message',"Failed to upload the Campaign, please try again.");
																				redirect(base_url('admin/deals/create_deal'));	
																				exit;	
																			 }
																}
																else{
																		$this->session->set_flashdata('info_message',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/deals/create_deal'));	
																		exit;	
																		}
														}
														else{
																$this->session->set_flashdata('info_message',$ret);//"Failed to upload the Campaign, please try again."
																redirect(base_url('admin/deals/create_deal'));	
																exit;								
															}
												}
    			 			  }
    			}
    			else{
						$this->create_deal();    				
    				}
    	}
    	
    public function create_pro_deal(){
    	
    		$where_clause = array('u.status'=>'1');
			$where_in_utype_clause  = array('business_pro','ADMIN');
    		$data['user'] = $this->User_model->get_users($where_clause,$where_in_utype_clause);
    	
    		$store_cond = array('s.status'=>'1','s.user_id'=>'1');
    		$data['stores']		= $this->Common_model->fetch_stores($store_cond);
    		$data['categories'] = $this->Common_model->fetch_category();
    		$data['country']  = $this->Common_model->get_countries(array('status'=>'1'));
    		$data['city']		= $this->Common_model->fetch_city('1');

    		$this->load->view('admin/deals/add_pro_view',$data);
    	}
    	
    public function add_pro_deal() {
    	
    			if(isset($_POST['page_action']) && $_POST['page_action'] == 'add_pro_deal'){
    				
    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
    			 $this->form_validation->set_rules('campaign_url', 'Campaign Url', 'trim|required|max_length[200]|prep_url|xss_clean');
    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[30]|xss_clean');
    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|max_length[30]|max_length[15]|xss_clean');
    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[200]|prep_url|xss_clean');
    			 
    			 
    			 $this->form_validation->set_error_delimiters('', '');
    			 
    			 if($this->form_validation->run() == FALSE) {
    			 	
    			 		$this->create_pro_deal();
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
													  $destination1 	= $this->config->item('deal_image');
													  $pointer1     	= 'logo';
													  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
													  
													  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'600'  );
													  
											  			if( $ret1 == 'success' ) {
													 	
																if( $this->Insert_data_model->save_campaign($this->input->post('user_id'),'',$new_file_name1.".".$ext1,'pro') ) {
																		$this->session->set_flashdata('info_message',"Campaign uploaded successfully");
																		redirect(base_url('admin/deals'));	
																		exit;
																		}
																		else{
																				$this->session->set_flashdata('info_message',"Failed to upload the Campaign, please try again.");
																				redirect(base_url('admin/deals/create_pro_deal'));	
																				exit;	
																			 }
																}
																else{
																		$this->session->set_flashdata('info_message',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/deals/create_pro_deal'));	
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
														redirect(base_url('admin/deals/create_pro_deal'));	
													}
    			 			  }
    			}
    			else{
						$this->create_pro_deal();    				
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
    public function view() {
        $get = $this->uri->uri_to_assoc();
        if(!isset($get['id'])){
            echo '<h5>Error in page. Please try again later.</h5>';
            exit();
        }
        
        $deal_id = $get['id'];
        $where_clause = array('deals.id' => $deal_id);
        $userRS = $this->Deals_model->get_deals($where_clause);

        if(!$userRS) {
            echo '<h5>No records found..</h5>';
            exit();
        }
        $user = $userRS[0];

        $data['user'] = $user;
        
        echo "<pre>"; print_r($user); exit;

        $this->load->view('admin/deals/view_details', $data);    
        
    }
    
    /**
     *  Change Status
     */
     
     public function change_status() {
	     		$get = $this->uri->uri_to_assoc();
	     		
				if(!isset($get['id'])){
						redirect('admin/deals');
						exit;
					}     		
	     		$deal_id = $get['id']; 
	     		$this->Deals_model->update_status($deal_id);
	
	     		redirect('admin/deals');
	         exit();
	     		}
    
 
    
    /**
     *  Editing the content of the pages
     */
    public function edit_deal($not_updt_id = '') {  
		        $data['pageName'] = $this->pageName . ' : Edit Campaign';
		        $get = $this->uri->uri_to_assoc();
		        
		        //If no id found
		        if(!isset($get['id']) && $not_updt_id == ''){
		            $this->session->set_flashdata('info_message', '<span class="error-alert">No content found</span>');
		            redirect('admin/deals');
		            exit();
		        }
		        
		        $deal_id = (isset($get['id']))?$get['id']:$not_updt_id;
		        $where_clause = array('d.id' => $deal_id);
		        $dealRS = $this->Deals_model->get_Deal_details($where_clause);
		
		        if (!$dealRS) {
		            $this->session->set_flashdata('info_message', '<span class="error-alert">Campaign not available. Please try again later.</span>');
		            redirect('admin/deals', "location");
		            exit();
		        		}
		        
		        $deal 			 = $dealRS[0];
		        $data['deal'] = $deal;
		        
		         $store_cond 			= array('s.status'=>'1','s.user_id'=>$deal->user_id);
		    		$data['stores']		= $this->Common_model->fetch_stores($store_cond);
		    		$data['categories'] 	= $this->Common_model->fetch_category();
		    		$data['country']  	= $this->Common_model->get_countries(array('status'=>'1'));
		    		$data['city']			= $this->Common_model->fetch_city('1');
		        
		        if($deal->campaign_type == 'pro'){
			        		$where_clause 				= array('u.status'=>'1');
			         	$where_in_utype_clause  = array('business_pro','ADMIN');
	    					$data['user'] 				= $this->User_model->get_users($where_clause,$where_in_utype_clause);
	    					
			        		$this->load->view('admin/deals/edit_pro_view', $data);  
			        		}  
			        		else {
			        				$where_clause 				= array('u.status'=>'1');
						         $where_in_utype_clause  = array('business_basic','ADMIN');
				    				$data['user'] 				= $this->User_model->get_users($where_clause,$where_in_utype_clause);
			        				
			        				$this->load->view('admin/deals/edit_view', $data); 
			        				}   
    	}
    	
    public function update_campaign(){
    	
    			if(isset($_POST['deal_id']) && !empty($_POST['deal_id']) && isset($_POST['deal_type']) && ($_POST['deal_type'] == 'basic' || $_POST['deal_type'] == 'pro')) {
		        	
		        					 $deal_id   = $this->input->post('deal_id');
		        					 $deal_type = $this->input->post('deal_type');
		        					
		        					 
					    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
					    			 if($this->input->post('deal_type') == 'pro'){
					    			 		$this->form_validation->set_rules('campaign_url', 'Campaign Url', 'trim|required|max_length[200]|prep_url|xss_clean');
					    			 		}
					    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[30]|xss_clean');
					    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|max_length[30]|max_length[15]|xss_clean');
					    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[200]|prep_url|xss_clean');
					    			 
					    			 
					    			 $this->form_validation->set_error_delimiters('', '');
					    			 
					    			 if($this->form_validation->run() == FALSE) {
					    			 	//echo "goal"; exit;
					    			 	//echo "<pre>"; print_r(validation_errors());
					    			 		$this->edit_deal($deal_id);
					    			 		}
					    			 		else{
					    			 				$basic_img_name = '';
    			 									$logo_img_name  = '';
    			 									
    			 									//echo "hello"; exit;
    			 									
    			 									// for basic image upload
    			 									
    			 									if($this->input->post('deal_type') == 'basic' && isset( $_FILES['img']['name'] ) && $_FILES['img']['name'] != "" ){
									
															  $ext = array_pop(explode(".",$_FILES['img']['name']));
															  $destination = $this->config->item('deal_image');
															  $pointer     = 'img';
															  $new_file_name = md5($_FILES['img']['name'].time()); 
															  $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'232' );
																											  
															  if( $ret != 'success' ) { 

																		$this->session->set_flashdata('info_message',$ret);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/deals/edit_deal/deal/id'.'/'.$deal_id));	
																		exit;								
																		}
																		else {
																					$basic_img_name = $new_file_name.".".$ext;
																					}
																	}
													
											  		  if(isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "")	{
															  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
															  $destination1 	= $this->config->item('deal_image');
															  $pointer1     	= 'logo';
															  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
															  
															  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  );
															  
													  			if( $ret1 != 'success' ) {
																		$this->session->set_flashdata('info_message',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('admin/deals/edit_deal/deal/id'.'/'.$deal_id));	
																		exit;	
																		}
											  							else {
													 							$logo_img_name = $new_file_name1.".".$ext1;
													 							}
											 					}
											 					
													 	
														if( $this->Update_data_model->update_campaign($this->input->post('user_id'),$basic_img_name,$logo_img_name,$deal_id,$deal_type) ) {
																$this->session->set_flashdata('info_message',"Campaign updated successfully");
																redirect(base_url('admin/deals'));	
																exit;
																}
																else{
																	//echo "Hi"; exit;
																		$this->session->set_flashdata('info_message',"Failed to update the Campaign, please try again.");
																		redirect(base_url('admin/deals/edit_deal/deal/id'.'/'.$deal_id));	
																		exit;	
																	 }
					    			 			  }
		        		}
						else {
								redirect(base_url('admin/deals'));
								exit;
								}		        		
    			}
    
    
    
    function delete() {
        $get = $this->uri->uri_to_assoc();

        //If no id found
        if (!isset($get['id'])) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
            redirect('admin/deals', "location");
            exit();
        }
       $id = addslashes($get['id']);
       $idName = 'id';
       $tableName= $this->Deals_model->deal_table;
       
        $isDelete = $this->Common_model->delete_records($tableName, $idName, $id);
        if($isDelete){
             $this->session->set_flashdata('info_message', 'Records delete successfully');
        }
        else{
             $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
        }
        redirect('admin/deals', "location");
        exit();
    }

}

 