<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class User extends CI_Controller {

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
        $this->load->model('admin/User_model');
        $this->load->model('Common_model');
        $this->pageName = 'Manage User';
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
    public function home($selected_user = 'all') {
        $data['pageName'] = $this->pageName;
        
        $data['selcted_user'] = $selected_user;
        if($selected_user != 'all')
        		$whr_arr = array('u.user_type'=>$selected_user);
        		else 
        			$whr_arr = null;
        
        $userRS = $this->User_model->get_users($whr_arr);
        											//echo "<pre>"; print_r($userRS);exit;
        $data['userRS'] = $userRS;
        $this->load->view('admin/user/listing_view', $data);    
    }
    
    public function subscriptions($user_id) {
        
        		$userRS = $this->User_model->get_store_subscription($user_id);
        											//echo "<pre>"; print_r($userRS);exit;
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
    
    
    /**
     * Adding USER from admin end
     */
    public function add_user($user_type = 'business_basic') {
			   $data['pageName'] = $this->pageName . ' : Add User';

			   $page = "add_view_basic";
			   $type = "Business Basic";

				if( $user_type == 'business_pro' ){
					$page = "add_view_pro";
					$type = "Business Pro";
					$data['plan_list'] = $this->Common_model->get_plan_list();
					}
					elseif($user_type == 'end_user'){
							  $page = "add_view_end_user";
							  $type = "End";
							  }

			   $data['pageName'] = $this->pageName . ' : Add '.$type.' User';
			   $data['countryList'] = $this->Common_model->get_countries(); // echo "<pre>"; print_r($data); exit;
			   $this->load->view('admin/user/'.$page, $data);    
    }

    /**
     * Submited end user form from admin end
     */
	public function register_end_user() {
			 $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[30]|xss_clean');
		 	 $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[30]|xss_clean');
			 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email|is_unique[user.email]|matches[retype_email]');
			 $this->form_validation->set_rules('retype_email', 'Retype Email', 'trim|required|valid_email|xss_clean|email');
			 $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|min_length[8]|matches[retype_password]|xss_clean');
			 $this->form_validation->set_rules('retype_password', 'Retype Password', 'trim|required|max_length[30]|min_length[8]|xss_clean');									 
			 $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|max_length[30]|xss_clean|is_unique[user_profile.display_name]');									 
			 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
			 $this->form_validation->set_rules('phone', 'phone', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');									 
			 $this->form_validation->set_rules('gender', 'Gender', 'trim|required|max_length[50]|xss_clean');

			$this->form_validation->set_error_delimiters("", "");
				
			if($this->form_validation->run() == FALSE){
				$this->add_user('end_user');
				}
				else{
						$this->load->model('Registration_model');
					     if(  ($user_id = $this->Registration_model->register_end_user() ) ) {
							   
							   $activation_link = base_url('registration/activate_link/'.$user_id);
							   $username = $this->input->post('display_name');

						        $to = $this->input->post('email');
						        $subject = 'Successfully registered in Dailydrums';
						        $fromemail = 'noreply@dailydrums.com.com';
						        $fromname = 'Dailydrums';
						        $data['activation_link'] = $activation_link;
						        $data['username'] = $username;
						        $msg = $this->load->view('email_templates/registration_confirmatation_mail',$data,TRUE);
							   $this->load->library('Utils');
						        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);

							   $this->session->set_flashdata( 'info_message',"End user - ".$username." has been registred successfully, please check the email, to activate the account." );
							   redirect(base_url('admin/user'));
							   }
							   else{
									$this->session->set_flashdata( 'info_message',"<span class='error-alert'>Failed to register the end user, due to some improper data.</span>" );
							   		redirect(base_url('admin/user/add_user/end_user'));
								     }
					}
		}


    /**
     * Submited Business user form from admin end
     */

	public function register_business_user(){
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
			 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[50]|xss_clean');
			 $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]|xss_clean');
			 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[50]|xss_clean');
			 $this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[30]|xss_clean');
			 $this->form_validation->set_rules('phone_primary', 'phone primary', 'integer|trim|required|min_length[10]|max_length[15]|xss_clean');									 
			 $this->form_validation->set_rules('card_name', 'Card Name ', 'trim|required|max_length[50]|xss_clean');
			 $this->form_validation->set_rules('card_number', 'Card Number ', 'trim|required|max_length[30]|xss_clean');
			 $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required|max_length[10]|xss_clean');
			 
			 if($this->input->post('page_action') == "add_pro_user"){
				$this->form_validation->set_rules('register_plan', 'Register Plan', 'trim|required|max_length[50]|xss_clean');
				$page_for = 'business_pro';
				}
				else{
					  $page_for = 'business_basic';
					   }
			
			 $this->form_validation->set_error_delimiters('', '');
				
			if($this->form_validation->run() == FALSE) {
				$this->add_user($page_for);
				}
				else{
						$this->load->model('Registration_model');
						if( ( $user_id = $this->Registration_model->register_business_basic() ) ) {
						 	  $activation_link = base_url('registration/activate_link'."/".md5($this->input->post('email')));
						 	  $username = $this->input->post('display_name');						 	  
							   //email fielda
							   $to = $this->input->post('email');
							   $subject = 'Successfully registered in Dailydrums';
							   $fromemail = 'noreply@dailydrums.com.com';
							   $fromname = 'Dailydrums';
							   $data['activation_link'] = $activation_link;
							   $data['username'] = $username;
							   $msg = $this->load->view('email_templates/registration_confirmatation_mail',$data,TRUE);
							   $this->load->library('Utils');
							   $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
							   	  
							   if($this->input->post('page_action') == "add_pro_user") {  // For Pro user
									    $plan = $this->Common_model->get_plan_list($this->input->post('register_plan'));
									    $transaction_array = array('user_id'=>$user_id,
																			'transaction_id'=>'by_admin',
																			'amount'=>$plan->price,
																			'subject'=>"Subscribe Pro by ADMIN",
																			'date'=>date("Y-m-d H:i:s"),
																			'pdate'=>date("Y-m-d H:i:s")
																			);	
										$update_data = array('user_type'=>'business_pro');
								
										$this->Registration_model->transaction_entry($transaction_array); // save transaction data
										$this->Registration_model->update_pro_data($user_id,$update_data);			// Update basic user to pro user
										  
										$plan_map_array = array(  'user_id'=>$user_id,
																			'plan_id'=>$plan->id,
																			'price'=>$plan->price,
																			'duration'=>$plan->duration
																			);
										  $this->load->model('Insert_data_model');
										  $this->Insert_data_model->save_user_plan_map_data($plan_map_array); 		// Saving plan map data
									}
								$this->session->set_flashdata( 'info_message',"Business user - ".$username." has been registred successfully, please check the email, to activate the account." );
							   	redirect(base_url('admin/user'));
						   }
						   else{
								 $this->session->set_flashdata( 'info_message',"<span class='error-alert'>Failed to register the Business user, due to some improper data.</span>" );
								 redirect(base_url('admin/user/add_user/'.$page_for));
								}
					  }
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
        
        $user_id = $get['id'];
        $where_clause = array('u.id' => $user_id);
        $userRS = $this->User_model->get_users($where_clause);

        if(!$userRS) {
            echo '<h5>No records found..</h5>';
            exit();
        }
        $user = $userRS[0];

        $data['user'] = $user;

        $this->load->view('admin/user/view_details', $data);    
        
    }
    
    /**
     *  Change Status
     */
     
     public function change_status() {
     	
     		$get = $this->uri->uri_to_assoc();
     		
			if(!isset($get['id'])){
				
					redirect('admin/user/home', "location");
					exit;
				}     		
     		
     		$user_id = $get['id'];  
     		$whr_arr = array('u.id'=>$user_id);  		
     		if( ( $userData = $this->User_model->get_users($whr_arr) ) ) {
     							
     				$this->User_model->update_status($userData[0]->id);
     			}
     		redirect('admin/user/home', "location");
         exit();
     	}
    
 
    
    /**
     *  Editing the content of the pages
     */
    public function edit_category() {
        $data['pageName'] = $this->pageName . ' : Edit Category';
        $get = $this->uri->uri_to_assoc();
        
        //If no id found
        if(!isset($get['id'])){
            $this->session->set_flashdata('info_message', '<span class="error-alert">No content found</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
        
        $category_id = $get['id'];
        $where_clause = array('category_id' => $category_id);
        $categoryRS = $this->User_model->get_category($where_clause);


        if (!$categoryRS) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Content not available. Please try again later.</span>');
            redirect('admin/category/home', "location");
            exit();
        }
        
        $category = $categoryRS[0];
        $data['category'] = $category;
        
        //After posting save data
        if(isset($_POST['category_id']) && !empty($_POST['category_id'])) {
           
            $pst_category_id =  addslashes($_POST['category_id']);
            $isCategoryAdded = $this->User_model->update_category($pst_category_id);
            
            if(!$isCategoryAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to update the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record updated successfull!');
                redirect('admin/category/home', "location");
            }
        }
        $this->load->view('admin/category/edit_view', $data);    
    }
    
    
    
    function delete() {
        $get = $this->uri->uri_to_assoc();

        //If no id found
        if (!isset($get['id'])) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
       $id = addslashes($get['id']);
       $idName = 'category_id';
       $tableName= $this->User_model->static_table;
       
        $isDelete = $this->Common_model->delete_records($tableName, $idName, $id);
        if($isDelete){
             $this->session->set_flashdata('info_message', 'Records delete successfully');
        }
        else{
             $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
        }
        redirect('admin/category/home', "location");
        exit();
    }

}

 
