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
     * Adding static page from admin end
     */
    public function add_user() {
        $data['pageName'] = $this->pageName . ' : Add Business User';
        
        if(isset($_POST['page_action']) && !empty($_POST['page_action'])){
            
            $isPageAdded = $this->User_model->insert_category();
            
            if(!$isPageAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to add the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record added successfull!');
                redirect('admin/category/home', "location");
            }
        }
        $data['countryList'] = $this->Common_model->get_countries();
        $this->load->view('admin/user/add_view', $data);    
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

 
