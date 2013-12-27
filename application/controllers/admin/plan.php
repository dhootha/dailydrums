<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Plan extends CI_Controller {

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
        $this->load->model('admin/Plan_model');
        $this->load->model('Common_model');
        $this->pageName = 'Manage Bussiness Plan';
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
        $planRS = $this->Plan_model->get_plan();
        
        //echo "<pre>"; print_r($statcPagesRS);exit;
        $data['planRS'] = $planRS;
        $this->load->view('admin/plan/listing_view', $data);    
    }
    
    
    /**
     * Adding static page from admin end
     */
    public function add_page() {
        $data['pageName'] = $this->pageName . ' : Add Page';
        
        if(isset($_POST['page_action']) && !empty($_POST['page_action'])){
            
            $isPageAdded = $this->Plan_model->insert_plan();
            
            if(!$isPageAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to add the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record added successfull!');
                redirect('admin/plan/home', "location");
            }
        }
        $this->load->view('admin/plan/add_view', $data);    
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
        
        $page_id = $get['id'];
        $where_clause = array('page_id' => $page_id);
        $statcPagesRS = $this->Static_page_model->get_static_pages($where_clause);

        if(!$statcPagesRS) {
            echo '<h5>No records found..</h5>';
            exit();
        }
        $page = $statcPagesRS[0];

        $data['page'] = $page;

        $this->load->view('admin/static_pages/view_details', $data);    
        
        
    }
    
    /**
     *  Change Status
     */
     
     public function change_status() {
     	
     		$get = $this->uri->uri_to_assoc();
     		
			if(!isset($get['id'])){
				
					redirect('admin/plan/home', "location");
					exit;
				}     		
     		
     		$page_id = $get['id'];  
     		$whr_arr = array('id'=>$page_id);  		
     		if( ( $catData = $this->Plan_model->get_plan($whr_arr) ) ) {
     							
     				$this->Plan_model->update_status($catData[0]->id);
     			}
     		redirect('admin/plan/home', "location");
         exit();
     	}
    
 
    
    /**
     *  Editing the content of the pages
     */
    public function edit_plan() {
        $data['pageName'] = $this->pageName . ' : Edit Plan';
        $get = $this->uri->uri_to_assoc();
        
        //If no id found
        if(!isset($get['id'])){
            $this->session->set_flashdata('info_message', '<span class="error-alert">No content found</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
        
        $id = $get['id'];
        $where_clause = array('id' => $id);
        $planRS = $this->Plan_model->get_plan($where_clause);


        if (!$planRS) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Content not available. Please try again later.</span>');
            redirect('admin/plan/home', "location");
            exit();
        }
        
        $plan = $planRS[0];
        $data['plan'] = $plan;
        
        //After posting save data
        if(isset($_POST['id']) && !empty($_POST['id'])) {
           
            $pst_id =  addslashes($_POST['id']);
            $isplanAdded = $this->Plan_model->update_plan($pst_id);
            
            if(!$isplanAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to update the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record updated successfull!');
                redirect('admin/plan/home', "location");
            }
        }
        $this->load->view('admin/plan/edit_view', $data);    
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
       $idName = 'id';
       $tableName= $this->Plan_model->static_table;
       
        $isDelete = $this->Common_model->delete_records($tableName, $idName, $id);
        if($isDelete){
             $this->session->set_flashdata('info_message', 'Records delete successfully');
        }
        else{
             $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
        }
        redirect('admin/plan/home', "location");
        exit();
    }

}

 