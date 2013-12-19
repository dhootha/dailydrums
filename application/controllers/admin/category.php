<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Category extends CI_Controller {

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
        $this->load->model('admin/Category_model');
        $this->load->model('Common_model');
        $this->pageName = 'Manage Category';
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
        $categoriesRS = $this->Category_model->get_category();
        
        //echo "<pre>"; print_r($statcPagesRS);exit;
        $data['categoriesRS'] = $categoriesRS;
        $this->load->view('admin/category/listing_view', $data);    
    }
    
    
    /**
     * Adding static page from admin end
     */
    public function add_page() {
        $data['pageName'] = $this->pageName . ' : Add Page';
        
        if(isset($_POST['page_action']) && !empty($_POST['page_action'])){
            
            $isPageAdded = $this->Category_model->insert_category();
            
            if(!$isPageAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to add the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record added successfull!');
                redirect('admin/category/home', "location");
            }
        }
        $this->load->view('admin/category/add_view', $data);    
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
				
					redirect('admin/category/home', "location");
					exit;
				}     		
     		
     		$page_id = $get['id'];  
     		$whr_arr = array('category_id'=>$page_id);  		
     		if( ( $catData = $this->Category_model->get_category($whr_arr) ) ) {
     							
     				$this->Category_model->update_status($catData[0]->category_id);
     			}
     		redirect('admin/category/home', "location");
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
        $categoryRS = $this->Category_model->get_category($where_clause);


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
            $isCategoryAdded = $this->Category_model->update_category($pst_category_id);
            
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
       $tableName= $this->Category_model->static_table;
       
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

 