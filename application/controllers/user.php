<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class User extends CI_Controller {

    public  $is_logged_in;
    public  $user_session_id = 'user';
    private $secret_key = 'useriddailydrums';
    public $local_area = '';
    public $user_type = ''; 

    public function __construct() {
        
        parent::__construct();
    	
	 $this->load->library('session');
	 $this->load->library('Utils');
    $this->load->library('authmanager');
    $this->load->library('pagination'); 
    $this->load->model('Common_model');
	 $this->load->model('Login_model');
	 $this->load->model('Fetch_data_model');
	 $this->load->model('Common_model');
	 $this->load->model('Update_data_model');
	 $this->load->library('form_validation');
	 $this->load->model('Insert_data_model');
	 $this->load->model('admin/Deals_model');
        
    $this->is_logged_in = $this->authmanager->is_logged_in('user');
        
	if( $this->is_logged_in ) {

			$user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
			if(!$user_data->city)
					$local_area = 'zip: '.$user_data->zip;
					else
						$local_area = $user_data->city.", ".$user_data->state;

			if( strlen($local_area) > 23 ) {

				$local_area = substr( $local_area,0,20 )."...";
				}
			
			$this->user_type = $this->is_logged_in['user_type'];
			$this->local_area = $local_area;
		}
    }

    /**
     * Index Page for this controller.
     */
    public function index() {

			 if ($this->is_logged_in['user_id']) {
			     redirect(site_url('user/profile'));
			     }
			 
			$headerdata['page_title'] = 'Login To Daily Drums';
		     //   $headerdata['countryList'] = $this->Common_model->get_countries();
			// $this->session->unset_userdata('some_name');

			if( $this->session->flashdata( 'daily_drums_login_error') != '' ) 
					$headerdata['login_error'] = $this->session->flashdata( 'daily_drums_login_error');
				else
					$headerdata['login_error'] = '';
					
			if( $this->session->flashdata( 'last_email') != '' ) 
					$headerdata['last_email'] = $this->session->flashdata( 'last_email');
				else
					$headerdata['last_email'] = '';
					
			if( $this->session->flashdata( 'last_password') != '' ) 
					$headerdata['last_password'] = $this->session->flashdata( 'last_password');
				else
					$headerdata['last_password'] = '';

			//$headerdata['search_header'] = $this->load->view('front/common/search_header');								 
			$this->load->view('front/common/header', $headerdata);
			$this->load->view('front/common/menu_header', $headerdata);
			$this->load->view('front/login');
			$this->load->view('front/common/footer');
    	}
    	

  	public function login() {

			 if ($this->is_logged_in['user_id']) {
			     		redirect(site_url('user/profile'));
			     }
				else{
						$headerdata['logged_in'] = FALSE;
						 $headerdata['active_class'] = '';
					}

			$this->form_validation->set_rules('daily_drums_user_id', 'E-Mail', 'trim|required|valid_email|xss_clean|email');
			$this->form_validation->set_rules('daily_drums_password', 'Password', 'trim|required|xss_clean');

			if( $this->form_validation->run() == FALSE ){

					if( form_error('daily_drums_user_id') )
							$this->session->set_flashdata( 'daily_drums_login_error',form_error( 'daily_drums_user_id') );
						elseif( form_error('daily_drums_password') )
							$this->session->set_flashdata( 'daily_drums_login_error',form_error('daily_drums_password') );
					
					$this->session->set_flashdata('last_email',$this->input->post('daily_drums_user_id') );
					$this->session->set_flashdata('last_password',$this->input->post('daily_drums_password') );
	
					redirect('user');
					
					}
					else { 
							if( ( $data = $this->Login_model->authinticate_login() ) != FALSE  ) {

									$this->set_session_data( $data, 'user' ); 
									//echo  "Login Successfully";
									redirect(base_url('user/profile'));
								}
								else{
				
									 	$this->session->set_flashdata( 'daily_drums_login_error',"Wrong E-mail Id or Password." );
										$this->session->set_flashdata('last_email',$this->input->post('daily_drums_user_id') );
										$this->session->set_flashdata('last_password',$this->input->post('daily_drums_password') );

										redirect(base_url('user'));
										echo "Failed to login";
									 }						
						   }
		}

	public function profile() {
		
				if($this->is_logged_in['user_type'] != 'end_user')
						redirect(base_url('user/my_campaign'));

			   if ($this->is_logged_in['user_id']) {
			      		$headerdata['logged_in'] = TRUE;
							$headerdata['active_class'] = 'myaccount';
			      }
				else{
						 $headerdata['logged_in'] = FALSE;
						 $headerdata['active_class'] = '';
						redirect(site_url('user'));
					}
			 
			 $headerdata['page_title'] = 'Welcome To Dailydrums';
			 //$headerdata['search_header'] = $this->load->view('front/common/search_header');	 

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/account_view');
			 $this->load->view('front/common/footer');

		}	

	public function editprofile() {

			   if ( ($id = $this->is_logged_in['user_id']) ) {

			      		$headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'myaccount';					
			      }
				else{
						 $headerdata['logged_in'] = FALSE;
						 $headerdata['active_class'] = '';
						 redirect(site_url('user'));
					}

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
					
			 $user_data = $this->Fetch_data_model->fetch_user_data( $id );

			$headerdata['firstname'] 		  = ($user_data->firstname)?$user_data->firstname:'';
			$headerdata['lastname'] 		  = ($user_data->lastname)?$user_data->lastname:'';
			$headerdata['business_email'] = ($user_data->email)?$user_data->email:'';
			$headerdata['primary_phone']  = ($user_data->primary_phone)?$user_data->primary_phone:'';
			$headerdata['zip'] 			  = ($user_data->zip)?$user_data->zip:'';
			$headerdata['user_id'] 		  = $id;

			 $headerdata['page_title'] = 'Welcome To Dailydrums';
			//$headerdata['search_header'] = $this->load->view('front/common/search_header');

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/edit_account');
			 $this->load->view('front/common/footer');

		}	

	public function updateprofile() {
		
			if ( ($id = $this->is_logged_in['user_id']) ) {

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'myaccount';					
			      }
				else{
						 $headerdata['logged_in'] = FALSE;
						 $headerdata['active_class'] = '';
						 redirect(site_url('user'));
						}
						
			$user_data = $this->Fetch_data_model->fetch_user_data( $id );
			
			if( $user_data->email != trim($this->input->post('business_email')) )
				  $unique_field = "|is_unique[user.email]";
				  else 
				  		$unique_field ='';

			$this->form_validation->set_rules('business_email', 'Legal Email', 'trim|required|valid_email|xss_clean|email'.$unique_field);
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('primary_phone', 'phone', 'integer|trim|required|max_length[15]|xss_clean');	
			$this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
			$this->form_validation->set_error_delimiters('*', '');
			
			if( $this->form_validation->run() == FALSE ){
					$this->editprofile();
					}
					else {
							$this->Update_data_model->update_profile($id);
							//$this->session->set_userdata();
							$this->session->set_flashdata( 'action_msg',"Profile Updated Successfully." );
							redirect(base_url('user/editprofile'));					
							}
		}

	public function changepassword() {

			   if ( ($id = $this->is_logged_in['user_id']) ) {

			      		$headerdata['logged_in'] = TRUE;
							$headerdata['active_class'] = 'myaccount';					
			      }
				else{
						 $headerdata['logged_in'] = FALSE;
						 $headerdata['active_class'] = '';
						 redirect(site_url('user'));
					}

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['error_msg']   = ( $this->session->flashdata('error_msg') != '' )?$this->session->flashdata('error_msg'):'';
					
			 //$user_data = $this->Fetch_data_model->fetch_user_data( $id );

			 $headerdata['user_id'] 		  = $id;

			 $headerdata['page_title'] = 'Welcome To Dailydrums';
			 //$headerdata['search_header'] = $this->load->view('front/common/search_header');
	 
			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/change_password');
			 $this->load->view('front/common/footer');
		}


	public function updatepassword() {

			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|max_length[15]|min_length[8]xss_clean');
			$this->form_validation->set_rules('new_password_again', 'Confirm Password', 'trim|required|max_length[15]|min_length[8]|xss_clean');
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|max_length[15]|xss_clean');
			$this->form_validation->set_error_delimiters('*', '');
			if( $this->form_validation->run() == FALSE ){

					$this->changepassword();
				}
				else {
						$new_password     = $this->input->post('new_password');
						$confirm_password = $this->input->post('new_password_again');
						$old_password     = $this->input->post('old_password');

						if( $new_password != $confirm_password ) {

								$this->session->set_flashdata( 'error_msg',"Both The Password Has Not Matched." );
								redirect(base_url('user/changepassword'));
							}
							else {
								
										$email = $this->is_logged_in['email'];
										
										if( $this->Fetch_data_model->authinticate_login($email,$old_password) != false ){
											
												$this->Update_data_model->update_password();
												$this->session->set_flashdata( 'action_msg',"Password Updated Successfully." );
												redirect(base_url('user/changepassword'));
											}
											else{
												
														$this->session->set_flashdata( 'error_msg',"Old Password Is Incorrect." );
														$this->session->set_flashdata('action','0');	
														redirect(base_url('user/changepassword'));
												}
										
										
										
								
									  }					
					}
		}


	public function settings() {

			if ($this->is_logged_in['user_id']) {
			      		$headerdata['logged_in'] = TRUE;
			    }
				else{
						 $headerdata['logged_in'] = FALSE;
						redirect(base_url());
					}
				
			 $headerdata['page_title'] = 'Settings';
			 //$headerdata['search_header'] = $this->load->view('front/common/search_header');

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/user/settings_view');
			 $this->load->view('front/common/footer');
		  
	    	}

	public function update_local_area() {

			$ret = array('flag'=>0,"desc"=>'');

			if ( !$this->is_logged_in['user_id'] ) {
			      		
					$ret['desc'] = "Failed To update.";
					}
					else {

							$this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[15]|xss_clean');
							$this->form_validation->set_rules('state', 'State', 'trim|required|max_length[15]|xss_clean');
							$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[15]|xss_clean');
							$this->form_validation->set_error_delimiters('', '');
							if( $this->form_validation->run() == FALSE ){

									$ret['desc'] =  "Some Fields are blank.";
								}
								else {

										  if( $this->Update_data_model->update_local_area($this->is_logged_in['user_id']) ) {

													$ret['desc'] = "Local Area Update Successfully.";
													$ret['flag'] = '1';
												}
												else{

														$ret['desc'] = "Updation Aborted.";
													}
									   }
					}
				echo json_encode($ret);
				exit;
		}
		
	public function forget_password() {

				$ret = array();
				$ret['flag'] = '0';
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email');
				if( $this->form_validation->run() == FALSE ){
					
						$ret['msg']  = "Provide Your Valid Email";
					}
					else{ 
								$email = $this->input->post('email');
								if( ! ( $user_data = $this->Fetch_data_model->fetch_user_data('',$email,'','1') ) ) {
									
											$ret['msg']  = "Email Id Not Found ";
										}
										else{
												  //email fielda
												  $change_password_link = base_url('user')."/password_reset/".md5(trim($email));
										        $to = trim($email);
										        $subject = 'Change Password Link';
										        $fromemail = 'noreply@dailydrums.com.com';
										        $fromname = 'Dailydrums';
										        $data['change_password_link'] = $change_password_link;
										        $data['username'] = $user_data->display_name;
										        $msg = $this->load->view('email_templates/user_forgot_template',$data,TRUE);

										        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
										        
													$ret['flag'] = '1';
													$ret['msg']  = $change_password_link;
											}
						}
					echo json_encode($ret);
					exit;		
		}
		
	public function password_reset() {
		
					if( $this->input->post('new_password') != '' ) {  			// AFTER PROVIDE THE NEW PASSWORD
							
								$ret = array('flag'=>'0');
					
								$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|max_length[15]|min_length[8]|xss_clean');
								$this->form_validation->set_rules('new_password_again', 'Confirm Password', 'trim|required|max_length[15]|min_length[8]|xss_clean');
								$this->form_validation->set_error_delimiters('*', '');
								
								if( $this->form_validation->run() == FALSE ){
					
										$this->session->set_flashdata('action_msg',"Provide Password Properly");
										$this->session->set_flashdata('action','0');	
										redirect(base_url('password_reset'));
										exit;
									}
									else {
										
											$new_password = $this->input->post('new_password');
											$confirm_password = $this->input->post('new_password_again');
					
											if( $new_password != $confirm_password ) {
					
													$this->session->set_flashdata('action_msg',"Both The Password Has Not Matched.");
													$this->session->set_flashdata('action','0');	
													redirect(base_url('password_reset'));
													exit;
												}
												else {
															$encoded_email = $this->input->post('encoded_email');
															$user_data = $this->Fetch_data_model->fetch_user_data('','',$encoded_email);
															
															if( $user_data ){
															
																	$this->Update_data_model->reset_password($encoded_email);
																	$this->session->set_flashdata( 'action_msg',"Password Updated Successfully." );
																	$this->session->set_flashdata( 'action',"1" );
																	redirect(base_url('user'));
																	exit;
															
																}else{
																	
																			$this->session->set_flashdata('action_msg',"Please follow the link, have been provided to you");
																			$this->session->set_flashdata('action','0');																			
																			redirect(base_url('user'));
																			exit;
																	}
														  }					
										}
						}
						else {
							
									$encoded_email = $this->uri->segment(3);
									
									$user_data = $this->Fetch_data_model->fetch_user_data('','',$encoded_email);
															
									if( !$user_data ){
										
											$this->session->set_flashdata('action_msg',"Please follow the link, have been provided to you");
											$this->session->set_flashdata('action','0');											
											redirect(base_url('user'));
											exit;
										}
					
									$headerdata['encoded_email'] = $encoded_email;								 
									$this->load->view('front/common/header', $headerdata);
									$this->load->view('front/common/menu_header', $headerdata);
									$this->load->view('front/forget_password');
									$this->load->view('front/common/footer');
							  }
		}
		
		
		
		public function get_zip(){
    	
    		$city_name = $this->input->post('city_name');
    		
    	   $zip = $this->Common_model->fetch_zip_by_city('1','',$city_name);
    	   //echo "<pre>"; print_r($zip);
			echo json_encode($zip);
    	   exit;   		
    	}
    	
    	public function get_location_of_store(){
    		
    		$store_id = $this->input->post('store_id');
    		$whr_arr = array('s.store_id'=>$store_id);
    	   $store = $this->Common_model->fetch_stores($whr_arr);
    	  // echo "<pre>"; print_r($store[0]); exit;
			echo json_encode($store[0]);
    	   exit;
    		}
		
			
		
	public function create_store() {
		
				if ( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'store';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 $headerdata['page_title'] = 'Create Store';
			 
			 //$headerdata['category'] = $this->Common_model->fetch_category();
			 $headerdata['city']		= $this->Common_model->fetch_city('1');

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/create_store');
			 $this->load->view('front/common/footer');
		}
		
	public function save_store() {
		
				if ( ($id = $this->is_logged_in['user_id']) ) {

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'store';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						}
    	
    			if(isset($_POST['page_action']) && $_POST['page_action'] == 'save_store'){
    				
    			 if (empty($_FILES['logo']['name'])){
							    $this->form_validation->set_rules('logo', 'Image Logo', 'required');
								 }
								 else{
								 			$type = explode('/',$_FILES['logo']['type']);
								 			if($type[0] != 'image')
								 					$this->form_validation->set_rules('logo', 'Image type of file for Logo', 'required');
								 		}
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
											  					$user_id = $this->is_logged_in['user_id'];
													 	
																if( $this->Insert_data_model->save_store($id,$new_file_name1.".".$ext1) ) {
																		$this->session->set_flashdata('action_msg',"Store Created successfully");
																		$this->session->set_flashdata('action','1');																		
																		redirect(base_url('user/create_store'));	
																		exit;
																		}
																		else{
																				$this->session->set_flashdata('action','0');	
																				$this->session->set_flashdata('action_msg',"Failed to Create the Store, please try again.");
																				redirect(base_url('user/create_store'));	
																				exit;	
																			 }
																}
																else{
																		$this->session->set_flashdata('action','0');	
																		$this->session->set_flashdata('action_msg',$ret1);//"Failed to upload the Campaign, please try again."
																		redirect(base_url('user/create_store'));	
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
														$this->session->set_flashdata('action','0');	
														$this->session->set_flashdata('action_msg',"Plese select a file for logo, please try again.");
														redirect(base_url('user/create_store'));	
													}
    			 			  }
    			}
    			else{
						$this->create_store();    				
    				}
    	}
    	
   public function my_subscribers() {
		
				if ( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_subscribers';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
			$headerdata['page_title'] = 'My Subscribers';
			

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 // if store requested for selection
			 if( $this->uri->segment(3) == 'store' && $this->uri->segment(4) != '' && is_numeric($this->uri->segment(4)) ) {

						$headerdata['requested_store_id'] = $this->uri->segment(4);
						}
						
			 $headerdata['selected_tab'] = 'p';
			 if( $this->uri->segment(5) == 'selected_tab' && $this->uri->segment(6) != '' ) {

						$headerdata['selected_tab'] = $this->uri->segment(6);
						}		
			
			//echo $headerdata['selected_tab'];					
			 $store_cond 					= array( 'user_id'=>$id );
			 $headerdata['stores']     = $this->Common_model->fetch_stores( $store_cond );
			 
			 // if no store requested for selection
			 if(!isset($headerdata['requested_store_id']))
			 			$headerdata['requested_store_id'] = $headerdata['stores'][0]->store_id;
			 
			 // For fetch subscribers list and extract active and pending subcribers.	
			 $headerdata['active_subscribers']  = false;
			 $headerdata['pending_subscribers'] = false;		
			 if( ( $subscription_list = $this->Common_model->fetch_subscribers_list( $headerdata['requested_store_id'],$id ) ) ) {
			 	
			 				foreach( $subscription_list as $subscribeer ) {
			 						
			 						if( $subscribeer->status == '1' ) {
			 							$headerdata['active_subscribers'][]  = $subscribeer;
			 							}
			 							else {
			 									$headerdata['pending_subscribers'][]  = $subscribeer;
			 								   }
			 						}
			 						
			 				/*$config['base_url']   = base_url('user/my_subscribers');
			 				$config['total_rows'] = this->Common_model->fetch_subscribers_list( $headerdata['requested_store_id'],$id )->num_rows();
							$config['per_page'] = 1;
							$config['num_links'] = 2;	
							$this->pagination->initialize($config);		*/				
										 			
			 			}
			 			
			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/my_subscribers');
			 $this->load->view('front/common/footer');
		}


	   public function analytics() {
		
				if ( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'analytic';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
			$headerdata['page_title'] = 'My Analytic';
			

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 // if store requested for selection
			 $headerdata['analytic_type'] = 'click';
			 if( $this->uri->segment(3) == 'store' && $this->uri->segment(4) != '' && is_numeric($this->uri->segment(4)) ) {

						$headerdata['requested_store_id'] = $this->uri->segment(4);
						if($this->uri->segment(5) == '' )
							$headerdata['analytic_type'] = 'click';
							else
								$headerdata['analytic_type'] =  $this->uri->segment(5);
						}
						
			 $headerdata['selected_tab'] = 'p';
			 if( $this->uri->segment(5) == 'selected_tab' && $this->uri->segment(6) != '' ) {

						$headerdata['selected_tab'] = $this->uri->segment(6);
						}		
			
			//echo $headerdata['selected_tab'];					
			 $store_cond 					= array( 'user_id'=>$id );
			 $headerdata['stores']     = $this->Common_model->fetch_stores( $store_cond );
			 
			 // if no store requested for selection
			 if(!isset($headerdata['requested_store_id']))
			 			$headerdata['requested_store_id'] = $headerdata['stores'][0]->store_id;

			if( $headerdata['analytic_type'] == 'click'){

				$headerdata['click_rate_months'] =  $this->Common_model->click_rate_months($headerdata['requested_store_id']);
				$headerdata['click_rate_weeks'] =  $this->Common_model->click_rate_weeks($headerdata['requested_store_id']);
				//echo "<pre>"; print_r($headerdata['click_rate_weeks']); exit;
				}
			 
			 // For fetch subscribers list and extract active and pending subcribers.	
			 $headerdata['active_subscribers']  = false;
			 $headerdata['pending_subscribers'] = false;		

			//echo"<pre>"; print_r($headerdata); exit;
			 			
			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/analytic');
			 $this->load->view('front/common/footer');
		}
	
	// remove subscribers from store subscription	
	public function remove_subscribers(){
		
			$subscribers = $this->input->post('active_subscriber');			
			if( $subscribers && $this->Common_model->delete_store_subscriber( $subscribers ) ) {
							
						$this->session->set_flashdata('action_msg',"Subscribers removed successfully");
						$this->session->set_flashdata('action',"0");
						redirect( base_url( 'user/my_subscribers/store/'.$this->uri->segment( 4 )."/selected_tab/a" ) );
						}
						else {
								 $this->session->set_flashdata('action_msg',"No subscribers selected");
								 $this->session->set_flashdata('action',"0");
								 redirect( base_url( 'user/my_subscribers/store/'.$this->uri->segment( 4 ) ) );
								}
			}
	
	
	// Confirm subscribers in store subscription		
	public function confirm_subscribers(){
		
			$subscribers = $this->input->post('pending_subscriber');			
			if( $subscribers && $this->Common_model->confirm_store_subscriber( $subscribers ) ) {
							
						$this->session->set_flashdata('action_msg',"Subscriber(s) has been active");
						$this->session->set_flashdata('action',"0");
						
						redirect( base_url( 'user/my_subscribers/store/'.$this->uri->segment( 4 )."/selected_tab/a" ) );
						}
						else {
								 $this->session->set_flashdata('action_msg',"No subscribers selected");
								 $this->session->set_flashdata('action',"0");
								 redirect( base_url( 'user/my_subscribers/store/'.$this->uri->segment( 4 ) ) );
								}
			}
			
	public function my_account(){
		
			if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
			 $headerdata['page_title'] = 'My Account';

			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 $headerdata['userData'] = $this->Fetch_data_model->fetch_user_data($id);
			 $headerdata['countryList'] = $this->Common_model->get_countries(array('status'=>'1'));
			 
			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 $this->load->view('front/account_business_view');
			 $this->load->view('front/common/footer');
		}
		
	public function update_sign_info(){
				if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
				 $user_data = $this->Fetch_data_model->fetch_user_data( $id );
			
				 if( $user_data->email != trim($this->input->post('email')) )
					   $unique_field = "|is_unique[user.email]";
					   else 
					  		 $unique_field ='';
					  		 
				 $this->form_validation->set_rules('user_name', 'Name', 'trim|required|max_length[30]|xss_clean');
				 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email'.$unique_field);
				 //$this->form_validation->set_rules('email_again', 'Retype Email', 'trim|required|valid_email|xss_clean|email|matches[email]');
				 $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|min_length[8]|xss_clean');
				 $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|max_length[30]|min_length[8]|xss_clean|matches[password]');									 
				 
				 $this->form_validation->set_error_delimiters("# ","");
				 if($this->form_validation->run() == FALSE) {
				 	
				 		$this->session->set_flashdata('action_msg',validation_errors());
				 		$this->session->set_flashdata('action_form','sign_info');
						$this->session->set_flashdata('action','0');
						redirect(base_url('user/my_account'));
						exit;
				 		//$this->my_account();
					 	}	
					 	else{
								$dataArray['user_name'] = $this->input->post('user_name');
								$dataArray['email']     = $this->input->post('email');		
								$dataArray['password']  = $this->input->post('password');	
								
								if( $this->Common_model->update_sign_info($dataArray,$id) ){	
										$this->session->set_flashdata('action_msg',"Sign-in information updated successfully");
										$this->session->set_flashdata('action','1');
										$this->session->set_flashdata('action_form','sign_info');
										redirect(base_url('user/my_account'));
										}
										else{
												$this->session->set_flashdata('action_msg',"Failed to update sign-in information");
												$this->session->set_flashdata('action','0');
												$this->session->set_flashdata('action_form','sign_info');
												redirect(base_url('user/my_account'));
												}	
					 		  }  
					
 				/* $this->form_validation->set_rules('phone_primary', 'phone primary', 'integer|trim|required|max_length[15]|xss_clean');									 
				 $this->form_validation->set_rules('card_name', 'Card Name ', 'trim|required|max_length[50]|xss_clean');
				 $this->form_validation->set_rules('card_number', 'Card Number ', 'trim|required|max_length[30]|xss_clean');
				 $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required|max_length[10]|xss_clean');
					*/				
			}
			
	public function update_business_info(){
		
				if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
					  		 
				 $this->form_validation->set_rules('legal_name', 'Legal Name', 'trim|required|max_length[30]|xss_clean');
				 $this->form_validation->set_rules('business_email', 'Business Email', 'trim|required|valid_email|xss_clean|email');
				 
				 $this->form_validation->set_error_delimiters("# ","");
				 if($this->form_validation->run() == FALSE) {
				 	
				 		$this->session->set_flashdata('action_msg',validation_errors());
				 		$this->session->set_flashdata('action_form','business_info');
						$this->session->set_flashdata('action','0');
						redirect(base_url('user/my_account'));
						exit;
				 		//$this->my_account();
					 	}	
					 	else{
								$dataArray['legal_name']     = $this->input->post('legal_name');
								$dataArray['business_email'] = $this->input->post('business_email');		
																
								if( $this->Common_model->update_business_info($dataArray,$id) ){	
										$this->session->set_flashdata('action_msg',"Business information updated successfully");
										$this->session->set_flashdata('action','1');
										$this->session->set_flashdata('action_form','business_info');
										redirect(base_url('user/my_account'));
										}
										else{
												$this->session->set_flashdata('action_msg',"Failed to update Business information");
												$this->session->set_flashdata('action','0');
												$this->session->set_flashdata('action_form','business_info');
												redirect(base_url('user/my_account'));
												}	
					 		  }
		}
		
	public function update_membership_info(){
		
				if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
						  
				 $user_data = $this->Fetch_data_model->fetch_user_data( $id );
			
				 if( strtoupper($user_data->display_name) != strtoupper(trim($this->input->post('display_name'))) )
					   $unique_field = "|is_unique[user_profile.display_name]";
					   else 
					  		 $unique_field ='';
					  		 
				 $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|max_length[30]|xss_clean'.$unique_field);
				 
				 $this->form_validation->set_error_delimiters("# ","");
				 if($this->form_validation->run() == FALSE) {
				 	
				 		$this->session->set_flashdata('action_msg',validation_errors());
				 		$this->session->set_flashdata('action_form','membership_info');
						$this->session->set_flashdata('action','0');
						redirect(base_url('user/my_account'));
						exit;
				 		//$this->my_account();
					 	}	
					 	else{
								$dataArray['display_name'] = $this->input->post('display_name');
																
								if( $this->Common_model->update_membership_info($dataArray,$id) ){	
										$this->session->set_flashdata('action_msg',"Membership information updated successfully");
										$this->session->set_flashdata('action','1');
										$this->session->set_flashdata('action_form','membership_info');
										redirect(base_url('user/my_account'));
										}
										else{
												$this->session->set_flashdata('action_msg',"Failed to update Membership information");
												$this->session->set_flashdata('action','0');
												$this->session->set_flashdata('action_form','membership_info');
												redirect(base_url('user/my_account'));
												}	
					 		  }
		}
		
	public function update_address_info(){
		
				if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
									  		 
				 $this->form_validation->set_rules('address_line1', 'Address Line 1', 'trim|required|max_length[255]|xss_clean');									 
				 $this->form_validation->set_rules('address_line2', 'Address Line 2', 'trim|required|max_length[255]|xss_clean');										 
				 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[50]|xss_clean');
				 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
				 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[50]|xss_clean');
				 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
				 $this->form_validation->set_rules('primary_phone', 'Primary Phone', 'integer|trim|required|max_length[15]|xss_clean');
				 
				 $this->form_validation->set_error_delimiters("# ","");
				 if($this->form_validation->run() == FALSE) {
				 	
				 		$this->session->set_flashdata('action_msg',validation_errors());
				 		$this->session->set_flashdata('action_form','address_info');
						$this->session->set_flashdata('action','0');
						redirect(base_url('user/my_account'));
						exit;
				 		//$this->my_account();
					 	}	
					 	else{
								$dataArray['address_line1'] = $this->input->post('address_line1');
								$dataArray['address_line2'] = $this->input->post('address_line2');
								$dataArray['city'] 			 = $this->input->post('city');
								$dataArray['zip'] 			 = $this->input->post('zip');
								$dataArray['state'] 			 = $this->input->post('state');
								$dataArray['country'] 		 = $this->input->post('country');
								$dataArray['primary_phone'] = $this->input->post('primary_phone');
																
								if( $this->Common_model->update_address_info($dataArray,$id) ){	
										$this->session->set_flashdata('action_msg',"Address details updated successfully");
										$this->session->set_flashdata('action','1');
										$this->session->set_flashdata('action_form','address_info');
										redirect(base_url('user/my_account'));
										}
										else{
												$this->session->set_flashdata('action_msg',"Failed to update Address details");
												$this->session->set_flashdata('action','0');
												$this->session->set_flashdata('action_form','address_info');
												redirect(base_url('user/my_account'));
												}	
					 		  }
		}
		
		
	public function update_card_info(){
		
				if( ($id = $this->is_logged_in['user_id']) ){

			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_account';					
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						  }
									  		 
				 $this->form_validation->set_rules('card_name', 'Card Name', 'trim|required|max_length[255]|xss_clean');									 
				 $this->form_validation->set_rules('cc_number', 'Credit Card Number', 'trim|required|max_length[19]|xss_clean');										 
				 $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required|max_length[10]|xss_clean');
				 
				 $this->form_validation->set_error_delimiters("# ","");
				 if($this->form_validation->run() == FALSE) {
				 	
				 		$this->session->set_flashdata('action_msg',validation_errors());
				 		$this->session->set_flashdata('action_form','card_info');
						$this->session->set_flashdata('action','0');
						redirect(base_url('user/my_account'));
						exit;
				 		//$this->my_account();
					 	}	
					 	else{
								$dataArray['card_name']     = $this->input->post('card_name');
								$dataArray['cc_number']     = $this->input->post('cc_number');
								$dataArray['security_code'] = $this->input->post('security_code');
																
								if( $this->Common_model->update_card_info($dataArray,$id) ){	
										$this->session->set_flashdata('action_msg',"Card details updated successfully");
										$this->session->set_flashdata('action','1');
										$this->session->set_flashdata('action_form','card_info');
										redirect(base_url('user/my_account'));
										}
										else{
												$this->session->set_flashdata('action_msg',"Failed to update Card details");
												$this->session->set_flashdata('action','0');
												$this->session->set_flashdata('action_form','card_info');
												redirect(base_url('user/my_account'));
												}	
					 		  }
		}
	
			
	public function my_campaign(){
			
			if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';	
					$headerdata['active_sub_class'] = 'all';
					
					if($this->uri->segment(3) == 'drafts'){
							$headerdata['active_sub_class'] = 'drafts';
							$headerdata['view_page'] = 'Drafts';
							$whr_deals = array('d.user_id'=>$id, 'd.status'=>'2');
							}
							elseif($this->uri->segment(3) == 'scheduled'){
									$headerdata['active_sub_class'] = 'scheduled';
									$headerdata['view_page'] = 'Scheduled';
									$whr_deals = array('d.user_id'=>$id, 'd.status'=>'3');
									}
									elseif($this->uri->segment(3) == 'active'){
											$headerdata['active_sub_class'] = 'active';
											$headerdata['view_page'] = 'Active';
											$whr_deals = array('d.user_id'=>$id, 'd.status'=>'1');
											}
											else{
													$headerdata['view_page'] = 'All';
													$whr_deals = array('d.user_id'=>$id, 'd.status !='=>'0');
													}				
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
			$headerdata['deals'] = $this->Deals_model->get_Deal_details($whr_deals);
						 
			$this->load->view('front/common/header', $headerdata);
			$this->load->view('front/common/menu_header', $headerdata);
			$this->load->view('front/my_campaign');
			$this->load->view('front/common/footer');
		}
			
			
	public function create_campaign() {
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 $headerdata['page_title'] = 'Create Campaign';
			 
			 $store_cond = array('s.status'=>'1','s.user_id'=>$id);
			 
    		 $headerdata['stores']	 = $this->Common_model->fetch_stores($store_cond);
			 $headerdata['categories'] = $this->Common_model->fetch_category();
			 $headerdata['country']  = $this->Common_model->get_countries(array('status'=>'1'));
			 $headerdata['city']		 = $this->Common_model->fetch_city('1');

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 
			 if ( ($user_type = $this->is_logged_in['user_type']) == 'business_basic' ){
						$this->load->view('front/create_basic_campaign');
				 		}
				 		elseif( ($user_type = $this->is_logged_in['user_type']) == 'business_pro' ){
				 				$this->load->view('front/create_pro_campaign');
				 			  }
				 			  else {
				 			  		redirect('user');
				 			  	}
			 $this->load->view('front/common/footer');
		}
		
		
	public function campaign_basic_upload(){
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
				if($_POST['campaign_status'] == 'save' || $_POST['campaign_status'] == 'schedule' || $_POST['campaign_status'] == 'post')
						{
							 if($_FILES['logo']['name'] == ''){
							 	$_POST['check_logo'] = '';
							 	}
							 	else{
							 			$_POST['check_logo'] = 'ok';
							 		}
							 		
							 if($_FILES['img']['name'] == ''){
							 	$_POST['check_img'] = '';
							 	}
							 	else{
							 			$_POST['check_img'] = 'ok';
							 		}
									
			    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('check_logo', 'Logo File', 'trim|required|xss_clean');
			    			 $this->form_validation->set_rules('check_img', 'Image File', 'trim|required|xss_clean');    			 
			    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
			    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
			    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]|xss_clean');
			    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');
			    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[255]|prep_url|xss_clean');
			    			 
			    			 $this->form_validation->set_error_delimiters('* ', '');
			    			 
			    			 if($this->form_validation->run() == FALSE) {
			    			 	//echo validation_errors();
			    			 
			    			 		$this->create_campaign();
			    			 		}
			    			 		else{
			    			 			//echo "OK COMING "; exit;
			    			 					if( isset( $_FILES['img']['name'] ) && $_FILES['img']['name'] != "" ) {
													
														  $ext = array_pop(explode(".",$_FILES['img']['name']));
														  $destination = $this->config->item('deal_image');
														  $pointer     = 'img';
														  $new_file_name = md5($_FILES['img']['name'].time()); 
														  $ret = $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'232'  );
																										  
														  if( $ret == 'success' ) {
																  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
																  $destination1 	= $this->config->item('deal_image');
																  $pointer1     	= 'logo';
																  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
																  
																  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  );
																  
														  			if( $ret1 == 'success' ) {
																 	
																			if( $this->Insert_data_model->save_campaign($id,$new_file_name.".".$ext,$new_file_name1.".".$ext1,'basic') ) {
																						
																						if($this->input->post('campaign_status') == 'save')
																							$msg = "Campaign has been saved successfully.";	
																							elseif($this->input->post('campaign_status') == 'save')
																								$msg = "Campaign has been scheduled successfully.";
																								else 
																									$msg = "Campaign has been uploaded successfully.";	
																																							
																					$this->session->set_flashdata('action_msg',$msg);
																					$this->session->set_flashdata('action','1');	
																					redirect(base_url('user/create_campaign'));	
																					exit;
																					}
																					else{
																							$this->session->set_flashdata('action_msg',"Failed to upload the Campaign, please try again.");
																							$this->session->set_flashdata('action','0');	
																							redirect(base_url('user/create_campaign'));	
																							exit;	
																						 	}
																			}
																			else{
																					$this->session->set_flashdata('action_msg',$ret1);
																					$this->session->set_flashdata('action','0');	
																					redirect(base_url('user/create_campaign'));	
																					exit;	
																					}
																	}
																	else{
																			$this->session->set_flashdata('action_msg',$ret);
																			$this->session->set_flashdata('action','0');	
																			redirect(base_url('user/create_campaign'));	
																			exit;								
																			}
															}
															else{
							    			 			  			$this->session->set_flashdata('action_msg',"Please provide a campaign image.");
																	$this->session->set_flashdata('action','0');	
																	redirect(base_url('user/create_campaign'));	
																	exit;	
							    			 			  			}
			    			 			  }
							}    			 			  
		}
		
	public function campaign_pro_upload(){
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
				if($_POST['campaign_status'] == 'save' || $_POST['campaign_status'] == 'schedule' || $_POST['campaign_status'] == 'post')
						{
								 if( $_FILES['logo']['name'] == ''){
								 	$_POST['check_logo'] = '';
								 	}
								 	else{
								 			$_POST['check_logo'] = 'ok';
								 		}
									
				    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('check_logo', 'Listing Image', 'trim|required|xss_clean');
				    			 $this->form_validation->set_rules('campaign_url', 'Campaign Url', 'trim|required|max_length[255]|prep_url|xss_clean');    			 
				    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
				    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
				    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]|xss_clean');
				    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');
				    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[255]|prep_url|xss_clean');
				    			 
				    			 $this->form_validation->set_error_delimiters('* ', '');
				    			 
				    			 if($this->form_validation->run() == FALSE) {
				    			 	//echo validation_errors();
				    			 
				    			 		$this->create_campaign();
				    			 		}
				    			 		else{
				    			 			//echo "OK COMING "; exit;
				    			 					if( isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "" ) {
														
																	  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
																	  $destination1 	= $this->config->item('deal_image');
																	  $pointer1     	= 'logo';
																	  $new_file_name1  = md5($_FILES['logo']['name'].time()); 
																	  
																	  $ret1 = $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  );
																	  
															  			if( $ret1 == 'success' ) {
																	 	
																				if( $this->Insert_data_model->save_campaign($id,'',$new_file_name1.".".$ext1,'pro') ) {
																							
																							if($this->input->post('campaign_status') == 'save')
																								$msg = "Campaign has been saved successfully.";	
																								elseif($this->input->post('campaign_status') == 'save')
																									$msg = "Campaign has been scheduled successfully.";
																									else 
																										$msg = "Campaign has been uploaded successfully.";	
																																								
																						$this->session->set_flashdata('action_msg',$msg);
																						$this->session->set_flashdata('action','1');	
																						redirect(base_url('user/create_campaign'));	
																						exit;
																						}
																						else{
																								$this->session->set_flashdata('action_msg',"Failed to upload the Campaign, please try again.");
																								$this->session->set_flashdata('action','0');	
																								redirect(base_url('user/create_campaign'));	
																								exit;	
																							 	}
																				}
																				else{
																						$this->session->set_flashdata('action_msg',$ret1);
																						$this->session->set_flashdata('action','0');	
																						redirect(base_url('user/create_campaign'));	
																						exit;	
																						}
																}
																else{
								    			 			  			$this->session->set_flashdata('action_msg',"Please provide a campaign image.");
																		$this->session->set_flashdata('action','0');	
																		redirect(base_url('user/create_campaign'));	
																		exit;	
								    			 			  			}
				    			 			  }
    			 			  
    			 			 }
    			 			 else{
									redirect(base_url('user/create_campaign'));	
									exit;	
    			 			 		}
		}
		
		
	public function edit_campaign($campaign_id) {
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
			
			 $deal_id = $this->uri->segment(3);		 
			 if($deal_id == '' || !(is_numeric($deal_id))){
			 	redirect(site_url('user'));
			 	exit;
			 	}
			 	else{
			 			$whr_deals = array('d.id' => $deal_id, 'd.user_id' => $id);
			 			$deal_details = $this->Deals_model->get_Deal_details($whr_deals);
			 			if(!$deal_details){
			 				  $this->session->set_flashdata('action_msg',"Campaign not found");
			 				  $this->session->set_flashdata('action','0');
				 			  redirect(site_url('user'));
				 			  exit;
			 				  }
			 				  else{
			 				  		 $headerdata['deal_details'] = $deal_details[0];
			 				  		 }
			 		  }


			 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
			 $headerdata['action']     = ( $this->session->flashdata('action') != '' )?$this->session->flashdata('action'):'';
			 
			 $headerdata['page_title'] = 'Edit Campaign';
			 
			 $store_cond = array('s.status'=>'1','s.user_id'=>$id);
			 
    		 $headerdata['stores']	 = $this->Common_model->fetch_stores($store_cond);
			 $headerdata['categories'] = $this->Common_model->fetch_category();
			 $headerdata['country']  = $this->Common_model->get_countries(array('status'=>'1'));
			 $headerdata['city']		 = $this->Common_model->fetch_city('1');

			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/common/menu_header', $headerdata);
			 
			 if ( ($user_type = $this->is_logged_in['user_type']) == 'business_basic' ){
						$this->load->view('front/edit_basic_campaign',$headerdata);
				 		}
				 		elseif( ($user_type = $this->is_logged_in['user_type']) == 'business_pro' ){
				 				$this->load->view('front/edit_pro_campaign',$headerdata);
				 			  }
				 			  else {
				 			  		redirect('user');
				 			  	}
			 $this->load->view('front/common/footer');
		}
	
	
	public function campaign_pro_update(){
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
		   if(isset($_POST['deal_id']) && is_numeric($_POST['deal_id']))
		   		{
							$whr_deals = array('d.id' => $_POST['deal_id'], 'd.user_id' => $id);
				 			$deal_details = $this->Deals_model->get_Deal_details($whr_deals);
				 			
				 			if(!$deal_details){
				 				  $this->session->set_flashdata('action_msg',"Campaign not found");
				 				  $this->session->set_flashdata('action','0');
					 			  redirect(site_url('user/my_campaign'));
					 			  exit;
				 				  }
									
						 
							if($_POST['campaign_status'] == 'save' || $_POST['campaign_status'] == 'schedule' || $_POST['campaign_status'] == 'post')
									{
							    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('campaign_url', 'Campaign Url', 'trim|required|max_length[255]|prep_url|xss_clean');    			 
							    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
							    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]|xss_clean');
							    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');
							    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[255]|prep_url|xss_clean');
							    			 
							    			 $this->form_validation->set_error_delimiters('* ', '');
							    			 
							    			 if($this->form_validation->run() == FALSE) {
							    			 	//echo validation_errors();
							    			 
							    			 		$this->create_campaign();
							    			 		}
							    			 		else{
														  $new_file_name1 = '';
														  
		    			 					           if( isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "" ) {
												
															  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
															  $destination1 	= $this->config->item('deal_image');
															  $pointer1     	= 'logo';
															  $new_file_name1  = md5($_FILES['logo']['name'].time()).".".$ext1; 
															  
															  if( $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  ) != 'success' ){
															  
																		$this->session->set_flashdata('action_msg',$ret1);
																		$this->session->set_flashdata('action','0');	
																		redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																		exit;	
																	  }
															 	}
															 	
															if( $this->Update_data_model->update_front_campaign($id,'',$new_file_name1,'pro') ){
																		
																		if($this->input->post('campaign_status') == 'save')
																			$msg = "Campaign has been saved successfully.";	
																			elseif($this->input->post('campaign_status') == 'save')
																				$msg = "Campaign has been scheduled successfully.";
																				else 
																					$msg = "Campaign has been updated successfully.";	
																																			
																	$this->session->set_flashdata('action_msg',$msg);
																	$this->session->set_flashdata('action','1');	
																	redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																	exit;
																	}
																	else{
																			$this->session->set_flashdata('action_msg',"Failed to upload the Campaign, please try again.");
																			$this->session->set_flashdata('action','0');	
																			redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																			exit;	
																		 	}
														}
		    			 			  }
		    			 			  else{
				    			 				redirect(base_url('user/my_campaign'));	
												exit;	
				    			 			  }
 			 	}
 			 	else{
						redirect(base_url('user/my_campaign'));	
						exit;	
 			 		  }
    	}
    	
    	
	public function campaign_basic_update(){
		
				if ( ($id = $this->is_logged_in['user_id']) ){
			      $headerdata['logged_in'] = TRUE;
					$headerdata['active_class'] = 'my_campaigns';
					$headerdata['active_sub_class'] = '';						
			      }
					else{
							 $headerdata['logged_in'] = FALSE;
							 $headerdata['active_class'] = '';
							 redirect(site_url('user'));
						 }
						 
		   if(isset($_POST['deal_id']) && is_numeric($_POST['deal_id']))
		   		{
							$whr_deals = array('d.id' => $_POST['deal_id'], 'd.user_id' => $id);
				 			$deal_details = $this->Deals_model->get_Deal_details($whr_deals);
				 			
				 			if(!$deal_details){
				 				  $this->session->set_flashdata('action_msg',"Campaign not found");
				 				  $this->session->set_flashdata('action','0');
					 			  redirect(site_url('user/my_campaign'));
					 			  exit;
				 				  }
									
						 
							if($_POST['campaign_status'] == 'save' || $_POST['campaign_status'] == 'schedule' || $_POST['campaign_status'] == 'post')
									{
																							
							    			 $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|max_length[30]|xss_clean');
							    			 //$this->form_validation->set_rules('check_logo', 'Logo Image', 'trim|required|xss_clean');
							    			 //$this->form_validation->set_rules('check_img', 'Upload Image', 'trim|required|xss_clean');
							    			 $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('duration_to', 'Dutation To', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('duration_from', 'Duration from', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[255]|xss_clean');
							    			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('city_area', 'City Area', 'trim|required|max_length[30]|xss_clean');
							    			 $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]|xss_clean');
							    			 $this->form_validation->set_rules('phone', 'Phone', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');
							    			 $this->form_validation->set_rules('website_url', 'Website', 'trim|required|max_length[255]|prep_url|xss_clean');
							    			 
							    			 $this->form_validation->set_error_delimiters('* ', '');
							    			 
							    			 if($this->form_validation->run() == FALSE) {
							    			 	//echo validation_errors();
							    			 
							    			 		$this->create_campaign();
							    			 		}
							    			 		else{
														  $new_file_name1 = '';
														  $new_file_name = '';
														  
														  if( isset( $_FILES['img']['name'] ) && $_FILES['img']['name'] != "" ) {
												
																	  $ext				= array_pop(explode(".",$_FILES['img']['name']));
																	  $destination 	= $this->config->item('deal_image');
																	  $pointer     	= 'img';
																	  $new_file_name  = md5($_FILES['img']['name'].time()).".".$ext; 
																	  
																	  if( $this->Common_model->upload_photo($pointer,$destination,$new_file_name,'232'  ) != 'success' ){
																	  
																				$this->session->set_flashdata('action_msg',$ret1);
																				$this->session->set_flashdata('action','0');	
																				redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																				exit;	
																			  }
															 	}
															 	
		    			 					           if( isset( $_FILES['logo']['name'] ) && $_FILES['logo']['name'] != "" ) {
												
																	  $ext1				= array_pop(explode(".",$_FILES['logo']['name']));
																	  $destination1 	= $this->config->item('deal_image');
																	  $pointer1     	= 'logo';
																	  $new_file_name1  = md5($_FILES['logo']['name'].time()).".".$ext1; 
																	  
																	  if( $this->Common_model->upload_photo($pointer1,$destination1,$new_file_name1,'232'  ) != 'success' ){
																	  
																				$this->session->set_flashdata('action_msg',$ret1);
																				$this->session->set_flashdata('action','0');	
																				redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																				exit;	
																			  }
															 	}
															 	
															if( $this->Update_data_model->update_front_campaign($id,$new_file_name,$new_file_name1,'basic') ){
																		
																		if($this->input->post('campaign_status') == 'save')
																			$msg = "Campaign has been saved successfully.";	
																			elseif($this->input->post('campaign_status') == 'save')
																				$msg = "Campaign has been scheduled successfully.";
																				else 
																					$msg = "Campaign has been updated successfully.";	
																																			
																	$this->session->set_flashdata('action_msg',$msg);
																	$this->session->set_flashdata('action','1');	
																	redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																	exit;
																	}
																	else{
																			$this->session->set_flashdata('action_msg',"Failed to update the Campaign, please try again.");
																			$this->session->set_flashdata('action','0');	
																			redirect(base_url('user/edit_campaign/'.$this->input->post('deal_id')));	
																			exit;	
																		 	}
														}
		    			 			  }
		    			 			  else{
				    			 				redirect(base_url('user/my_campaign'));	
												exit;	
				    			 			  }
 			 	}
 			 	else{
						redirect(base_url('user/my_campaign'));	
						exit;	
 			 		  }
    	}

		

	public function fetch_country_list() {

				$data = $this->Common_model->get_countries();
				for($countries='',$i=0;$i<count($data);$i++){
						$countries .= "<option value='".$data[$i]->id."'>".$data[$i]->country_name."</option>";
					}
				echo json_encode($countries);
				exit;
		}

	public function logout() {

				 if ( !$this->is_logged_in['user_id'] ) {
				     		redirect(base_url('user'));
				 	}

				$this->remove_session_data('user');	
				redirect(base_url('welcome/main'));	
			}

	private function set_session_data( $data, $session_name ) {
			
			$user_session_array = array($session_name=>$data);
			$this->session->set_userdata($user_session_array);
		}

	private function remove_session_data( $session_name ) {

			$this->session->unset_userdata($session_name);
		}
                
   public function my_subscription(){
 		
		 		if ($this->is_logged_in['user_id']) {
								if($this->is_logged_in['user_type'] != 'end_user') {  // if not end user
									
										redirect(base_url('welcome/main'));
										}
									
				      		$headerdata['logged_in'] = TRUE;
								$headerdata['active_class'] = 'mysubscription';
				      }
						else{
								 $headerdata['logged_in'] = FALSE;
								 $headerdata['active_class'] = '';
								 redirect(base_url());
							  }
							
			   $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		 		$category_id='';
		 		
		 		/*if( $this->uri->segment(3) == 'category' && $this->uri->segment(5) ) {
		    					$category_id = $this->uri->segment(5);
		               }*/
		                       
		 		 $data['my_subscription'] = $this->Common_model->MySubscriptionForEndUser();	
		 		 
		 		 //echo"<pre>"; print_r($data['my_subscription']); exit;
		                              
		       $this->load->view('front/common/header', $headerdata);
				 $this->load->view('front/common/menu_header', $headerdata);
				 $this->load->view('front/my_subscription',$data);
				 $this->load->view('front/common/footer');
		  }
		  
	public function inbox(){
 		
		 		if ($this->is_logged_in['user_id']) {
								if($this->is_logged_in['user_type'] != 'end_user') {  // if not end user
									
										redirect(base_url('welcome/main'));
										}
									
				      		$headerdata['logged_in'] = TRUE;
								$headerdata['active_class'] = 'inbox';
				      }
						else{
								 $headerdata['logged_in'] = FALSE;
								 $headerdata['active_class'] = '';
								 redirect(base_url());
							  }
							
			   $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		 		$category_id='';
		 		
		 		if( $this->uri->segment(3) == 'category' && $this->uri->segment(5) ) {
		    					$category_id = $this->uri->segment(5);
		               }
		                       
		 		 $data['inbox'] = $this->Common_model->getMyInbox($category_id);	
		 		 
		 		 //echo "<pre>"; print_r($data['inbox']); exit;
		                              
		       $this->load->view('front/common/header', $headerdata);
				 $this->load->view('front/common/menu_header', $headerdata);
				 $this->load->view('front/inbox',$data);
				 $this->load->view('front/common/footer');
		  }
		  
	public function my_clips(){
 		
		 		if ($this->is_logged_in['user_id']) {
								if($this->is_logged_in['user_type'] != 'end_user') {  // if not end user
									
										redirect(base_url('welcome/main'));
										}
									
				      		$headerdata['logged_in'] = TRUE;
								$headerdata['active_class'] = 'clipits';
				      }
						else{
								 $headerdata['logged_in'] = FALSE;
								 $headerdata['active_class'] = '';
								 redirect(base_url());
							  }
							
			   $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		 		/*$category_id='';
		 		
		 		if( $this->uri->segment(3) == 'category' && $this->uri->segment(5) ) {
		    					$category_id = $this->uri->segment(5);
		               }*/
		                       
		 		 $data['inbox'] = $this->Common_model->getMyClips();	
		                              
		       $this->load->view('front/common/header', $headerdata);
				 $this->load->view('front/common/menu_header', $headerdata);
				 $this->load->view('front/clips',$data);
				 $this->load->view('front/common/footer');
		  }
}
?>
