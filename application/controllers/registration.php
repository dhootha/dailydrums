<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class Registration extends CI_Controller {

    public  $is_logged_in;
    public  $user_session_id = 'user';
    private $secret_key = 'useriddailydrums';
    public $local_area = '';
    public $user_type = '';

    public function __construct() {
        
        parent::__construct();
        
	 $this->load->library('Utils');
	 $this->load->library('form_validation');
    $this->load->library('authmanager'); 
    $this->load->model('Common_model');
	 $this->load->model('Registration_model');
	        
    $this->is_logged_in = $this->authmanager->is_logged_in('user');
    
    if( $this->is_logged_in ) {
			$user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
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

		        $headerdata['page_title'] = 'Welcome To Daily Drums';
		        $headerdata['countryList'] = $this->Common_model->get_countries();
		        
		        //echo $this->input->post('plan');
		        
		        if($this->input->post('plan')) {
	     			  $this->session->set_userdata('register_plan',$this->input->post('plan'));
	     			  }
	     			  else{
	     			  		 $this->session->set_userdata('register_plan','');
	     			  		}
	     			  		
	     		  //print($this->session->userdata('register_plan'));exit;
		        $this->load->view('front/common/header', $headerdata);
		        $this->load->view('front/register_business');
		        $this->load->view('front/common/footer');
    }
    
    
    
    public function business_registration_submit() {
    	
    								      $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[30]|xss_clean');
									 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email|is_unique[user.email]');
									 $this->form_validation->set_rules('email_again', 'Retype Email', 'trim|required|valid_email|xss_clean|email|matches[email]');
									 $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|min_length[8]|xss_clean');
									 $this->form_validation->set_rules('password_again', 'Retype Password', 'trim|required|max_length[30]|min_length[8]|xss_clean|matches[password]');									 
									 $this->form_validation->set_rules('business_name', 'Legal Name', 'trim|required|max_length[30]|xss_clean');
									 $this->form_validation->set_rules('business_email', 'Business Email', 'trim|required|valid_email|xss_clean|email');									 
									 $this->form_validation->set_rules('business_email_again', 'Retype Business Email', 'trim|required|valid_email|xss_clean|email|matches[business_email]');
									 $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|max_length[30]|xss_clean|is_unique[user_profile.display_name]');									 
									 $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'trim|required|max_length[50]|xss_clean');									 
									 $this->form_validation->set_rules('address_line_2', 'Address Line 2', 'trim|required|max_length[50]|xss_clean');										 
									 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[50]|xss_clean');
									 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
									 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[50]|xss_clean');
									 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
									 $this->form_validation->set_rules('phone_primary', 'phone primary', 'integer|trim|required|max_length[15]|xss_clean');									 
									 $this->form_validation->set_rules('card_name', 'Card Name ', 'trim|required|max_length[50]|xss_clean');
									 $this->form_validation->set_rules('card_number', 'Card Number ', 'trim|required|max_length[30]|xss_clean');
									 $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required|max_length[10]|xss_clean');
									
									 $this->form_validation->set_error_delimiters('', '');
									 $post_vals = $this->input->post();
									 $r['error_flag']  = '0';
									 $r['price']='';
										
									if($this->form_validation->run() == FALSE) {
											$error = array();
											foreach( $post_vals as $key=>$val ) {	
														if(  form_error($key) != '') {
																$error[$key] = form_error($key);
																}
														}
											$r['error'] = $error;
											$r['error_flag']  = '1';
											}
											else{
														$password             = $this->input->post('password');
														$password_again   	 = $this->input->post('password_again');
														$email                = $this->input->post('email');
														$email_again          = $this->input->post('email_again');
														$business_email    	 = $this->input->post('business_email');
														$business_email_again = $this->input->post('business_email_again');
														
														if($password != $password_again) {
																$r['error_flag'] = '1';
																$r['error']['password_again'] = "Retype Password not matched.";
																}
														if($email != $email_again){
																$r['error_flag'] = '1';
																$r['error']['email_again'] = "Retype Email not matched.";
																}
														if($business_email != $business_email_again){
																$r['error_flag'] = '1';
																$r['error']['business_email_again'] = "Retype Business Email not matched.";
																}
														} 
											 	
										if($r['error_flag']  == '1')	{
												echo '{"result":'.json_encode($r)."}";
												exit;
												}
												else{
															if( ( $user_id = $this->Registration_model->register_business_basic() ) ) {
																	 	  $activation_link = base_url('registration/activate_link'."/".md5($this->input->post('email')));
																	 	  $username = $this->input->post('display_name');

																	 	  if( $this->session->userdata('register_plan') == '' ) {  // For basic user
																			 	  //email fielda
																		        $to = $this->input->post('email');
																		        $subject = 'Successfully registered in Dailydrums';
																		        $fromemail = 'noreply@dailydrums.com.com';
																		        $fromname = 'Dailydrums';
																		        $data['activation_link'] = $activation_link;
																		        $data['username'] = $username;
																		        $msg = $this->load->view('email_templates/registration_confirmatation_mail',$data,TRUE);
		
																		        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
																	        	  }
																	        		else{ 		// For pro user
																		        			$this->session->set_userdata('pro_user_id',$user_id);
																		        			if(($plan = $this->Common_model->get_plan_list($this->session->userdata('register_plan')))){
																	        						$r['price'] = $plan->price;
																	        						}
																	        						else{
																	        								$this->session->set_userdata('action','0');
																	        								$this->session->set_userdata('action_message','Please select a plan');
																	        								//redirect(base_url('registration'));
																	        								//$r['error'] = array()
																	        								$r['error_flag'] = '1';
																	        								}
																	        				}
																	}
															echo json_encode($r);
															exit;		
													   }							
    		}
    		
    	public function pay($price) {
    		
    			$headerdata['form_action'] = "https://www.sandbox.paypal.com/cgi-bin/webscr"; 
    			$headerdata['paypal_id'] = "santanu.cs-facilitator@gmail.com";
    			$headerdata['item_name'] = "Subscription for Business-Pro";
    			$headerdata['item_number'] = "1";
    			$headerdata['amount'] = $price;
    			$headerdata['no_shipping'] = "0";
    			$headerdata['no_note'] = "1";
    			$headerdata['currency_code'] = "USD";
    			$headerdata['lc'] = "AU";
    			$headerdata['bn'] = "PP-BuyNowBF";
    			$headerdata['custom']=$this->session->userdata('pro_user_id')."@##@".$this->session->userdata('register_plan');
    			// For update database pupose
    			$headerdata['notify_url'] = base_url('registration/receive_billing_information');
				// For return from paypal    			
    			$headerdata['return'] = base_url('welcome/thank_you');
    			    			
    			$this->load->view('front/pay_bill',$headerdata);
    		}
    		
    	    		
    	public function receive_billing_information() {
    		
    		$extra_msg = '';
    		    		
    		if( isset( $_POST['txn_id'] ) && $_POST['txn_id'] != '' ) { 
    		
    							$cstm_data = explode("@##@",$_POST['custom']); 
    							$user_id = $cstm_data[0];
    							$pro_plan_id = $cstm_data[1];
						
								$transaction_array = array('user_id'=>$user_id,
																	'transaction_id'=>$_POST['txn_id'],
																	'amount'=>$_POST['payment_gross'],
																	'subject'=>"Subscribe Pro",
																	'date'=>date("Y-m-d H:i:s"),
																	'pdate'=>$_POST['payment_date']
																	);
								$extra_msg = "<p>Paypal transaction id: ".$_POST['txn_id']."<br> Amount: ".$_POST['payment_gross']."<br>Date: ".$_POST['payment_date']."</p>";	
								$update_data = array('user_type'=>'business_pro');
								
								$this->Registration_model->transaction_entry($transaction_array); // save transaction data
								$this->Registration_model->update_pro_data($user_id,$update_data);			// Update basic user to pro user
								
							  // Mail section 
							  $this->load->model('Fetch_data_model');
							  $u_data 		  = $this->Fetch_data_model->fetch_user_data($user_id);
							  $pro_email 	  = $u_data->email;
							  $pro_user_name = $u_data->display_name;
							  $pro_activation_link = base_url('registration/activate_link')."/".md5(trim($pro_email));
							  
							  $plan = $this->Common_model->get_plan_list($pro_plan_id);
							  $plan_map_array = array('user_id'=>$user_id,
																'plan_id'=>$plan->id,
																'price'=>$plan->price,
																'duration'=>$plan->duration
																);
							  $this->load->model('Insert_data_model');
							  $this->Insert_data_model->save_user_plan_map_data($plan_map_array); 		// Saving plan map data
							 
						   $to = trim($pro_email);
					        $subject = 'Successfully registered in Dailydrums';
					        $fromemail = 'noreply@dailydrums.com.com';
					        $fromname = 'Dailydrums';
					        $data['activation_link'] = $pro_activation_link;
					        $data['username'] = $pro_user_name;
					        $data['extra_msg']=$extra_msg;
					        $msg = $this->load->view('email_templates/registration_confirmatation_mail',$data,TRUE);
				
					        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);			
	        					}
    		}
    	

		public function activate_link()
			{
				$id = $this->uri->segment(3);
				if( ($activation = $this->Registration_model->activate_link($id)) ) {
					
						if($activation == 'end_user'){
								$msg = "Your account has been varified successfully";							
								}
								else{
										$msg = "Your account has been varified successfuly. Awaiting for Moderator approval";
										}
						
						$this->session->set_flashdata('action', '1');
						$this->session->set_flashdata('action_msg',$msg);
						redirect(base_url('user'));
						//echo "Your account has been activated successfuly. click on the link to <a href='".base_url()."'>login</a>.";
						}
						else {
									$this->session->set_flashdata('action', '0');
									$this->session->set_flashdata('action_msg', 'Follow the link, has been provided to you');
									redirect(base_url('user'));
								//echo "Failed to activate your account.";
							  }
				}
	}
?>
