<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class Registration_end extends CI_Controller {

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
		        
		        //$this->load->view('front/common/header', $headerdata);
		        //$this->load->view('front/common/menu_header', $headerdata);
		        $this->load->view('front/register_enduser');
		        $this->load->view('front/common/footer');
    }
    
    
    
    public function signup() {
    				
    								 	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[30]|xss_clean');
    								 	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[30]|xss_clean');
									 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email|is_unique[user.email]');
									 $this->form_validation->set_rules('retype_email', 'Retype Email', 'trim|required|valid_email|xss_clean|email');
									 $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|min_length[8]|xss_clean');
									 $this->form_validation->set_rules('retype_password', 'Retype Password', 'trim|required|max_length[30]|min_length[8]|xss_clean');									 
									 $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|max_length[30]|xss_clean|is_unique[user_profile.display_name]');									 
									 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
									 $this->form_validation->set_rules('phone', 'phone', 'integer|trim|required|max_length[15]|xss_clean');									 
									 $this->form_validation->set_rules('gender', 'Gender', 'trim|required|max_length[50]|xss_clean');
									
									$this->form_validation->set_error_delimiters("", "");
									$post_vals = $this->input->post();
									$r['error_flag']  = '0';
									
										
									if($this->form_validation->run() == FALSE)
										{
											$r['error_flag']  = '1';
										}
										else{
																							
													$password              	 = $this->input->post('password');
													$password_again   	    = $this->input->post('retype_password');
													$email                   = $this->input->post('email');
													$email_again         	 = $this->input->post('retype_email');
																										
													if($password != $password_again) {
															
															$r['error_flag'] = '1';
															//$r['error']['password_again'] = "Retype Password not matched.";
															$this->session->set_flashdata( 'action_msg',"Retype Password not matched." );
															redirect(base_url('registration_end'));															
															
															}
													if($email != $email_again){
															
															$r['error_flag'] = '1';
															//$r['error']['email_again'] = "Retype Email not matched.";
															$this->session->set_flashdata( 'action_msg',"Retype Email not matched." );
															redirect(base_url('registration_end'));	
															}
													
													} 
											 	
										if($r['error_flag']  == '1')	{
											
											//redirect(base_url('registration_end'));
											/*$this->session->set_flashdata('first_name',$this->input->post('first_name'));
											$this->session->set_flashdata('last_name',$this->input->post('last_name'));
											$this->session->set_flashdata('display_name',$this->input->post('display_name'));
											$this->session->set_flashdata('email',$this->input->post('email'));
											$this->session->set_flashdata('retype_email',$this->input->post('retype_email'));
											$this->session->set_flashdata('password',$this->input->post('password'));
											$this->session->set_flashdata('retype_password',$this->input->post('retype_password'));
											$this->session->set_flashdata('zip',$this->input->post('zip'));
											$this->session->set_flashdata('phone',$this->input->post('phone'));*/
											$this->index();
												
												//echo '{"result":'.json_encode($r)."}";
												//exit;
												}
												else{
															if(  ( $user_id = $this->Registration_model->register_end_user() ) ) {
																	
																	 $activation_link = base_url('registration/activate_link/'.$user_id);
																	 $username = $this->input->post('display_name');

																        $to = $this->input->post('email');
																        $subject = 'Successfully registered in Dailydrums';
																        $fromemail = 'noreply@dailydrums.com.com';
																        $fromname = 'Dailydrums';
																        $data['activation_link'] = $activation_link;
																        $data['username'] = $username;
																        $msg = $this->load->view('email_templates/registration_confirmatation_mail',$data,TRUE);

																        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
																        
																        $this->session->set_flashdata('action','1'); 
																		  $this->session->set_flashdata( 'action_msg',"Thank you for registration, please check your email, to activate your account" );
																		  redirect(base_url('user'));
																		 
																	}
																	else{
																			$this->session->set_flashdata('action','0'); 
																			$this->session->set_flashdata( 'action_msg',"Failed to register, please try again." );
																			redirect(base_url('registration_end'));		
																		}
																
														 exit;
													}							
    		}
    		
    	public function pay() {
    		
    			$headerdata['form_action'] = "https://www.sandbox.paypal.com/cgi-bin/webscr"; 
    			$headerdata['paypal_id'] = "santanu.cs-facilitator@gmail.com";
    			$headerdata['item_name'] = "Subscription for Business-Pro";
    			$headerdata['item_number'] = "1";
    			$headerdata['amount'] = "";
    			$headerdata['no_shipping'] = "0";
    			$headerdata['no_note'] = "1";
    			$headerdata['currency_code'] = "USD";
    			$headerdata['lc'] = "AU";
    			$headerdata['bn'] = "PP-BuyNowBF";
    			$headerdata['notify_url'] = base_url('registration/receive_billing_information/')."?user_session_id=".$_GET['last_inserted_id'];
    			$headerdata['return'] = base_url('registration/payment_success/');
    		
    			$this->load->view('front/pay_bill');
    		
    		}
    		
    	public function payment_success() {
    		
    		
				if( isset( $_REQUEST['txn_id'] ) && $_REQUEST['txn_id'] != '' ) {    		
						
								$transaction_array = array('user_id'=>$_SESSION['last_inserted_id'],
															'transaction_id'=>$_REQUEST['txn_id'],
															'amount'=>$_REQUEST['payment_gross'],
															'subject'=>$_REQUEST['transaction_subject'],
															'date'=>date("Y-m-d H:i:s"),
															'pdate'=>$_REQUEST['payment_date']
																);	
								if( $this->Registration_model->transaction_entry($transaction_array) ) {
					
										echo "SUCCESS";
									}else{
										
											echo "failed";
										}				   
								}
								else{
									
											echo "FAILED";
									}
														
					
    		}
    		
    	public function receive_billing_information() {
    		
    		echo "HI";
    		}

		public function activate_link()
			{
				$id = $this->uri->segment(3);
				if( $activation = $this->Registration_model->activate_link($id) != '0' ) {
						
						$this->session->set_flashdata('action', '1');
						$this->session->set_flashdata('action_msg', 'Your account has been activated successfuly');
						redirect(base_url('user'));
						//echo "Your account has been activated successfuly. click on the link to <a href='".base_url()."'>login</a>.";
						}
						else {
									$this->session->set_flashdata('action', '0');
									$this->session->set_flashdata('action_msg', 'Failed to activate your account');
									redirect(base_url('user'));
								//echo "Failed to activate your account.";
							  }
				}
	}
?>
